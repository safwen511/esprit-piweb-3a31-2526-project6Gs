import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['map', 'status'];

    static values = {
        hotelsUrl: String,
        emptyLabel: String,
        errorLabel: String,
        loadingLabel: String,
        missingCoordinatesLabel: String,
        fallbackLat: Number,
        fallbackLng: Number,
        fallbackZoom: Number,
    };

    connect() {
        if (!this.hasMapTarget) {
            this.updateStatus(this.errorLabelValue);
            return;
        }

        this.updateStatus(this.loadingLabelValue);
        this.startWhenVisible();
    }

    disconnect() {
        if (this.observer) {
            this.observer.disconnect();
            this.observer = null;
        }

        if (this.map) {
            this.map.remove();
            this.map = null;
        }
    }

    startWhenVisible() {
        if (!('IntersectionObserver' in window)) {
            window.setTimeout(() => this.initializeMap(), 600);
            return;
        }

        this.observer = new IntersectionObserver((entries) => {
            if (!entries.some((entry) => entry.isIntersecting)) {
                return;
            }

            this.observer.disconnect();
            this.observer = null;
            this.initializeMap();
        }, {
            rootMargin: '200px 0px',
            threshold: 0.01,
        });

        this.observer.observe(this.element);
    }

    async initializeMap() {
        if (this.map || this.loadingMap) {
            return;
        }

        this.loadingMap = true;
        this.updateStatus(this.loadingLabelValue);

        try {
            await this.ensureLeafletLoaded();
        } catch (error) {
            this.updateStatus(this.errorLabelValue);
            this.loadingMap = false;
            return;
        }

        this.map = window.L.map(this.mapTarget, {
            scrollWheelZoom: false,
            zoomControl: true,
        });

        window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19,
        }).addTo(this.map);

        this.map.setView([
            this.fallbackLatValue || 36.8065,
            this.fallbackLngValue || 10.1815,
        ], this.fallbackZoomValue || 6);

        window.setTimeout(() => this.map.invalidateSize(), 0);

        try {
            const response = await fetch(this.hotelsUrlValue, {
                headers: {
                    Accept: 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error(`Hotel map request failed with status ${response.status}`);
            }

            const payload = await response.json();
            const hotels = Array.isArray(payload.hotels) ? payload.hotels : [];
            const mappedHotels = hotels.filter((hotel) => this.hasCoordinates(hotel));

            if (mappedHotels.length === 0) {
                this.updateStatus(hotels.length > 0 ? this.missingCoordinatesLabelValue : this.emptyLabelValue);
                return;
            }

            const bounds = [];

            mappedHotels.forEach((hotel) => {
                const marker = window.L.marker([hotel.latitude, hotel.longitude], {
                    icon: this.buildIcon(),
                }).addTo(this.map);

                marker.bindPopup(this.buildPopup(hotel));
                marker.on('click', () => {
                    if (hotel.bookingUrl) {
                        window.location.assign(hotel.bookingUrl);
                    }
                });
                bounds.push([hotel.latitude, hotel.longitude]);
            });

            this.map.fitBounds(bounds, { padding: [30, 30] });
            this.updateStatus('');
        } catch (error) {
            this.updateStatus(this.errorLabelValue);
        } finally {
            this.loadingMap = false;
        }
    }

    async ensureLeafletLoaded() {
        if (typeof window.L !== 'undefined') {
            return;
        }

        this.loadStylesheet('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');

        await this.loadScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js');
    }

    loadStylesheet(href) {
        if (document.querySelector(`link[href="${href}"]`)) {
            return;
        }

        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = href;
        document.head.appendChild(link);
    }

    loadScript(src) {
        if (window.__leafletLoadingPromise) {
            return window.__leafletLoadingPromise;
        }

        window.__leafletLoadingPromise = new Promise((resolve, reject) => {
            const existingScript = document.querySelector(`script[src="${src}"]`);
            if (existingScript) {
                existingScript.addEventListener('load', resolve, { once: true });
                existingScript.addEventListener('error', reject, { once: true });
                return;
            }

            const script = document.createElement('script');
            script.src = src;
            script.async = true;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });

        return window.__leafletLoadingPromise;
    }

    buildIcon() {
        return window.L.divIcon({
            className: 'hotel-map__marker',
            html: '<span class="hotel-map__marker-core"></span>',
            iconSize: [22, 22],
            iconAnchor: [11, 22],
            popupAnchor: [0, -18],
        });
    }

    buildPopup(hotel) {
        const wrapper = document.createElement('div');
        wrapper.className = 'hotel-map__popup';

        const title = document.createElement('strong');
        title.textContent = hotel.name || '';
        wrapper.appendChild(title);

        if (hotel.address) {
            const address = document.createElement('div');
            address.textContent = hotel.address;
            wrapper.appendChild(address);
        }

        return wrapper;
    }

    hasCoordinates(hotel) {
        return Number.isFinite(hotel.latitude) && Number.isFinite(hotel.longitude);
    }

    updateStatus(message) {
        if (!this.hasStatusTarget) {
            return;
        }

        this.statusTarget.textContent = message;
        this.statusTarget.hidden = message === '';
    }
}
