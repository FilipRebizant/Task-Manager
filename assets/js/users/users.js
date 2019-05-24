function getUsers() {
    var accessToken = document.getElementById('access_token').innerText;
        console.log(accessToken);
    fetch('/api/users', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${accessToken}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        console.log(response);
        const markup = `
                <ul class="users">
                    ${response.users.map(
                        user => `<li class="user">${user.username} email: ${user.email}</li>`
                    ).join(' ')}
                </ul>
                `;

        document.getElementById('usersContainer').innerHTML = markup;
    }).catch(error => {
        console.log(error);
    });
}

getUsers();