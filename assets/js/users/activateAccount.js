export function activateAccount() {
    const errorContainer = document.getElementById('errorContainer');
    const successContainer = document.getElementById('successContainer');
    const loader = document.querySelector('.loader');
    const form = document.getElementById('createPasswordForm');
    const route = form.getAttribute('action');
    let passwordInput1 = document.getElementById('passwordInput1');
    let passwordInput2 = document.getElementById('passwordInput2');

    let data = {
        password1: passwordInput1.value,
        password2: passwordInput2.value
    };

    loader.classList.remove('d-none');
    errorContainer.classList.add('d-none');
    successContainer.classList.add('d-none');

    fetch(route, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            loader.classList.add('d-none');
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            loader.classList.add('d-none');
            successContainer.classList.remove('d-none');
            successContainer.innerText = response.result;
            passwordInput1.value = '';
            passwordInput2.value = '';
            setTimeout(function () {
                window.location = 'http://localhost/';
            }, 2000);
        }
    }).catch(function (error) {
        errorContainer.innerText = "Server error occurred, try again in few minutes";
    });
}