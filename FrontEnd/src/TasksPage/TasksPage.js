import React, {Component} from "react"

import { authHeader } from '../_helpers/auth-header';
import { handleError } from '../_helpers';
import { config } from '../_config';
import {handleResponse, Role} from "../_helpers";
import  { AddTaskModal, Task } from '../_components/Task';
import {authenticationService} from "../_services";

class TasksPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tasks: {
                Todo: [],
                Pending: [],
                Done: []
            },
            users: [],
            info: null,
            error: null,
            currentUser: authenticationService.currentUserValue
        };
        this.abortController = new AbortController();
    };

    assignUser = (index, e) => {
        const id = e.target.dataset.taskId;
        const username = this.state.currentUser.username;
        const currentTaskList = Object.assign([], this.state.tasks['Todo']);
        const currentState = Object.assign({}, this.state);
        let elem = currentTaskList[index];

        elem.user = username;

        this.setState({
            currentState
        });

        fetch(`${config.apiUrl}/api/tasks/${id}/users/${username}`, {
            method: 'PATCH',
            headers: authHeader(),
            body: JSON.stringify({
                username: username
            })
        }).then(handleResponse).then((response) => {
            this.setState({
                info: response.response,
                error: null
            });
        });
    };

    loadTasks = (status) => {
        let loaders = document.querySelectorAll('.loader');

        fetch(`${config.apiUrl}/api/tasks?status=${status}`, {
            headers: authHeader(),
            signal: this.abortController.signal
        }).then(handleResponse).then((response) => {
            let currState = Object.assign({},  this.state);
            const status = response.tasks[0].status;

            for (var loader of loaders) {
                loader.classList.add('d-none');
            }

            currState.tasks[status.toString()] = response.tasks;
            this.setState(currState);
        }).catch(error => handleError(error));
    };

    changeStatus = (index, e) => {
        let newStatus;
        const status = e.target.dataset.taskStatus;
        const id = e.target.dataset.taskId;

        switch (status) {
            case 'Todo': newStatus = 'Pending'; break;
            case "Pending": newStatus = 'Done'; break;
            default: newStatus = 'Todo'; break;
        }

        fetch(`${config.apiUrl}/api/tasks/${id}`, {
            method: 'PATCH',
            headers: authHeader(),
            body: JSON.stringify({
                id: id,
                status: newStatus
            })
        }).then(handleResponse).then((response) => {

            // Remove from old list
            const currentTaskList = Object.assign([], this.state.tasks[status.toString()]);
            const currentState = Object.assign({}, this.state);
            let elem = currentTaskList[index];

            currentTaskList.splice(index, 1);
            currentState.tasks[status.toString()] = currentTaskList;

            // Change
            elem.status = newStatus;

            currentState.tasks[newStatus.toString()].push(elem);

            this.setState({
                currentState,
                info: response.response,
                error: null
            });
        }).catch((error) => {
          this.setState({
              info: null,
              error: error
          });
        });
    };

    deleteTask = (index, e) => {
        const status = e.target.dataset.taskStatus;
        const tasks = Object.assign([], this.state.tasks[status.toString()]);
        const currentState = Object.assign({}, this.state);
        const taskId = e.target.dataset.taskId;

        tasks.splice(index, 1);
        currentState.tasks[status.toString()] = tasks;
        this.setState({ currentState });

        fetch(`${config.apiUrl}/api/tasks/${taskId}`, {
            method: "DELETE",
            headers: authHeader()
        }).then(handleResponse)
            .then(response => {
                this.setState({
                    info: response.response,
                    error: null
                });
            });
    };

    loadUsers() {
        fetch(`${config.apiUrl}/api/users`, {
            headers: authHeader(),
            signal: this.abortController.signal
        }).then(handleResponse)
            .then((response => {
                this.setState({users: response.users})
            })).catch(error => handleError(error))
    }

    componentDidMount() {
        this.loadTasks('todo');
        this.loadTasks('pending');
        this.loadTasks('done');
        this.loadUsers();
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const { info, error, users, tasks } = this.state;

        return (
            <div className="container">
                <h2 className="text-center my-3">Tasks</h2>

                { info &&
                    <div className="alert alert-info">{ info }</div>
                }

                { error &&
                    <div className="alert alert-danger">{ error }</div>
                }

                <AddTaskModal users={users} addTaskEvent={(e) => this.loadTasks('Todo')}/>

                <div id="tasksContainer">
                    <div className="row">

                        {Object.keys(tasks).map((set, index) => {

                           return <ul id={set} className="col-sm-4" key={index}>
                                {tasks[set].map((task, index) => {
                                    return <Task
                                        key={task.id}
                                        id={task.id}
                                        title={task.title}
                                        status={task.status}
                                        description={task.description}
                                        priority={task.priority}
                                        user={task.user}
                                        createdAt={task.created_at}
                                        updatedAt={task.updated_at}

                                        assignUserEvent = {this.assignUser.bind(this, index)}
                                        changeStatusEvent = {this.changeStatus.bind(this, index)}
                                        deleteEvent = {this.deleteTask.bind(this, index)}
                                    />
                                })}

                                <div className="loader">
                                    <div className="spinner-border" role="status">
                                        <span className="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </ul>
                        })}

                    </div>
                </div>
            </div>
        );
    };
}

export { TasksPage };