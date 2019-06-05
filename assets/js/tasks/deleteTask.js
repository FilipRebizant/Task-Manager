import {loadTasks} from './loadTasks';

export function deleteTask(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-task-id');
    let status = e.target.getAttribute('data-task-status');

    fetch(`/api/tasks/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.classList.add('d-flex');
            errorContainer.innerText = response.error.message;
        } else {
            loadTasks(status.toLowerCase());
        }
    });
}