import React from 'react';

export const User = (props) => {
    return(
        <li className="list-group-item" key={props.id}>{props.username}</li>
    )
};
