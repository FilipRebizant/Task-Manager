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
            info: null
        };
        this.abortController = new AbortController();
    };

    loadTasks(status) {
        let loaders = document.querySelectorAll('.loader');

        fetch(`${config.apiUrl}/api/tasks?status=${status}`, {
            headers: authHeader(),
            signal: this.abortController.signal
        }).then(function (response) {
            return response.json();
        }).then((response) => {
            for (var loader of loaders) {
                loader.classList.add('d-none');
            }

            const status = response.tasks[0].status;

            let currState = Object.assign({},  this.state);
            currState.tasks[status.toString()] = response.tasks;


            this.setState(currState);

        }).catch(error => handleAbort(error));
    }

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
                console.log(response);
                this.setState({ info: response.response });
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
        const { info } = this.state;

        return (
            <div className="container">
                <h2 className="text-center my-3">Tasks</h2>

                { info &&
                    <div className="alert alert-info">{ info }</div>
                }

                <div id="tasksContainer">
                    <div className="row">
                        <ul id="todo" className="col-sm-4">
                            {this.state.tasks['Todo'].map((task, index) => {
                                return <Task
                                    key={task.id}
                                    id={task.id}
                                    status={task.status}
                                    description={task.description}
                                    priority={task.priority}
                                    user={task.user}
                                    createdAt={task.created_at}
                                    updatedAt={task.updated_at}
                                    deleteEvent = {this.deleteTask.bind(this, index)}
                                />
                            })}

                            <div className="loader">
                                <div className="spinner-border" role="status">
                                    <span className="sr-only">Loading...</span>
                                </div>
                            </div>
                        </ul>
                        <div id="pending" className="col-sm-4">

                            {this.state.tasks['Pending'].map((task, index) => {
                                return <Task
                                    key={task.id}
                                    id={task.id}
                                    status={task.status}
                                    description={task.description}
                                    priority={task.priority}
                                    user={task.user}
                                    createdAt={task.created_at}
                                    updatedAt={task.updated_at}
                                    deleteEvent = {this.deleteTask.bind(this, index)}
                                />
                            })}

                            <div className="loader">
                                <div className="spinner-border" role="status">
                                    <span className="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div id="done" className="col-sm-4">

                            {this.state.tasks['Done'].map((task, index) => {
                                return <Task
                                    key={task.id}
                                    id={task.id}
                                    status={task.status}
                                    description={task.description}
                                    priority={task.priority}
                                    user={task.user}
                                    createdAt={task.created_at}
                                    updatedAt={task.updated_at}
                                    deleteEvent = {this.deleteTask.bind(this, index)}
                                />
                            })}

                            <div className="loader">
                                <div className="spinner-border" role="status">
                                    <span className="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
}

export { TasksPage };