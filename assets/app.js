import './styles/app.css';
import './bootstrap.js';

if (!window.__furhopeNavigationBooted) {
    window.__furhopeNavigationBooted = true;
    bootstrapNavigationExperience();
}

function bootstrapNavigationExperience() {
    bindLinkPrefetch();
    prefetchLikelyRoutes();
    bindAjaxForms();
}

function bindAjaxForms() {
    document.addEventListener('submit', async (event) => {
        const form = event.target instanceof Element ? event.target.closest('[data-ajax-form]') : null;
        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        const confirmMessage = form.dataset.ajaxConfirm;
        if (confirmMessage && !window.confirm(confirmMessage)) {
            event.preventDefault();
            return;
        }

        event.preventDefault();

        const submitter = event.submitter instanceof HTMLElement ? event.submitter : form.querySelector('[type="submit"]');
        const originalLabel = submitter instanceof HTMLButtonElement ? submitter.textContent : null;
        if (submitter instanceof HTMLButtonElement) {
            submitter.disabled = true;
            submitter.textContent = form.dataset.ajaxLoadingLabel || 'Saving...';
        }

        try {
            const response = await fetch(form.action, {
                method: form.method || 'POST',
                body: new FormData(form),
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const payload = await response.json().catch(() => ({}));
            if (!response.ok || payload.success === false) {
                throw new Error(payload.message || 'Unable to complete the action.');
            }

            applyAjaxFormResult(form, payload);
        } catch (error) {
            showAjaxMessage(form, error.message || 'Unable to complete the action.', 'error');
            if (submitter instanceof HTMLButtonElement) {
                submitter.disabled = false;
                if (originalLabel !== null) {
                    submitter.textContent = originalLabel;
                }
            }
        }
    });
}

function applyAjaxFormResult(form, payload) {
    if (payload.redirect) {
        window.location.href = payload.redirect;
        return;
    }

    if (payload.message) {
        showAjaxMessage(form, payload.message, payload.level || 'success');
    }

    const removeTarget = form.dataset.ajaxRemoveTarget;
    if (removeTarget) {
        const target = form.closest(removeTarget);
        if (target) {
            target.remove();
            return;
        }
    }

    const statusTarget = form.dataset.ajaxStatusTarget;
    if (statusTarget && payload.statusLabel) {
        const root = form.closest(form.dataset.ajaxScope || 'article, tr, .ops-list__item') || document;
        const statusElement = root.querySelector(statusTarget);
        if (statusElement) {
            statusElement.textContent = payload.statusLabel;
            if (payload.statusClass) {
                statusElement.className = payload.statusClass;
            }
        }
    }

    if (form.dataset.ajaxHide === 'true') {
        form.hidden = true;
    }

    if (form.dataset.ajaxDisableSiblings === 'true') {
        const group = form.closest(form.dataset.ajaxActionGroup || '.actions, .directory-actions-row, .rdv-actions, .hotel-module-admin-actions');
        group?.querySelectorAll('button').forEach((button) => {
            button.disabled = true;
        });
    }

    const submitButton = form.querySelector('button[type="submit"]');
    if (submitButton instanceof HTMLButtonElement) {
        submitButton.disabled = true;
    }
}

function showAjaxMessage(form, message, level) {
    const target = form.dataset.ajaxMessageTarget
        ? document.querySelector(form.dataset.ajaxMessageTarget)
        : form.querySelector('[data-ajax-message]');

    if (!target) {
        return;
    }

    target.textContent = message;
    target.dataset.ajaxLevel = level;
}

function bindLinkPrefetch() {
    const warmup = (event) => {
        const link = event.target instanceof Element ? event.target.closest('a[href]') : null;
        if (!(link instanceof HTMLAnchorElement) || !isPrefetchable(link)) {
            return;
        }

        prefetchDocument(link.href);
    };

    document.addEventListener('pointerover', warmup, { passive: true, capture: true });
    document.addEventListener('pointerdown', warmup, { passive: true, capture: true });
    document.addEventListener('focusin', warmup, { passive: true, capture: true });
}

function prefetchLikelyRoutes() {
    const schedule = window.requestIdleCallback ?? ((callback) => window.setTimeout(callback, 200));

    schedule(() => {
        const links = Array.from(document.querySelectorAll('a[href]'))
            .filter((link) => link instanceof HTMLAnchorElement)
            .filter((link) => isPrefetchable(link))
            .sort((left, right) => scoreLinkForPrefetch(right) - scoreLinkForPrefetch(left))
            .slice(0, 8);

        for (const link of links) {
            prefetchDocument(link.href);
        }
    });
}

function isPrefetchable(link) {
    if (link.dataset.noPrefetch !== undefined || link.closest('[data-no-prefetch]')) {
        return false;
    }

    const url = toUrl(link.href);
    if (!url || url.origin !== window.location.origin) {
        return false;
    }

    if (url.pathname === window.location.pathname && url.search === window.location.search) {
        return false;
    }

    return !isUnsafeNavigation(url.pathname);
}

function isUnsafeNavigation(pathname) {
    return [
        /\/logout$/i,
        /\/(delete|remove|cancel|approve|reject|activate|deactivate)(\/|$)/i,
        /\/checkout(\/|$)/i,
        /\/download(\/|$)/i,
        /\/voice\//i,
        /\/face\//i,
    ].some((pattern) => pattern.test(pathname));
}

function prefetchDocument(href) {
    const url = toUrl(href);
    if (!url) {
        return;
    }

    const key = url.toString();
    if (document.head.querySelector(`link[rel="prefetch"][href="${CSS.escape(key)}"]`)) {
        return;
    }

    const hint = document.createElement('link');
    hint.rel = 'prefetch';
    hint.as = 'document';
    hint.href = key;
    document.head.appendChild(hint);
}

function scoreLinkForPrefetch(link) {
    let score = 0;

    if (link.dataset.instantNav !== undefined) {
        score += 100;
    }

    if (link.closest('.site-header')) {
        score += 40;
    }

    const rect = link.getBoundingClientRect();
    if (rect.bottom >= 0 && rect.top <= window.innerHeight) {
        score += 12;
    }

    return score;
}

function toUrl(href) {
    try {
        return new URL(href, window.location.href);
    } catch (error) {
        return null;
    }
}
