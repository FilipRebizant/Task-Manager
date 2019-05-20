function getUsers() {
    fetch('/api/users')
        .then(function (response) {
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
    });
}

getUsers();