import('../css/app.scss');

import '@fortawesome/fontawesome-free/css/all.min.css';
import 'bootstrap-css-only/css/bootstrap.min.css';
import 'mdbreact/dist/css/mdb.css';

import React from 'react';
import { render } from 'react-dom';
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";

import Navbar from './Components/Navbar';
import PrivateRoute from './Components/Auth/PrivateRoute';

import Home from './pages/Home';
import TasksIndex from './pages/tasks/TasksIndex';
import UsersIndex from './pages/users/UsersIndex';
import Login from './pages/login/Login';
import RestrictedPage from  './pages/restricted/RestrictedPage';

class App extends React.Component {
    constructor(props) {
        super(props);
    };

    render() {
        return (
            <Router>
                <Navbar/>
                <Switch>
                    <PrivateRoute path="/" component={Home} exact/>
                    <PrivateRoute path="/users" component={UsersIndex} />
                    <PrivateRoute path="/tasks" component={TasksIndex} />
                    <Route path="/login" component={Login} />
                    <Route path="/restricted" component={RestrictedPage} />
                </Switch>
            </Router>
        );
    }
}

render(<App />, document.getElementById('root'));
