document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('DOMContentLoaded', () => {
        console.log("Script loaded!"); // ✅ this should show in console

        const signupForm = document.getElementById('signupForm');
        console.log("Signup form found?", signupForm !== null);

        signupForm.addEventListener('submit', (e) => {
            console.log("Form submitting!");
        });
    });


    const loginBtn = document.getElementById('loginToggle');
    const signUpBtn = document.getElementById('signupToggle');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

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

    const signupSubmit = document.getElementById('signupSubmit');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    const signupMessage = document.getElementById('signupMessage');

    signupForm.addEventListener('submit', (e) => {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            signupMessage.textContent = 'Passwords do not match!';
            signupMessage.style.color = 'red';


            alert('Passwords do not match! Please try again.');


            // password.value = '';
            confirmPassword.value = '';
            password.focus();
        }
    });

    confirmPassword.addEventListener('input', () => {
        if (password.value !== confirmPassword.value) {
            signupMessage.textContent = 'Passwords do not match!';
            signupMessage.style.color = 'red';
        } else {
            signupMessage.textContent = 'Passwords match!';
            signupMessage.style.color = 'green';
        }
    });
});