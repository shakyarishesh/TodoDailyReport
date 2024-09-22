// loginsignup.js

// Function to handle form submission
function handleSignupSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Validate form fields
    if (!firstName || !lastName || !email || !password) {
        alert('Please fill out all fields.');
        return;
    }

    if (password.length < 4) {
        alert('Password must be at least 4 characters long.');
        return;
    }

    // If all validations pass, submit the form
    document.getElementById('signupForm').submit();
}

// Password visibility toggle
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const passwordWrapper = document.querySelector('.password-wrapper');

    // Create visibility toggle button
    const toggleButton = document.createElement('span');
    toggleButton.className = 'material-icons';
    toggleButton.textContent = 'visibility_off';
    toggleButton.style.cursor = 'pointer';
    toggleButton.style.position = 'absolute';
    toggleButton.style.right = '10px';
    toggleButton.style.top = '50%';
    toggleButton.style.transform = 'translateY(-50%)';
    passwordWrapper.appendChild(toggleButton);

    // Toggle password visibility
    toggleButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'visibility';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'visibility_off';
        }
    });
});
