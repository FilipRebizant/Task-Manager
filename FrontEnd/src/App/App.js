import React from 'react';
import { Router, Route } from 'react-router-dom';

import { history } from '../_helpers';
import { PrivateRoute } from '../_components';
import  Navigation  from '../_components/Navigation/Navigation';


import { UsersPage } from '../UsersPage';
import { HomePage } from '../HomePage';
import { LoginPage } from '../LoginPage';
import { TasksPage } from '../TasksPage';
import { ProfilePage } from '../ProfilePage';

class App extends React.Component {
    render() {
        return (
            <Router history={history}>
                <div>
                    <Navigation />
                    <div className="jumbotron">
                        <div className="container">
                            <div className="row">
                                <div className="col-md-12">
                                    <Route exact path="/" component={HomePage} />
                                    <Route path="/login" component={LoginPage} />
                                    <PrivateRoute path="/tasks" component={TasksPage} />
                                    <PrivateRoute path="/users" component={UsersPage} />
                                    <PrivateRoute path="/profile" component={ProfilePage} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Router>
        );
    }
}

export { App };