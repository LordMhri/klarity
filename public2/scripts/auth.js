
function validateSignupForm() {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const messageDiv = document.getElementById('signupMessage');
    console.log(username, email, password, confirmPassword);
    messageDiv.textContent = '';

    if (!username || !email || !password || !confirmPassword) {
        messageDiv.textContent = 'Please fill in all fields.';
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        messageDiv.textContent = 'Please enter a valid email address.';
        return false;
    }

    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordPattern.test(password)) {
        messageDiv.textContent = 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
        return false;
    }


    if (password !== confirmPassword) {
        messageDiv.textContent = 'Passwords do not match.';
        return false;
    }

    return true;
}

document.addEventListener('DOMContentLoaded', () => {




    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            if (!validateSignupForm()) {
                e.preventDefault();
            }
        });
    }
    const loginBtn = document.getElementById('loginToggle');
    const signUpBtn = document.getElementById('signupToggle');
    const loginForm = document.getElementById('loginForm');
    // const signupForm = document.getElementById('signupForm');

    loginBtn.addEventListener('click', () => {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
        signUpBtn.classList.remove('active');
        loginBtn.classList.add('active');
    });

    signUpBtn.addEventListener('click', () => {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
        signUpBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });
});
