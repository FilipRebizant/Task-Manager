import {loadUsers} from "./loadUsers";

export function deleteUser(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-user-id');
    const infoContainer = document.getElementById('requestInfoContainer');

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
            infoContainer.innerText = response.error.message;
            infoContainer.classList.add('alert-danger');
        } else {
            loadUsers();
        }
    });
}