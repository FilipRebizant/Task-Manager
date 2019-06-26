import React, {Component} from 'react';
import {MDBContainer, MDBRow, MDBCol} from 'mdbreact';
import Auth from '../../Components/Auth/Auth';

class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isShowingError: false,
            username: '',
            password: '',
            redirectToReferer: false
        };

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleFormSubmit = this.handleFormSubmit.bind(this);
        this.handleKeyPress = this.handleKeyPress.bind(this);
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
                    this.setState({isShowingError: true});
                    const loginErrorContainer = document.getElementById('loginErrorContainer');
                    loginErrorContainer.innerText = response.message;

                    return;
                }

                // Save token to localStorage
                if (typeof (Storage) !== "undefined") {
                    localStorage.setItem("token", response.token);
                }

                // Authorise
                Auth.authenticate(() => {
                   this.setState(() => ({
                       redirectToReferer: true
                   }));
                });

                // Redirect to homepage
                this.props.history.push("/");
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
        let errorContainer;
        if (this.state.isShowingError) {
            errorContainer = <div className="alert alert-danger" id="loginErrorContainer"></div>;
        }

        return (
            <MDBContainer>
                <MDBRow center>
                    <MDBCol md="6">
                        <form method="post" action="/login_check" className="login__form" onSubmit={this.handleFormSubmit}>
                            {errorContainer}
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

                            <div className="form-group">
                                <button className="btn btn-lg btn-primary" type="submit">
                                    Sign in
                                </button>
                            </div>
                        </form>
                    </MDBCol>
                </MDBRow>
            </MDBContainer>
        );
    }
}

export default Login;