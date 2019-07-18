import React from 'react';

export class User extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <tr>
                <td>{this.props.username}</td>
                <td>{this.props.email}</td>
                <td>{this.props.activated_at ? 'Active': 'Not active'}</td>
                <td>{this.props.role}</td>
                <td><button className="btn btn-danger" data-user-id={this.props.id} onClick={this.props.deleteUserEvent}>Delete</button></td>
            </tr>
        )
    }

}
