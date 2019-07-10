import { authenticationService } from '../_services';

export function handleResponse(response) {
    return response.json().then(response => {
        // const data = response && JSON.parse(response);

        console.log(response);
        if (!response.token) {
            if ([401, 403].indexOf(response.status) !== -1) {
                // auto logout if 401 Unauthorized or 403 Forbidden response returned from api
                authenticationService.logout();
                // location.reload(true);
            }

            const error = (response && response.message) || response.statusText;
            return Promise.reject(error);
        }

        return response;
    });
}