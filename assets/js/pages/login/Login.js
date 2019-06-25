import React, {Component} from 'react';
import {MDBContainer, MDBRow, MDBCol, MDBBtn, MDBAlert} from 'mdbreact';

class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: {},
            username: '',
            password: ''
        };

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleFormSubmit = this.handleFormSubmit.bind(this);
        this.handleKeyPress = this.handleKeyPress.bind(this);
    }

    componentDidMount() {

    }

    handleFormSubmit(e) {
        e.preventDefault();
        const loginForm = e.target;

        fetch(loginForm.getAttribute('action'), {
            method: 'post',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
                username: this.state.username,
                password: this.state.password
            })
        }).then((response) => response.json())
            .then((response) => {

                // If there is an authorisation error
                if (response.code === 401) {
                    // Show error
                    const loginErrorContainer = document.getElementById('loginErrorContainer');
                    loginErrorContainer.innerText = response.message;
                    loginErrorContainer.classList.remove('d-none');
                }

                // Save token to localStorage
                if (typeof (Storage) !== "undefined") {
                    localStorage.setItem("token", response.token);
                }
            });
    }

    handleInputChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleKeyPress(e) {
        if (e.keyCode === 13) return this.handleFormSubmit;
    }

    render() {
        return (
            <MDBContainer>
                <MDBRow>
                    <MDBCol md="6">
                        <form method="post" action="/login_check" className="login__form" onSubmit={this.handleFormSubmit}>
                            <div className="alert alert-danger d-none" id="loginErrorContainer"></div>
                            <h1 className="h3 my-3 font-weight-normal">Please sign in</h1>

                            <div className="form-group">
                                <label htmlFor="inputUsername" className="sr-only">Username</label>
                                <input type="text" name="username" id="inputUsername"
                                       className="form-control"
                                       placeholder="Username" autoFocus
                                       onChange={this.handleInputChange}
                                       onKeyDown={this.handleKeyPress}
                                       required
                                    />
                            </div>
                            <div className="form-group">
                                <label htmlFor="inputPassword" className="sr-only">Password</label>
                                <input type="password" name="password" id="inputPassword" className="form-control"
                                       placeholder="Password"
                                       onChange={this.handleInputChange}
                                       onKeyDown={this.handleKeyPress}
                                       required/>
                            </div>
                            <input type="hidden" name="_csrf_token"
                                   value="{{ csrf_token('authenticate') }}"
                            />
                            <div className="form-group">
                                <MDBBtn className="btn btn-lg btn-primary" type="submit">
                                    Sign in
                                </MDBBtn>
                            </div>
                        </form>
                    </MDBCol>
                </MDBRow>

            </MDBContainer>
        );

    }
}

export default Login;