import React, {Component} from "react";
import {MDBBtn, MDBModal, MDBModalBody, MDBModalFooter, MDBModalHeader} from "mdbreact";
import {config} from "../../_config";
import {Role} from '../../_helpers/role';

import {authHeader, handleResponse} from '../../_helpers';

export class AddUserModal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isOpen: false,
            email: '',
            username: '',
            role: '',
            error: null,
            info: null
        };
    }

    handleChange = (e) => {
        this.setState({[e.target.name]: e.target.value});
    };

    toggleModal = () => {
        this.setState({
            isOpen: !this.state.isOpen
        });
    };


    addUser = () => {
        const {role, username, email} = this.state;
        let newRole = role.toUpperCase();

        fetch(`${config.apiUrl}/api/users`, {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify({
                email: email,
                username: username,
                role: newRole
            })
        }).then(handleResponse)
            .then((response) => {
                document.getElementById('createUserForm').reset();
                this.setState({
                    email: null,
                    username: null,
                    role: null,
                    error: null,
                    info: response.result
                });
                this.props.addUserEvent();
            })
            .catch((error) => {
                this.setState({
                    info: null,
                    error: error
                });
            });
    };

    render() {
        // const {users} = this.props;
        const {error, info} = this.state;

        return (
            <div className="text-center mb-3">
                <MDBBtn color="primary" onClick={this.toggleModal}>Add User</MDBBtn>
                <MDBModal isOpen={this.state.isOpen} toggle={this.toggleModal} className="modal-dialog-centered">
                    <MDBModalHeader toggle={this.toggleModal}>Add User</MDBModalHeader>
                    <MDBModalBody>

                        {info &&
                        <div className="alert alert-info">{info}</div>
                        }

                        {error &&
                        <div className="alert alert-danger">{error}</div>
                        }

                        <form action={`${config.apiUrl}/api/users`} method="post" id="createUserForm">
                            <div className="form-group">
                                <label htmlFor="username">Username</label>
                                <input type="text"
                                       id="username"
                                       className="form-control"
                                       name="username"
                                       required
                                       onChange={this.handleChange}/>
                            </div>
                            <div className="form-group">
                                <label htmlFor="email">Email</label>
                                <input className="form-control"
                                       id="email"
                                       type="email"
                                       name="email"
                                       required
                                       onChange={this.handleChange}
                                />
                            </div>

                            <div className="form-group">
                                <label htmlFor="role">Role</label>
                                <select className="form-control"
                                        name="role"
                                        id="role"
                                        onChange={this.handleChange}>

                                        <option></option>

                                        {Object.keys(Role).map((role) => {
                                            return <option key={role} value={role}>{role}</option>
                                        })}

                                </select>
                            </div>
                        </form>
                    </MDBModalBody>
                    <MDBModalFooter>
                        <MDBBtn color="secondary" onClick={this.toggleModal}>Close</MDBBtn>
                        <MDBBtn color="primary" onClick={this.addUser}>Save changes</MDBBtn>
                    </MDBModalFooter>
                </MDBModal>
            </div>
        );
    }
}

