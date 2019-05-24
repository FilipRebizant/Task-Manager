
document.getElementById('refreshTokenButton').addEventListener('click', function (event) {
    event.preventDefault();
    refreshToken(event);
}, false);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.deleteUserButton')) return;
    event.preventDefault();
    deleteUser(event);
}, false);


function refreshToken() {
    const infoContainer = document.getElementById('requestInfoContainer');
    const refreshTokenButton = document.getElementById('refreshTokenButton')
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

function loadUsers() {
    let accessToken = document.getElementById('access_token').innerText;
    const infoContainer = document.getElementById('requestInfoContainer');
    const usersContainer = document.getElementById('usersContainer');

    fetch('/api/users', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${accessToken}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {

        if (response.error) {
            infoContainer.classList.add('alert-danger');
            infoContainer.innerText = response.error.message;
            usersContainer.innerText = '';
            if (response.error.message === 'Expired token') {
                const refreshTokenButton = document.getElementById('refreshTokenButton');
                refreshTokenButton.classList.remove('d-none');
            }
        } else {
            const markup = `
                <table class="table">
                 <thead class="thead-dark">
                            <tr class="card-body">
                                <th class="card-title">Username</th>
                                <th class="card-text">Email</th>
                                <th></th>
                            </tr>
                        </thead>
                    ${response.users.map(
                        user => `
                             <tr>
                                <td scope="row">${user.username}</td>
                                <td scope="row">${user.email}</td>
                                <td scope="row">
                                    <button class="btn btn-outline-danger deleteUserButton" data-user-id="${user.id}">Delete</button>
                                </td>
                             </tr>
                    `).join(' ')}
                </table>
                `;

            usersContainer.innerHTML = markup;
        }
    }).catch(error => {
        console.log(error);
    });
}

loadUsers();