import { authenticationService } from '../_services';

export function handleResponse(response) {
    return response.json().then(response => {

        if ([401, 403].indexOf(response.code) !== -1) {
            if (response.message === "Expired JWT Token") {
                authenticationService.refreshToken(authenticationService.currentUserValue.username);
                // location.reload(true);
            }

            // if (!response.token) {

            // }
            const error = (response && response.message);

            return Promise.reject(error);
        }

        return response;
    });
}

// export function handleLoginResponse(response) {
//     return response.json().then(response => {
//         // const data = response && JSON.parse(response);
//
//         console.log(response);
//         if (!response.token) {
//             if ([401, 403].indexOf(response.code) !== -1) {
//                 console.log(response);
//             }
//
//             const error = (response && response.message) || response.statusText;
//             return Promise.reject(error);
//         }
//
//         return response;
//     });
// }