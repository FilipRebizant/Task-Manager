import React, { Component } from "react";
import { Link } from "gatsby";
import {
    Collapse,
    Navbar,
    NavbarNav,
    NavbarToggler,
    NavItem,
    MDBNavLink
} from 'mdbreact';

import { getUser, isLoggedIn } from "../../services/auth";

class Navigation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            collapse: false,
            isWideEnough: false,
        };
        this.onClick = this.onClick.bind(this);
    }

    onClick() {
        this.setState({
            collapse: !this.state.collapse,
        });
    }

    componentDidMount() {
        let links = document.getElementsByClassName('nav-link');

        for (let link of links) {
            link.onclick = function () {
                for (let elem of links) {
                    elem.parentElement.classList.remove('active');
                }

                link.parentElement.classList.add('active');
            };
        }
    }

    render() {
        return (
            <Navbar color="white" light expand="md" scrolling>
                {!this.state.isWideEnough && <NavbarToggler onClick={this.onClick}/>}
                <Collapse isOpen={this.state.collapse} navbar>
                    <NavbarNav left>
                        <h1>Hello {isLoggedIn() ? getUser().name : "world"}!</h1>
                        <p>
                            {isLoggedIn() ? (
                                <>
                                    You are logged in, so check your{" "}
                                    <Link to="/app/profile">profile</Link>
                                </>
                            ) : (
                                <>
                                    You should <Link to="/app/login">log in</Link> to see restricted
                                    content
                                </>
                            )}
                        </p>
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
                </Collapse>
            </Navbar>
        );
    };
}

export default Navigation