import React from "react";

import { userService, authenticationService } from '../_services';

class ProfilePage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            currentUser: authenticationService.currentUserValue,
            userFromApi: null
        };
    }

    componentDidMount() {
        const { currentUser } = this.state;
        console.log(currentUser.id);
        console.log(userService.getById(currentUser.id));
        userService.getById(currentUser.id).then(userFromApi => this.setState({ userFromApi }));
        // console.log(this.state.userFromApi);
    }

    render() {
        const {currentUser, userFromApi} = this.state;
        console.log(userFromApi);
        console.log(currentUser);
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