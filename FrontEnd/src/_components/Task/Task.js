import React from 'react';
import { dateToString } from "../../_helpers/date-to-string";

export const Task = (props) => {
    let updatedAt = null;

    if (props.updatedAt) {
        updatedAt = <p className="card-text">Updated <span className="task__date"> {dateToString(props.updatedAt)} </span></p>;
    } else {
        updatedAt = <p className="card-text">Not Updated</p>;
    }

    return(
        <li className="col-sm-12 mb-3 task__list_item">
            <div className="card text-center">
                <div className="task__main_header">
                    <p className="card-text">Created<span className="task__date"> {dateToString(props.createdAt)}</span></p>
                    { updatedAt }
                </div>
                <div className="task__secondary_header">
                    <button className="task__text_button deleteTaskButton"
                            data-task-status={props.status}
                            data-task-id={props.id}
                            onClick={props.deleteEvent}
                    >Delete
                    </button>
                    <p className="card-text">{props.user === null && props.status === 'Todo' ? <button data-task-id={props.id} className="assignTaskButton" onClick={props.assignUserEvent}>Assign to me</button> : props.user}</p>
                    <p className="card-text">Priority: {props.priority}</p>
                </div>
                <div className="card-body">
                    <h5 className="card-title">{props.title}</h5>
                    <p className="card-text">Status: <span className="font-weight-bold">{props.status}</span>
                    </p>
                    <p className="card-text">{props.description}</p>

                    <button data-task-status={props.status} data-task-id={props.id} onClick={props.changeStatusEvent}
                            className="btn btn-primary changeStatusButton">{props.status === "Todo" ? "Move to Pending" : props.status === "Pending" ? "Move to Done" : "Need work"}</button>
                </div>
            </div>
        </li>
    )
};
