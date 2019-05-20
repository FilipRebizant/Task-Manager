export function changeStatus(e) {
    let id = e.target.getAttribute('data-task-id');
    let status = e.target.getAttribute('data-task-status');
    let errorContainer = document.getElementById('changeStatusErrorContainer');
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
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: id,
            status: status
        })
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.classList.add('d-flex');
            errorContainer.innerText = response.error.message;
        } else {
            errorContainer.classList.remove('d-flex');
            loadTasks(status.toLowerCase());
            loadTasks(toLoad);
        }
    });
}