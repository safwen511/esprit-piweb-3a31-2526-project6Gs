import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['startDate', 'endDate', 'total'];

    static values = {
        nightlyRate: Number,
        currencyPrefix: String,
    };

    connect() {
        this.updateTotal();
    }

    updateTotal() {
        if (!this.hasStartDateTarget || !this.hasEndDateTarget || !this.hasTotalTarget) {
            return;
        }

        const startDate = this.startDateTarget.value;
        const endDate = this.endDateTarget.value;

        if (!startDate || !endDate) {
            this.renderTotal(0);
            return;
        }

        const start = new Date(`${startDate}T00:00:00`);
        const end = new Date(`${endDate}T00:00:00`);
        const nights = Math.round((end - start) / 86400000);

        if (nights <= 0) {
            this.renderTotal(0);
            return;
        }

        this.renderTotal(nights * this.nightlyRateValue);
    }

    renderTotal(total) {
        const currencyPrefix = this.currencyPrefixValue || '$';
        this.totalTarget.textContent = `${currencyPrefix}${total.toFixed(2)}`;
    }
}
