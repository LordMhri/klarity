document.addEventListener('DOMContentLoaded', () => {


    // const signupSubmit = document.getElementById('signupSubmit');
    // const password = document.getElementById('password');
    // const confirmPassword = document.getElementById('confirm-password');
    // const signupMessage = document.getElementById('signupMessage');

    // signupForm.addEventListener('submit', (e) => {
    //     if (password.value !== confirmPassword.value) {
    //         e.preventDefault();
    //         signupMessage.textContent = 'Passwords do not match!';
    //         signupMessage.style.color = 'red';
    //
    //
    //         alert('Passwords do not match! Please try again.');
    //
    //
    //         // password.value = '';
    //         confirmPassword.value = '';
    //         password.focus();
    //     }
    // });
    //
    // confirmPassword.addEventListener('input', () => {
    //     if (password.value !== confirmPassword.value) {
    //         signupMessage.textContent = 'Passwords do not match!';
    //         signupMessage.style.color = 'red';
    //     } else {
    //         signupMessage.textContent = 'Passwords match!';
    //         signupMessage.style.color = 'green';
    //     }
    // });


});

function validateSignupForm() {
    const username = document.getElementsByName('username')[0].value.trim();
    const email = document.getElementsByName('email')[0].value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const messageDiv = document.getElementById('signupMessage');

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

    if (password.length < 6) {
        messageDiv.textContent = 'Password must be at least 6 characters.';
        return false;
    }

    if (password !== confirmPassword) {
        messageDiv.textContent = 'Passwords do not match.';
        return false;
    }

    return true;
}

// Attach the validator to the signup form submit event
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
