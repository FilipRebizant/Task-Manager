import React from "react";
import { withRouter } from 'react-router-dom';
import {MDBContainer, MDBRow, MDBCol, MDBBtn} from 'mdbreact';

const RestrictedPage = withRouter(
    ({ history }) => (
        <MDBContainer>
            <MDBRow center>
                <MDBCol >
                    <p className="my-3">You must log in to view the page</p>
                        <MDBBtn color="primary" onClick={() => history.push("/login")}>Log in</MDBBtn>
                </MDBCol>
            </MDBRow>
        </MDBContainer>

));

export default RestrictedPage;
