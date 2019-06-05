import { addUser } from './addUser';
import { loadUsers } from './loadUsers';
import { deleteUser } from './deleteUser';

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

loadUsers();