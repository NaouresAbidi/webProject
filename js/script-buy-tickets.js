document.addEventListener('DOMContentLoaded', function() {
    function calculatePrice() {
        const subTotalElement = document.getElementById('sub-total');
        const taxRateElement = document.getElementById('tax-rate');
        const taxAmountElement = document.getElementById('tax-amount');
        const totalPriceElement = document.getElementById('total-price');
        const totalAmountInput = document.getElementById('total-amount-input');
        const nbTicketsElement = document.getElementById('nbticket-in');
        
        const subTotal = parseFloat(subTotalElement.textContent);
        const taxRate = parseFloat(taxRateElement.textContent);
        const nbTickets = parseInt(nbTicketsElement.value);

        if (!isNaN(subTotal) && !isNaN(taxRate) && !isNaN(nbTickets)) {
            const totalSubTotal = subTotal * nbTickets;
            const taxAmount = totalSubTotal * (taxRate / 100);
            const totalAmount = totalSubTotal + taxAmount;

            subTotalElement.textContent = totalSubTotal.toFixed(2);
            taxAmountElement.textContent = taxAmount.toFixed(2);
            totalPriceElement.textContent = totalAmount.toFixed(2);

            totalAmountInput.value = totalAmount.toFixed(2);
        } else {
            console.error("Invalid values for subtotal, tax rate, or number of tickets.");
        }
    }

    document.getElementById('nbticket-in').addEventListener('change', calculatePrice);
    calculatePrice();
});