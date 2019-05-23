function getUsers() {
    var accessToken = document.getElementById('access_token');

    console.log(accessToken);
    fetch('/api/users', {
        headers: {
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
    });
}


function authorise() {

    fetch('/token', {
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        console.log(response);
        var uri = `https://dev-gegxco2s.auth0.com/authorise?response_type=code&client_id=${response.client_id}&redirect_uri=http://localhost/callback&audience=http://localhost/api&state=xyz`;
        var encodedURI = encodeURI(uri);
        fetch(encodedURI, {
            mode: 'cors',
            method: 'get',
            redirect: 'follow',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': 'http://localhost',
                "Access-Control-Allow-Credentials": 'true',
                "Access-Control-Allow-Headers": 'Origin, X-Requested-With, Content-Type, Accept',
                "Access-Control-Allow-Methods": "GET, POST"
            }

        }).then(function (response) {
            return response.json();
        }).then(function (response) {
            console.log(response);
        });
    });
}

getUsers();
