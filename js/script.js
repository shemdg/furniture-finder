// js/script.js - With defer attribute
const furnitureForm = document.getElementById('furnitureForm');
const furnitureSelect = document.getElementById('furniture_type');

// Form submission
if (furnitureForm) {
    furnitureForm.addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const loading = document.getElementById('loading');

        if (submitBtn) submitBtn.disabled = true;
        if (loading) loading.classList.add('active');

        // Validate "Other" field if needed
        if (furnitureSelect && furnitureSelect.value === 'Other') {
            const otherInput = document.getElementById('other_furniture');
            if (otherInput && !otherInput.value.trim()) {
                e.preventDefault();
                alert('Please specify the furniture type.');
                otherInput.focus();
                if (submitBtn) submitBtn.disabled = false;
                if (loading) loading.classList.remove('active');
            }
        }
    });
}

// dynamic price range values
document.addEventListener('DOMContentLoaded', function() {
    const priceSlider = document.getElementById('priceSlider');
    const priceDisplay = document.getElementById('priceDisplay');
    const budgetValue = document.getElementById('budgetValue');

    // Define price ranges
    const priceRanges = [
        '₱0 - ₱5,000',
        '₱5,000 - ₱25,000',
        '₱25,000 - ₱50,000',
        '₱50,000 - ₱100,000',
        '₱100,000 - ₱185,000'
    ];

    // Update display when slider moves
    priceSlider.addEventListener('input', function() {
        const index = parseInt(this.value);
        const range = priceRanges[index];

        // Update display
        priceDisplay.textContent = range;
        budgetValue.value = range;

        // Optional: Change color based on price
        const colors = ['text-green-600', 'text-blue-600', 'text-yellow-600', 'text-orange-600', 'text-red-600'];
        priceDisplay.className = `font-semibold ${colors[index]}`;
    });

    // Initialize display
    priceSlider.dispatchEvent(new Event('input'));
});