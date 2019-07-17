import React, { Component } from "react";

import {
    Collapse,
    Navbar,
    NavbarNav,
    NavbarToggler,
    NavItem,
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

    render() {
        const { currentUser, isAdmin } = this.state;
        let navItems;
        if (currentUser) {
            navItems =
                <div className="d-flex justify-content-between w-100">
                    <NavbarNav left>

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
                            {isAdmin && <Link to="/admin" className="nav-item nav-link">Admin</Link>}
                        </NavItem>

                    </NavbarNav>
                    <NavbarNav right>

                        <NavItem>
                            <Link to="/profile" className="nav-item nav-link">{ currentUser.username }</Link>
                         </NavItem>

                        <NavItem>
                            <Link to="/" onClick={this.logout} className="nav-item nav-link">Logout</Link>
                        </NavItem>
                    </NavbarNav>
                </div>
        } else {
            navItems =
            <NavbarNav className="justify-content-md-start">

                <NavItem>
                    <Link to="/" className="nav-item nav-link">Task-Manager</Link>
                </NavItem>

                 <NavItem>
                    <Link to="/login" className="nav-item nav-link">Login</Link>
                </NavItem>

            </NavbarNav>
        }

        return (
            <Navbar color="bg-dark navbar-dark" expand="md" scrolling>
                {!this.state.isWideEnough && <NavbarToggler onClick={this.onClick}/>}
                <Collapse isOpen={this.state.collapse} navbar>
                        {navItems}
                </Collapse>
            </Navbar>
        );
    };
}

export default Navigation