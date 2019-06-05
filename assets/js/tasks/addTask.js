import {loadTasks} from './loadTasks';

export function addTask() {
    const tokenContainer = document.getElementById('token');
    let title = document.getElementsByName('title')[0];
    let priority = document.getElementsByName('priority')[0];
    let username = document.getElementsByName('username')[0];
    let description = document.getElementsByName('description')[0];
    let errorContainer = document.getElementById('modalErrorContainer');
    let successContainer = document.getElementById('modalSuccessContainer');
    let token = tokenContainer.innerText;

    let data = {
        title: title.value,
        priority: priority.value,
        username: username.value,
        description: description.value
    };

    errorContainer.classList.add('d-none');
    successContainer.classList.add('d-none');

    fetch('/api/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.classList.remove('d-none');
            errorContainer.innerText = response.error.message;
        } else {
            errorContainer.innerText = '';
            title.value = '';
            priority.value = '';
            username.value = '';
            description.value = '';
            successContainer.classList.remove('d-none');
            successContainer.innerText = response.result;
            loadTasks("todo");
        }
    }).catch(function (error) {
        errorContainer.innerText = "Server error occurred, try again in five minutes.";
    });
}