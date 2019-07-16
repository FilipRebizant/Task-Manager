import React from 'react';
import { dateToString } from "../../_helpers/date-to-string";

const Task = (props) => {
    let updatedAt = 'Not updated';

    if (props.updatedAt) {
        updatedAt =  `Updated\: <span className="task__date"> {dateToString(props.updated_at)}</span>`;
    }

    return(
        <li className="col-sm-12 mb-3">
            <div className="card text-center">
                <div className="task__main_header">
                    <p className="card-text">Created: <span className="task__date"> {dateToString(props.createdAt)}</span></p>
                    <p className="card-text">{ updatedAt }</p>
                </div>
                <div className="task__secondary_header">
                    <button className="task__text_button deleteTaskButton"
                            data-task-status={props.status}
                            data-task-id={props.id}
                            onClick={props.deleteEvent}
                    >Delete
                    </button>
                    <p className="card-text">{props.user === null && props.status === 'Todo' ? <button data-task-id={props.id} className="assignTaskButton">Assign to me</button> : props.user}</p>
                    <p className="card-text">Priority: {props.priority}</p>
                </div>
                <div className="card-body">
                    <h5 className="card-title">{props.title}</h5>
                    <p className="card-text">Status: <span className="font-weight-bold">{props.status}</span>
                    </p>
                    <p className="card-text">{props.description}</p>
                    <button data-task-status={props.status} data-task-id={props.id}
                            className="btn btn-primary changeStatusButton">{props.status === "Todo" ? "Move to Pending" : props.status === "Pending" ? "Move to Done" : "Need work"}</button>
                </div>
            </div>
        </li>
    )
};

export default Task;