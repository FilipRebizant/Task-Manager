export function loadUsers() {

    const tokenContainer = document.getElementById('token');
    const infoContainer = document.getElementById('infoContainer');
    const errorContainer = document.getElementById('errorContainer');
    const usersContainer = document.getElementById('usersContainer');

    let token = tokenContainer.innerText;

    errorContainer.classList.add('d-none');

    fetch('/api/users', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {

        infoContainer.classList.add('d-none');

        if (response.message) {
            infoContainer.classList.add('d-none');
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.message;

            if (response.message === 'Expired JWT Token') {
                fetch('/api/token/refresh').then(
                    function (response) {
                        return response.json();
                    }).then(function (response) {

                    tokenContainer.innerText = response.token;

                    infoContainer.classList.remove('d-none');
                    infoContainer.innerText = 'Refreshing token...';

                    loadUsers();
                });
            }
        } else {
            const markup = `
                <table class="table table-responsive-sm">
                     <thead class="thead-dark">
                         <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Account status</th>
                            <th scope="col"></th>
                         </tr>
                     </thead>
                     <tbody>
                        ${response.users.map(
                            user => `
                                 <tr>
                                    <td scope="row">${ user.username }</td>
                                    <td scope="row">${ user.email }</td>
                                    <td scope="row">${ user.role === null ? 'Account not activated' : user.role }</td>
                                    <td scope="row">${ user.activation_token === null ? 'Active' : 'Not active' }</td>
                                    <td scope="row">
                                        <button class="btn btn-outline-danger deleteUserButton" data-user-id="${user.id}">Delete</button>
                                    </td>
                                 </tr>
                        `).join(' ')}
                    </tbody>
                    </table>
                `;

            usersContainer.innerHTML = markup;
        }
    });
}