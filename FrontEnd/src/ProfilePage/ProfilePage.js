import React from "react";

import { userService, authenticationService } from '../_services';

class ProfilePage extends React.PureComponent {
    constructor(props) {
        super(props);

        this.state = {
            currentUser: authenticationService.currentUserValue,
            userFromApi: null
        };
    }

    componentDidMount() {
        const { currentUser } = this.state;
        userService.getById(currentUser.id).then(userFromApi => this.setState({ userFromApi }));
    }

    render() {
        const {currentUser, userFromApi} = this.state;

        return(
            <div>
                <p>Your role is: {userFromApi && <strong>{userFromApi.role}</strong>}</p>
                <p>This page can be accessed by all authenticated users.</p>
                <div>
                    Current user from secure api end point:
                    {userFromApi &&
                    <ul>
                        <li>{userFromApi.id}</li>
                        <li>{userFromApi.username}</li>
                    </ul>
                    }
                </div>
            </div>
        );
    }
}

export { ProfilePage };