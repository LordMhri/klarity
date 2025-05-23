document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('loginToggle');
    const signUpBtn = document.getElementById('signupToggle');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    loginBtn.addEventListener('click', () => {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';

        signUpBtn.classList.remove('active');
        loginBtn.classList.add('active');
    })

    signUpBtn.addEventListener('click', () => {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
        signUpBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });
});