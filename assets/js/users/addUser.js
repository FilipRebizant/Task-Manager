export function addUser() {
    let errorContainer = document.getElementById('errorContainer');
    let successContainer = document.getElementById('successContainer');

    let email = document.getElementById('emailInput');
    let username = document.getElementById('usernameInput');
    let password1 = document.getElementById('passwordInput1');
    let password2 = document.getElementById('passwordInput2');

    let data = {
        email: email.value,
        username: username.value,
        password: password1.value
    };

    fetch('/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            successContainer.classList.add('d-none');
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            errorContainer.classList.add('d-none');
            successContainer.classList.remove('d-none');
            successContainer.innerText = 'success';
            console.log(response);

            username.value = '';
            email.value = '';
            password1.value = '';
            password2.value = '';
        }
    }).catch(function (error) {
        errorContainer.innerText = error.error.message;
    });
}