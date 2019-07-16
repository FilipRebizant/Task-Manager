import React, {Component} from "react"

import { authHeader } from '../_helpers/auth-header';
import { handleAbort } from '../_helpers/handle-abort';
import { config } from '../_config';
import { handleResponse } from "../_helpers";
import  Task  from '../_components/Task';

class TasksPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tasks: {
                Todo: [],
                Pending: [],
                Done: []
            },
            info: null,
            error: null
        };
        this.abortController = new AbortController();
    };

    loadTasks(status) {
        let loaders = document.querySelectorAll('.loader');

        fetch(`${config.apiUrl}/api/tasks?status=${status}`, {
            headers: authHeader(),
            signal: this.abortController.signal
        }).then(handleResponse).then((response) => {
            for (var loader of loaders) {
                loader.classList.add('d-none');
            }

            const status = response.tasks[0].status;
            let currState = Object.assign({},  this.state);

            currState.tasks[status.toString()] = response.tasks;
            this.setState(currState);

        }).catch(error => handleAbort(error));
    }

    changeStatus = (index, e) => {
        let newStatus;
        const status = e.target.dataset.taskStatus;
        const id = e.target.dataset.taskId;

        if (status === "Todo") {
            newStatus = "Pending";
        } else if (status === "Pending") {
            newStatus = "Done";
        } else {
            newStatus = "Todo";
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
            const currentList = Object.assign([], this.state.tasks[status.toString()]);
            const stateCopy = Object.assign({}, this.state);
            let elem = currentList[index];

            currentList.splice(index, 1);
            stateCopy.tasks[status.toString()] = currentList;

            // Change
            elem.status = newStatus;

            stateCopy.tasks[newStatus.toString()].push(elem);

            this.setState({
                stateCopy,
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
        const stateCopy = Object.assign({}, this.state);
        const taskId = e.target.dataset.taskId;

        tasks.splice(index, 1);
        stateCopy.tasks[status.toString()] = tasks;
        this.setState({ stateCopy });

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

    componentDidMount() {
        this.loadTasks('todo');
        this.loadTasks('pending');
        this.loadTasks('done');
    }

    componentWillUnmount() {
        this.abortController.abort();
    }

    render() {
        const { info, error } = this.state;

        return (
            <div className="container">
                <h2 className="text-center my-3">Tasks</h2>

                { info &&
                    <div className="alert alert-info">{ info }</div>
                }

                { error &&
                    <div className="alert alert-danger">{ error }</div>
                }

                <div id="tasksContainer">
                    <div className="row">

                        {Object.keys(this.state.tasks).map((set, index) => {
                            console.log(set);
                            console.log(index);

                           return <ul id={set} className="col-sm-4" key={index}>
                                {this.state.tasks[set].map((task, index) => {
                                    return <Task
                                        key={task.id}
                                        id={task.id}
                                        status={task.status}
                                        description={task.description}
                                        priority={task.priority}
                                        user={task.user}
                                        createdAt={task.created_at}
                                        updatedAt={task.updated_at}

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