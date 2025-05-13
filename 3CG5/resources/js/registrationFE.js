document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.querySelector('form');

    registrationForm.addEventListener('submit', function (event) {
        // Add your validation checks here
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const departmentSelect = document.getElementById('department');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        if (nameInput.value.trim() === '') {
            alert('Please enter your name.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (emailInput.value.trim() === '') {
            alert('Please enter your email address.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (departmentSelect.value === '') {
            alert('Please select your department.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (passwordInput.value.length < 8) {
            alert('Password must be at least 8 characters long.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (passwordInput.value !== passwordConfirmationInput.value) {
            alert('Passwords do not match.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        // If all validation passes, the form will submit normally
    });
});