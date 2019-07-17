import React, {Component} from "react";
import {config} from "../../_config";
import {MDBBtn, MDBModal, MDBModalBody, MDBModalFooter, MDBModalHeader} from "mdbreact";

import {authHeader, handleResponse} from '../../_helpers';

export class AddTaskModal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isOpen: false,
            title: '',
            description: '',
            assignedUser: null,
            priority: null,
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


    addTask = () => {
        const {title, description, priority, assignedUser} = this.state;

        fetch(`${config.apiUrl}/api/tasks`, {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify({
                title: title,
                description: description,
                priority: priority,
                username: assignedUser
            })
        }).then(handleResponse)
            .then((response) => {
                document.getElementById('createTaskForm').reset();
                this.setState({
                    title: null,
                    description: null,
                    assignedUser: null,
                    priority: null,
                    error: null,
                    info: response.result
                });
                this.props.addTaskEvent();
            })
            .catch((error) => {
                this.setState({
                    info: null,
                    error: error
                });
            });
    };

    render() {
        const {users} = this.props;
        const {error, info} = this.state;

        return (
            <div className="text-center mb-3">
                <MDBBtn color="primary" onClick={this.toggleModal}>Add Task</MDBBtn>
                <MDBModal isOpen={this.state.isOpen} toggle={this.toggleModal} className="modal-dialog-centered">
                    <MDBModalHeader toggle={this.toggleModal}>Add Task</MDBModalHeader>
                    <MDBModalBody>

                        {info &&
                        <div className="alert alert-info">{info}</div>
                        }

                        {error &&
                        <div className="alert alert-danger">{error}</div>
                        }

                        <form action={`${config.apiUrl}/api/tasks`} method="post" id="createTaskForm">
                            <div className="form-group">
                                <label htmlFor="taskTitle">Title</label>
                                <input type="text"
                                       id="taskTitle"
                                       className="form-control"
                                       name="title"
                                       required
                                       onChange={this.handleChange}/>
                            </div>
                            <div className="form-group">
                                <label htmlFor="taskPriority">Task priority</label>
                                <input className="form-control"
                                       id="taskPriority"
                                       type="number"
                                       name="priority"
                                       required
                                       onChange={this.handleChange}
                                />
                            </div>

                            <div className="form-group">
                                <label htmlFor="description">Description</label>
                                <textarea className="form-control"
                                          name="description"
                                          onChange={this.handleChange}
                                          id="description"
                                          required></textarea>
                            </div>

                            <div className="form-group">
                                <label htmlFor="assignedUser">Assign user</label>
                                <select className="form-control"
                                        name="assignedUser"
                                        id="assignedUser"
                                        onChange={this.handleChange}>

                                    <option value=""></option>

                                    {users.map((user) => {
                                        return <option key={user.id} value={user.username}>{user.username}</option>
                                    })}

                                </select>
                            </div>
                        </form>
                    </MDBModalBody>
                    <MDBModalFooter>
                        <MDBBtn color="secondary" onClick={this.toggleModal}>Close</MDBBtn>
                        <MDBBtn color="primary" onClick={this.addTask}>Save changes</MDBBtn>
                    </MDBModalFooter>
                </MDBModal>
            </div>
        );
    }
}

