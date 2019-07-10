import React, {Component} from "react"
import Layout from "../templates/Layout/Layout"

// import { dateToString } from "../helpers/date-to-string";

export default class TasksIndex extends Component {
    constructor(props) {
        super(props);
        this.state = {
            todo: [],
            pending: [],
            done: [],
        }
    };

    loadTasks(status) {
        let loaders = document.querySelectorAll('.loader');
        let token = localStorage.getItem('token');

        fetch(`http://localhost:8080/api/tasks?status=${status}`, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        }).then(function (response) {
            return response.json();
        }).then((response) => {
            for (var loader of loaders) {
                loader.classList.add('d-none');
            }
            let tasks = response.tasks.map((task) => {
                return(
                    <div key={task.id} className="col-sm-12 mb-3">
                        <div className="card text-center">
                            <div className="task__main_header">
                                <p className="card-text">Created: <span className="task__date"> {dateToString(task.created_at)}</span></p>
                                <p className="card-text">{task.updated_at === null ? "Not updated" : `Updated: <span className="task__date"> {dateToString(task.updated_at)}</span>`}</p>
                            </div>
                            <div className="task__secondary_header">
                                <button className="task__text_button deleteTaskButton" data-task-status="{task.status}"
                                        data-task-id="{task.id}">Delete
                                </button>
                                <p className="card-text">{task.user === null && task.status === 'Todo' ? <button data-task-id={task.id} className="assignTaskButton">Assign to me</button> : task.user}</p>
                                <p className="card-text">Priority: {task.priority}</p>
                            </div>
                            <div className="card-body">
                                <h5 className="card-title">{task.title}</h5>
                                <p className="card-text">Status: <span className="font-weight-bold">{task.status}</span>
                                </p>
                                <p className="card-text">{task.description}</p>
                                <button data-task-status="${task.status}" data-task-id="${task.id}"
                                        className="btn btn-primary changeStatusButton">{task.status === "Todo" ? "Move to Pending" : task.status === "Pending" ? "Move to Done" : "Need work"}</button>
                            </div>
                        </div>
                    </div>
                )
            });

            this.setState({[status]: tasks});

        }).catch(error => console.error('Error', error));
    }

    componentDidMount() {
        this.loadTasks('todo');
        this.loadTasks('pending');
        this.loadTasks('done');
    }

    render() {
        return (
            <Layout>
                <div className="container">
                    <h2 className="text-center my-3">Tasks</h2>
                    <div id="tasksContainer">
                        <div className="row">
                            <div id="todo" className="col-sm-4">
                                {this.state.todo}
                                <div className="loader">
                                    <div className="spinner-border" role="status">
                                        <span className="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div id="pending" className="col-sm-4">
                                {this.state.pending}
                                <div className="loader">
                                    <div className="spinner-border" role="status">
                                        <span className="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div id="done" className="col-sm-4">
                                {this.state.done}
                                <div className="loader">
                                    <div className="spinner-border" role="status">
                                        <span className="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Layout>
        );
    };
}
