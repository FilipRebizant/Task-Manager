import { config } from '../_config';
import { authHeader, handleResponse, handleError } from '../_helpers';

export const taskService = {
    getAll,
    getById,
    deleteTask
};

function getAll(status, signal) {
    let responseStatus;
    const requestOptions = { method: 'GET', headers: authHeader(), signal: signal};

    return fetch(`${config.apiUrl}/api/tasks?status=${status}`, requestOptions)
        .then((response) => {responseStatus = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, responseStatus));
}

function getById(id) {
    let responseStatus;
    const requestOptions = { method: 'GET', headers: authHeader() };

    return fetch(`${config.apiUrl}/api/tasks/${id}`, requestOptions)
        .then((response) => {responseStatus = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, responseStatus));
}

function deleteTask(id, signal) {
    let responseStatus;
    const requestOption = { method: 'DELETE', headers: authHeader(), signal: signal };

    return fetch(`${config.apiUrl}/api/tasks/${id}`, requestOption)
        .then((response) => {responseStatus = response.status; return response})
        .then(handleResponse)
        .catch((error) => handleError(error, responseStatus));
}