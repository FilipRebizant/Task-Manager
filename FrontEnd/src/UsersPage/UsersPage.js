import React from 'react';

import { userService } from '../_services';
import { User, AddUserModal } from '../_components/User';

class UsersPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            users: [],
            info: null,
            error: null
        };
        this.abortController = new AbortController();
    }

    loadUsers = () => {
        userService.getAll(this.abortController.signal)
            .then((response) => {
                if (response){
                    this.setState({users: response.users})
                }
            })
    };

    deleteUser = (e, index) => {
      const userId = e.target.dataset.userId;
      const users = Object.assign([], this.state.users);
      const user = users[index];

      users.splice(index, 1);

      this.setState({users: users});

      userService.deleteUser(userId, this.abortController.signal)
          .then((response) => {
              this.setState({
                  info: response.result,
                  error: null
              });
          })
          .catch((error) => {
            users.splice(index, 0, user);
            this.setState({
                users: users,
                info: null,
                error: error
            });
          });
    };

    componentDidMount() {
        this.loadUsers();
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const { users, error, info } = this.state;
        return (
            <div>
                <h1 className="text-center">Users</h1>
                <div>
                    <AddUserModal addUserEvent={this.loadUsers}/>

                    {!users &&
                        <div className="loader">
                            <div className="spinner-border" role="status">
                                <span className="sr-only">Loading...</span>
                            </div>
                        </div>
                    }

                    {info &&
                        <div className="alert alert-info">{info}</div>
                    }

                    {error &&
                        <div className="alert alert-danger">{error}</div>
                    }

                    {users &&
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Activation status</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            {users.map( (user, index) => {
                               return <User
                                   key={user.id}
                                   id={user.id}
                                   username={user.username}
                                   email={user.email}
                                   role={user.role}
                                   deleteUserEvent={(e) => this.deleteUser(e, index)}/>
                            })}

                            </tbody>
                        </table>
                    }
                </div>
            </div>
        );
    }
}

export { UsersPage };