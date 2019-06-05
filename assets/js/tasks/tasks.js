import { addTask } from './addTask';
import { loadTasks } from './loadTasks';
import { deleteTask } from './deleteTask';
import { changeStatus } from './changeStatus';
import { assignUserToTask } from './assignUser';

let createTaskForm = document.getElementById('createTaskForm');
createTaskForm.addEventListener('submit', addTask);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.changeStatusButton')) return;
    event.preventDefault();
    changeStatus(event);
}, false);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.deleteTaskButton')) return;
    event.preventDefault();
    deleteTask(event);
}, false);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.assignTaskButton')) return;
    event.preventDefault();
    assignUserToTask(event);
}, false);

loadTasks("todo");
loadTasks("pending");
loadTasks("done");