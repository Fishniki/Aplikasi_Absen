document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[name="jenis_kelamin"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                checkboxes.forEach((otherCheckbox) => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
});
