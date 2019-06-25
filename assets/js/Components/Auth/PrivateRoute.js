import { Route, Redirect } from 'react-router-dom';
import React, {Component} from 'react';
import Auth from './Auth';

function PrivateRoute({ component: Component, ...rest }) {
        return <Route
            {...rest}
            render = { (props) => (
            Auth.isAuthenticated === true
                ? <Component {...props} />
                : <Redirect to={{
                        pathname: "/restricted",
                        state: {from: props.location}
                }}/>
        )}/>
};

export default PrivateRoute;