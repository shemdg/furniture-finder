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

// Furniture type change
if (furnitureSelect) {
    furnitureSelect.addEventListener('change', function() {
        const otherContainer = document.getElementById('other_furniture_container');
        const otherInput = document.getElementById('other_furniture');

        if (!otherContainer || !otherInput) return;

        if (this.value === 'Other') {
            otherContainer.style.display = 'block';
            otherInput.required = true;
            otherInput.focus();
        } else {
            otherContainer.style.display = 'none';
            otherInput.required = false;
            otherInput.value = '';
        }
    });

    // Initialize on page load
    furnitureSelect.dispatchEvent(new Event('change'));
}