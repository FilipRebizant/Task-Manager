import {loadTasks} from "./loadTasks";

export function assignUserToTask(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-task-id');
    let username = document.getElementById('user').innerText;
    let errorContainer = document.getElementById('errorContainer');
    let successContainer = document.getElementById('successContainer');

    fetch(`/api/tasks/${id}/users/${username}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({
            username: username
        })
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            errorContainer.classList.add('d-none');
            successContainer.classList.remove('d-none');
            successContainer.innerText = response.result;
            loadTasks("todo");
        }
    }).catch(function (error) {
        errorContainer.classList.remove('d-none');
        errorContainer.innerText = 'An error occurred';
    });
}