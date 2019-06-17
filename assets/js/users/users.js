import { addUser } from './addUser';
import { loadUsers } from './loadUsers';
import { deleteUser } from './deleteUser';
import { activateAccount } from './activateAccount';
import { loadProfile } from './profile';

const usersContainer = document.getElementById('usersContainer');
const createPasswordForm = document.getElementById('createPasswordForm');
const profileContainer = document.getElementById('profileContainer');

if (profileContainer) {
    loadProfile();
}

if (createPasswordForm) {
    document.getElementById('createPasswordForm').addEventListener('submit', function (event) {
        event.preventDefault();
        activateAccount();
    }, false);
}

const addUserButton = document.getElementById('addUserButton');
if (addUserButton) {
    addUserButton.addEventListener('click', function (event) {
        addUser();
    }, false);
}

document.addEventListener('click', function (event) {
    if (!event.target.matches('.deleteUserButton')) return;
    event.preventDefault();
    deleteUser(event);
}, false);
if (usersContainer) {
    loadUsers();
}
