import { config } from '../_config';
import { authHeader, handleResponse, handleError } from '../_helpers';

export const userService = {
    getAll,
    getById,
    deleteUser
};

function getAll(signal) {
    let status;
    const requestOptions = { method: 'GET', headers: authHeader(), signal: signal};

    return fetch(`${config.apiUrl}/api/users`, requestOptions)
        .then((response) => {status = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, status));
}

function getById(id, signal) {
    let status;
    const requestOptions = { method: 'GET', headers: authHeader(), signal: signal };

    return fetch(`${config.apiUrl}/api/users/${id}`, requestOptions)
        .then((response) => {status = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, status));
}

function deleteUser(id, signal) {
    let status;
    const requestOption = { method: 'DELETE', headers: authHeader(), signal: signal};

    return fetch(`${config.apiUrl}/api/users/${id}`, requestOption)
        .then((response) => {status = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, status));
}