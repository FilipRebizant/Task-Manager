export function loadTasks(taskStatus) {
    fetch(`/api/tasks?status=${taskStatus}`)
        .then(function (response) {
            return response.json();
        }).then(function (response) {

        const markup = `
                    <div class="row">
                        ${response.tasks.map(
            task => `
                        <div class="col-sm-12 mb-3">
                            <div class="card text-center">
                                <div class="card-header d-flex justify-content-between">
                                    <a href="" class="deleteTaskButton" data-task-status="${task.status}" data-task-id="${task.id}">Delete</a>
                                    <p class="card-text">${task.user == null && task.status === 'Todo' ? "<a href=\"{ path('home') }\" class=\"card-link\">Assign to me</a>" : task.user}</p>
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
    });
};