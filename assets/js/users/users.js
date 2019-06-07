import { addUser } from './addUser';
import { loadUsers } from './loadUsers';
import { deleteUser } from './deleteUser';

document.getElementById('addUserButton').addEventListener('click', function (event) {
    addUser();
}, false);

document.addEventListener('click', function (event) {
    if (!event.target.matches('.deleteUserButton')) return;
    event.preventDefault();
    deleteUser(event);
}, false);

loadUsers();