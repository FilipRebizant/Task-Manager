import { loadUsers } from './loadUsers';

export function addUser() {
    let token = document.getElementById('token').innerText;
    const errorContainer = document.getElementById('modalErrorContainer');
    const successContainer = document.getElementById('modalSuccessContainer');
    const loader = document.querySelector('.loader');

    let emailInput = document.getElementById('emailInput');
    let usernameInput = document.getElementById('usernameInput');
    let roleInput = document.getElementById('roleInput');

    let data = {
        email: emailInput.value,
        username: usernameInput.value,
        role: roleInput.value
    };

    loader.classList.remove('d-none');
    errorContainer.classList.add('d-none');
    successContainer.classList.add('d-none');

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
            usernameInput.value = '';
            emailInput.value = '';
        }
    }).catch(function (error) {
        errorContainer.innerText = "Server error occurred, try again in few minutes";
    });
}