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

import Home from './pages/Home';
import TasksIndex from './pages/tasks/TasksIndex';
import UsersIndex from './pages/users/UsersIndex';
import Login from './pages/login/Login';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
             token: ''
        }
   };

    componentWillMount() {
        const tokenContainer = document.getElementById('token');
        let token = tokenContainer.innerText;
        this.setState({
                          token: token
                      });
        console.log(this.state.token);
    }

    render() {
        return (
            <Router>
                <Navbar token={this.state.token}/>
                <Switch>
                    <Route path="/" component={Home} exact/>
                    <Route path="/users" render={(props) => <UsersIndex token={this.state.token}/>}/>
                    <Route path="/tasks" render={(props) => <TasksIndex token={this.state.token}/>}/>
                    <Route path="/login" component={Login}/>
                </Switch>
            </Router>
        );
    }
}

render(<App />, document.getElementById('root'));
