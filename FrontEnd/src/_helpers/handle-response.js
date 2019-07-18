import { authenticationService } from '../_services';

export function handleResponse(response) {

    return response.json().then(response => {

        if ([401, 403].indexOf(response.code) !== -1 || response.error && [400, 404].indexOf(response.error.status) !== -1) {
            if (response.message === "Expired JWT Token") {
                let refresh = function () {
                    if (refresh.done) return;

                    authenticationService.refreshToken(authenticationService.currentUserValue.username).then(() => {
                        location.reload(true);
                    });
                };

                refresh();
            }

            const error = (response && response.message || response.error.message);

            return Promise.reject(error);
        }

        return response;
    });
}