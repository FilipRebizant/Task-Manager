import {loadTasks} from './loadTasks';

export function deleteTask(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-task-id');
    let status = e.target.getAttribute('data-task-status');
    const errorContainer = document.getElementById('errorContainer');
    const successContainer = document.getElementById('successContainer');

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
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            successContainer.classList.remove('d-none');
            successContainer.innerText = 'Task has been deleted';
            loadTasks(status.toLowerCase());
        }
    });
}