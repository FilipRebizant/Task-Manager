import React from 'react';

import { userService } from '../_services';

class UsersPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            users: null,
            error: null
        };
        this.abortController = new AbortController();
    }

    componentDidMount() {
        userService.getAll( this.abortController.signal )
            .then(response => this.setState({users: response.users}))
            .catch(error => {
                if (error.name === 'AbortError') return;
            });
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const {users, error} = this.state;

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
                    {error &&
                    <div >
                        <div className="alert alert-danger">{error}</div>
                        <button></button>
                    </div>
                    }
                </div>
            </div>

        );

    }
}

export { UsersPage };