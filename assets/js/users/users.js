import { addUser } from './addUser';
import { loadUsers } from './loadUsers';

document.getElementById('refreshTokenButton').addEventListener('click', function (event) {
    event.preventDefault();
    refreshToken(event);
}, false);

document.getElementById('addUserButton').addEventListener('click', function (event) {
    addUser();
}, false);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.deleteUserButton')) return;
    event.preventDefault();
    deleteUser(event);
}, false);

function refreshToken() {
    const infoContainer = document.getElementById('requestInfoContainer');
    const refreshTokenButton = document.getElementById('refreshTokenButton');
    let accessTokenContainer = document.getElementById('access_token');

    fetch('/api/refreshToken')
        .then(function (response) {
            return response.json();
        }).then(function (response) {
            accessTokenContainer.innerText = response.token;
            loadUsers();
            infoContainer.classList.add('d-none');
            refreshTokenButton.classList.add('d-none');
    });
}

export function deleteUser(e) {
    let id = e.target.getAttribute('data-user-id');
    let accessToken = document.getElementById('access_token').innerText;
    const infoContainer = document.getElementById('requestInfoContainer');

    fetch(`/api/users/${id}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${accessToken}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            infoContainer.innerText = response.error.message;
            infoContainer.classList.add('alert-danger');
        } else {
            loadUsers();
        }
    });
}

loadUsers();