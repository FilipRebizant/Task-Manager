import React from "react";

import { userService, authenticationService } from '../_services';
import { handleError } from '../_helpers';

class ProfilePage extends React.PureComponent {
    constructor(props) {
        super(props);

        this.state = {
            currentUser: authenticationService.currentUserValue,
            userFromApi: null
        };
        this.abortController = new AbortController();
    }

    componentDidMount() {
        const { currentUser } = this.state;
        userService.getById(currentUser.id, this.abortController.signal)
            .then(userFromApi => {
                if (userFromApi) this.setState({ userFromApi })
            })
            .catch((error) => handleError(error));
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const {userFromApi} = this.state;

        return(
            <div>
                {!userFromApi &&
                    <div className="loader">
                        <div className="spinner-border" role="status">
                            <span className="sr-only">Loading...</span>
                        </div>
                    </div>
                }

                {userFromApi &&
                    <div>
                        <p>Your role is: {userFromApi && <strong>{userFromApi.role}</strong>}</p>
                        Account info:
                        <ul>
                            <li>ID: {userFromApi.id}</li>
                            <li>Username: {userFromApi.username}</li>
                            <li>Email: {userFromApi.email}</li>
                        </ul>
                    </div>
                }
            </div>
        );
    }
}

export { ProfilePage };