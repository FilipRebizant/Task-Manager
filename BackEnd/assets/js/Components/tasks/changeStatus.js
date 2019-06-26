import {loadTasks} from './loadTasks';

export function changeStatus(e) {
    let token = document.getElementById('token').innerText;
    let id = e.target.getAttribute('data-task-id');
    let status = e.target.getAttribute('data-task-status');
    let errorContainer = document.getElementById('errorContainer');
    let successContainer = document.getElementById('successContainer');
    let toLoad = "todo";

    if (status === "Todo") {
        status = "Pending";
        toLoad = "todo";
    } else if (status === "Pending") {
        status = "Done";
        toLoad = "pending";
    } else {
        status = "Todo";
        toLoad = "done"
    }

    fetch(`/api/tasks/${id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({
            id: id,
            status: status
        })
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
            successContainer.innerText = response.response;
            loadTasks(status.toLowerCase());
            loadTasks(toLoad);
        }
    });
}