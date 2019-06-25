import React, {Component} from 'react';
import {
    Collapse,
    Navbar,
    NavbarNav,
    NavbarToggler,
    NavItem,
    NavLink
} from 'mdbreact';
import AuthButton from './Auth/AuthButton';


class NavBar extends Component {
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
                    <NavbarNav left >
                        <NavItem>
                            <NavLink to="/">Task-Manager</NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink to="/users">Users</NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink to="/tasks" token={this.state.token}>Tasks</NavLink>
                        </NavItem>
                        <NavItem>
                            <AuthButton/>
                        </NavItem>
                    </NavbarNav>
                </Collapse>
            </Navbar>
        );
    }
}

export default NavBar;