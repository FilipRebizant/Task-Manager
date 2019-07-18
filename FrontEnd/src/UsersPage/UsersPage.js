import React from 'react';

import { userService } from '../_services';
import { handleAbort } from '../_helpers';
import { User, AddUserModal } from '../_components/User';

class UsersPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            users: null
        };
        this.abortController = new AbortController();
    }

    loadUsers = () => {
        userService.getAll( this.abortController.signal )
            .then(response => this.setState({users: response.users}))
            .catch((error) => handleAbort(error))
    };

    componentDidMount() {
        this.loadUsers();
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const {users} = this.state;

        return (
            <div>
                <h1 className="text-center">Users</h1>
                <div>

                    <AddUserModal addUserEvent={this.loadUsers}/>

                    {!users && <div className="loader">
                        <div className="spinner-border" role="status">
                            <span className="sr-only">Loading...</span>
                        </div>
                    </div>
                    }
                    {users &&
                    <table>
                        <thead>
                        <th>Username</th>
                        <th>Email</th>
                        </thead>
                        <tbody>

                        {users.map(user =>
                            <tr>
                                <User key={user.id} id={user.id} username={user.username}/>
                            </tr>
                        )}
                        </tbody>
                    </table>
                    }
                </div>
            </div>
        );

    }
}

export { UsersPage };