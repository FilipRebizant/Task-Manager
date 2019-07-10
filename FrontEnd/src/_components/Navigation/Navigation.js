import React, { Component } from "react";

import {
    Collapse,
    Navbar,
    NavbarNav,
    NavbarToggler,
    NavItem,
    MDBNavLink
} from 'mdbreact';

import {authenticationService} from "../../_services";
import {history, Role} from "../../_helpers";
import {Link} from "react-router-dom";

class Navigation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            collapse: false,
            isWideEnough: false,
            currentUser: null,
            isAdmin: false
        };
        this.onClick = this.onClick.bind(this);
    }

    onClick() {
        this.setState({
            collapse: !this.state.collapse,
        });
    }

    componentDidMount() {
        // Handle active links
        let links = document.getElementsByClassName('nav-link');

        for (let link of links) {
            link.onclick = function () {
                for (let elem of links) {
                    elem.parentElement.classList.remove('active');
                }

                link.parentElement.classList.add('active');
            };
        }

        // Handle auth
        authenticationService.currentUser.subscribe(x => this.setState({
            currentUser: x,
            isAdmin: x && x.role === Role.Admin
        }));
    }

    logout() {
        authenticationService.logout();
        history.push('/login');
    }

    copy() {
/**
 *                    <NavbarNav left>
 <NavItem>
 <Link to="/">Task-Manager</Link>
 </NavItem>
 <NavItem>
 <Link to="/app/users">Users</Link>
 </NavItem>
 <NavItem>
 <Link to="/app/tasks">Tasks</Link>
 </NavItem>
 <NavItem>
 <Link to="/app/profile">profile</Link>
 </NavItem>
 <NavItem>
 <Link to="/login">Login</Link>
 </NavItem>
 </NavbarNav>
 *
 * **/



        /**{currentUser &&
        <nav className="navbar navbar-expand navbar-dark bg-dark">
            <div className="navbar-nav">
                <Link to="/" className="nav-item nav-link">Home</Link>
                {isAdmin && <Link to="/admin" className="nav-item nav-link">Admin</Link>}
                <a onClick={this.logout} className="nav-item nav-link">Logout</a>
            </div>
        </nav>
        } **/
      /**  <h1>Hello {isLoggedIn() ? getUser().name : "world"}!</h1>
        <p>
        {isLoggedIn() ? (
            <div>
                You are logged in, so check your{" "}
                <Link to="/app/profile">profile</Link>
            </div>
        ) : (
            <div>
                You should <Link to="/app/login">log in</Link> to see restricted
                content
            </div>
        )}
    </p>**/
    }

    render() {
        const { currentUser, isAdmin } = this.state;

        return (
            <Navbar color="white" light expand="md" scrolling>
                {!this.state.isWideEnough && <NavbarToggler onClick={this.onClick}/>}
                <Collapse isOpen={this.state.collapse} navbar>
                    <nav className="navbar navbar-expand navbar-dark bg-dark">
                        <div className="navbar-nav">
                            <NavItem>
                                <Link to="/" className="nav-item nav-link">Task-Manager</Link>
                            </NavItem>
                            <NavItem>
                                <Link to="/users" className="nav-item nav-link">Users</Link>
                            </NavItem>
                            <NavItem>
                                <Link to="/tasks" className="nav-item nav-link">Tasks</Link>
                            </NavItem>
                            <NavItem>
                                <Link to="/profile" className="nav-item nav-link">Profile</Link>
                            </NavItem>
                            <NavItem>
                                <Link to="/login" className="nav-item nav-link">Login</Link>
                            </NavItem>
                            <NavItem>
                                {isAdmin && <Link to="/admin" className="nav-item nav-link">Admin</Link>}
                            </NavItem>
                            <NavItem>
                                <a onClick={this.logout} className="nav-item nav-link">Logout</a>
                            </NavItem>
                        </div>
                    </nav>
                </Collapse>
            </Navbar>
        );
    };
}

export default Navigation