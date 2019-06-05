export function loadUsers() {
    let token = document.getElementById('token').innerText;
    const infoContainer = document.getElementById('requestInfoContainer');
    const usersContainer = document.getElementById('usersContainer');

    fetch('/api/users', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
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
                <table class="table table-responsive-sm">
                 <thead class="">
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
    });
}