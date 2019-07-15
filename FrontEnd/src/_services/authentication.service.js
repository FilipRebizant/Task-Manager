import { BehaviorSubject } from 'rxjs';
import { config } from '../_config';
import { handleLoginResponse } from '../_helpers';

const currentUserSubject = new BehaviorSubject(JSON.parse(localStorage.getItem('currentUser')));

export const authenticationService = {
    login,
    logout,
    refreshToken,
    currentUser: currentUserSubject.asObservable(),
    get currentUserValue () { return currentUserSubject.value }
};

function login(username, password) {
    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
    };

    return fetch(`${config.apiUrl}/api/login_check`, requestOptions)
        .then(handleLoginResponse)
        .then(response => {
            let user = JSON.stringify({
                "token": response.token,
                "id": response.data.id,
                "username": response.data.username,
                "roles": response.data.roles
            });
            // store user details and jwt token in local storage to keep user logged in between page refreshes
            localStorage.setItem('currentUser', user);
            currentUserSubject.next(user);

            return user;
        });
}

function logout() {
    // remove user from local storage to log user out
    localStorage.removeItem('currentUser');
    currentUserSubject.next(null);
}

function refreshToken(username) {

    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({"username": username})
    };
    return fetch(`${config.apiUrl}/api/token/refresh`, requestOptions)
        .then(handleLoginResponse)
        .then(response => {
            let currentUser = JSON.parse(localStorage.getItem('currentUser'));
            currentUser.token = response.token;
            let refreshedUser = JSON.stringify(currentUser);
            localStorage.setItem('currentUser', refreshedUser);
            currentUserSubject.next(currentUser);

            return refreshedUser;
        });
}