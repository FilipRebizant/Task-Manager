import { loadUsers } from './loadUsers';

export function addUser() {
    let token = document.getElementById('token').innerText;
    const errorContainer = document.getElementById('errorContainer');
    const successContainer = document.getElementById('successContainer');
    const loader = document.querySelector('.loader');

    let email = document.getElementById('emailInput');
    let username = document.getElementById('usernameInput');
    let password1 = document.getElementById('passwordInput1');
    let password2 = document.getElementById('passwordInput2');

    let data = {
        email: email.value,
        username: username.value,
        password1: password1.value,
        password2: password2.value
    };

    loader.classList.remove('d-none');
    errorContainer.classList.add('d-none');
    successContainer.classList.add('d-none');
    if (password1.value === password2.value) {
        fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization':`Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (response) {
            if (response.error) {
                loader.classList.add('d-none');

                errorContainer.classList.remove('d-none');
                errorContainer.innerText = response.error.message;
            } else {
                loader.classList.add('d-none');
                loadUsers();
                successContainer.classList.remove('d-none');
                successContainer.innerText = response.result;
                username.value = '';
                email.value = '';
                password1.value = '';
                password2.value = '';
            }
        }).catch(function (error) {
            errorContainer.innerText = error.error.message;
        });
    } else {
        loader.classList.add('d-none');
        errorContainer.classList.remove('d-none');
        errorContainer.innerText = "Provided passwords doesn't match";
    }
}