import React from 'react';

import { userService } from '../_services';
import { handleAbort } from '../_helpers';

class UsersPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            users: null
        };
        this.abortController = new AbortController();
    }

    componentDidMount() {
        userService.getAll( this.abortController.signal )
            .then(response => this.setState({users: response.users}))
            .catch((error) => handleAbort(error))
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const {users} = this.state;

        return (
            <div>
                <h1>Users</h1>
                <div>
                    {users &&
                    <ul className="list-group">
                        {users.map(user =>
                            <li className="list-group-item" key={user.id}>{user.username}</li>
                        )}
                    </ul>
                    }
                </div>
            </div>

        );

    }
}

export { UsersPage };