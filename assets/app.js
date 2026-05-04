import './styles/app.css';
import './bootstrap.js';

if (!window.__furhopeNavigationBooted) {
    window.__furhopeNavigationBooted = true;
    bootstrapNavigationExperience();
}

function bootstrapNavigationExperience() {
    bindLinkPrefetch();
    prefetchLikelyRoutes();
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
