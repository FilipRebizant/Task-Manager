export function loadProfile() {

    const tokenContainer = document.getElementById('token');
    const navItem = document.getElementById('user');
    const userId = navItem.getAttribute('data-user-id');
    const infoContainer = document.getElementById('infoContainer');
    const errorContainer = document.getElementById('errorContainer');
    const usersContainer = document.getElementById('usersContainer');
    const profileContainer = document.getElementById('profileContainer');
    let token = tokenContainer.innerText;
    console.log(userId);

    // errorContainer.classList.add('d-none');

    fetch(`/api/users/${userId}`, {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
       console.log(response);

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
                        <tr>
                            <td scope="row">${ response.username }</td>
                            <td scope="row">${ response.email }</td>
                            <td scope="row">${ response.role === null ? 'Account not activated' : response.role }</td>
                            <td scope="row">${ response.activation_token === null ? 'Active' : 'Not active' }</td>
                            <td scope="row"></td>
                        </tr>
                    </tbody>
                    </table>
                `;

            profileContainer.innerHTML = markup;
        }
    });
}