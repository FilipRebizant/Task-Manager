import {withRouter} from 'react-router-dom';
import Auth from './Auth';
import React from 'react';
import {NavLink} from "mdbreact";

const AuthButton = withRouter(
    ({history}) =>
        Auth.isAuthenticated ? (
            <NavLink to="/login"
                     onClick={() => {
                         Auth.signOut();
                     }}
            >
                Sign out
            </NavLink>
        ) : <NavLink to="/login">Login</NavLink>
);

export default AuthButton;