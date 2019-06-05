export function loadTasks(taskStatus) {
    const tokenContainer = document.getElementById('token');
    const errorContainer = document.getElementById('errorContainer');
    const infoContainer = document.getElementById('infoContainer');
    let loaders = document.querySelectorAll('.loader');
    let token = tokenContainer.innerText;

    errorContainer.classList.add('d-none');

    fetch(`/api/tasks?status=${taskStatus}`, {
        headers: {
            'Authorization': `Bearer ${token}`
        }
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        for (var loader of loaders) {
            loader.classList.add('d-none');
        }

        infoContainer.classList.add('d-none');

        if (response.message) {
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.message;

            if (response.message === 'Expired JWT Token') {

                fetch('/api/token/refresh').then(
                    function (response) {
                        return response.json();
                    }).then(function (response) {
                    tokenContainer.innerText = response.token;

                    for (var loader of loaders) {
                        loader.classList.remove('d-none');
                    }

                    infoContainer.classList.remove('d-none');
                    infoContainer.innerText = 'Refreshing token...';

                    loadTasks('todo');
                    loadTasks('pending');
                    loadTasks('done');
                });
            }
        } else {
            const markup = `
                    <div class="row">
                        ${response.tasks.map(
                task => `
                                <div class="col-sm-12 mb-3">
                                    <div class="card text-center">
                                        <div class="task__main_header">
                                            <p class="card-text">Created: <span class="task__date">${task.created_at}</span></p>
                                            <p class="card-text">${task.updated_at === null ? "Not updated" : `Updated: <span class="task__date">${task.updated_at}`}</span></p>                                            
                                        </div>
                                        <div class="task__secondary_header">
                                            <button class="task__text_button deleteTaskButton" data-task-status="${task.status}" data-task-id="${task.id}">Delete</button>
                                            <p class="card-text">${task.user === null && task.status === 'Todo' ? `<button data-task-id=${task.id} class="assignTaskButton">Assign to me</button>` : task.user}</p>
                                            <p class="card-text">Priority: ${task.priority}</p>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">${task.title}</h5>
                                            <p class="card-text">Status: <span class="font-weight-bold">${task.status}</span></p>
                                            <p class="card-text">${task.description}</p>
                                            <button data-task-status="${task.status}" data-task-id="${task.id}" class="btn btn-primary changeStatusButton">${task.status === "Todo" ? "Move to Pending" : task.status === "Pending" ? "Move to Done" : "Need work"}</button>
                                        </div>
                                    </div>
                                </div>
                            `).join(' ')}
                    </div>
                `;

            document.getElementById(taskStatus).innerHTML = markup;
        }
    });

};