import { config } from '../_config';
import { authHeader, handleResponse } from '../_helpers';

export const userService = {
    getAll,
    getById
};

function getAll(signal) {
    const requestOptions = { method: 'GET', headers: authHeader(), signal};
    return fetch(`${config.apiUrl}/api/users`, requestOptions).then(handleResponse);
}

function getById(id) {
    const requestOptions = { method: 'GET', headers: authHeader() };
    return fetch(`${config.apiUrl}/api/users/${id}`, requestOptions).then(handleResponse);
}