import React from "react"
import { Router } from "@reach/router"
import Layout from "../templates/Layout/Layout"
// import Profile from "../components/profile"
// import Login from "../components/login"
// import PrivateRoute from "../components/Auth/PrivateRoute";
// import Tasks from "../components/Tasks";
// import Profile from "../components/Profile/Profile";

const App = () => (
    <Layout>
        <Router>
            <PrivateRoute path="/app/tasks" component={Tasks}/>
            <PrivateRoute path="/app/profile" component={Profile}/>
        </Router>
    </Layout>
);

export default App