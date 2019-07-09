// export function authHeader() {
//     let token = JSON.parse(localStorage.getItem('token'));
//
//     return { 'Authorization': 'Bearer' + token};
// }

import { authenticationService } from '../_services';

export function authHeader() {
    // return authorization header with jwt token
    const currentUser = authenticationService.currentUserValue;
    if (currentUser && currentUser.token) {
        return { Authorization: `Bearer ${currentUser.token}` };
    } else {
        return {};
    }
}