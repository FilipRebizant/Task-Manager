import React from 'react';
import { Router, Route } from 'react-router-dom';

import { history } from '../_helpers';
import { PrivateRoute } from '../_components';
import { HomePage } from '../HomePage';
import  Navigation  from '../_components/Navigation/Navigation';

// import { AdminPage } from '@/AdminPage';
import { LoginPage } from '../LoginPage/LoginPage';

class App extends React.Component {
    render() {
        return (
            <Router history={history}>
                <div>
                    <Navigation />
                    <div className="jumbotron">
                        <div className="container">
                            <div className="row">
                                <div className="col-md-6 offset-md-3">
                                    <PrivateRoute exact path="/" component={HomePage} />
                                    <Route path="/login" component={LoginPage} />
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