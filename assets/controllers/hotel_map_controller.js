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

    async connect() {
        if (typeof window.L === 'undefined') {
            this.updateStatus(this.errorLabelValue);
            return;
        }

        this.updateStatus(this.loadingLabelValue);

        if (!this.hasMapTarget) {
            this.updateStatus(this.errorLabelValue);
            return;
        }

        this.map = window.L.map(this.mapTarget, {
            scrollWheelZoom: false,
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
        }
    }

    disconnect() {
        if (this.map) {
            this.map.remove();
            this.map = null;
        }
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
