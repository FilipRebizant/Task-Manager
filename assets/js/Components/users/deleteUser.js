import {loadUsers} from "./loadUsers";

export function deleteUser(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-user-id');
    const successContainer = document.getElementById('successContainer');
    const errorContainer = document.getElementById('errorContainer');

    fetch(`/api/users/${id}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            successContainer.classList.remove('d-none');
            successContainer.innerText = response.result;
            loadUsers();
        }
    });
}