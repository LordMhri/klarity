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

    const loginContainer = document.getElementById('loginForm');

    loginContainer.addEventListener('submit', function (event){
        event.preventDefault();

        const usernameInput = document.querySelector('#loginForm input[name="username"]');
        const passwordInput = document.querySelector('#loginForm input[name="password"]');

            console.log(usernameInput.value);
            console.log(passwordInput.value);

        const username = usernameInput.value;
        const password = passwordInput.value;

        fetch('/klarity/api/auth/login.php', {
            method : 'POST',    
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body : new URLSearchParams(
                {
                    username: username,
                    password: password,
                }
            )
        }).then(response => response.json()
        ).then(data => {
            if (data['status']) {
                console.log('Login successful: ',data);
                // window.location.href = "/";
            } else if (data.error) {
                console.log('Login failed: ',data.error);
            }
        }).catch(error => {
            console.error('Error during login', error);

        })

    }

    )
    
    const registerForm = document.getElementById('signupForm');
    
    registerForm.addEventListener('submit', function (event){
        event.preventDefault();
        
        const passwordInput = document.querySelector('#signupForm input[name="password"]');
        const usernameInput = document.querySelector('#signupForm input[name="username"]');
        
        const password = passwordInput.value;
        const username = usernameInput.value;
        
        fetch('/klarity/api/auth/register.php', {
            method:'POST',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body : new URLSearchParams({
                username:username,
                password :password,
            })
        }).then(response => response.json()).then(
            data => {
                if (data['success']) {
                    console.log('User created successfully');
                }else  {
                    console.log('An Error has occurred');
                }
            }
        )
    });

});