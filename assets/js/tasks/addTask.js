import {loadTasks} from './loadTasks';

export function addTask() {
    event.preventDefault();

    let title = document.getElementsByName('title')[0];
    let priority = document.getElementsByName('priority')[0];
    let username = document.getElementsByName('username')[0];
    let description = document.getElementsByName('description')[0];
    let errorContainer = document.getElementById('error');
    let successContainer = document.getElementById('success');

    let data = {
        title: title.value,
        priority: priority.value,
        username: username.value,
        description: description.value
    };

    fetch('/api/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        if (response.error) {
            errorContainer.innerText = response.error.message;
        } else {
            console.log(response);
            errorContainer.innerText = '';
            title.value = '';
            priority.value = '';
            username.value = '';
            description.value = '';
            successContainer.innerText = response.result;
            loadTasks("todo");
        }
    }).catch(function (error) {
        errorContainer.innerText = error.error.message;
    });
}