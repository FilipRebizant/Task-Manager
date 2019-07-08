import React from "react"
import { Link } from "gatsby"

const Navigation = () => (
    <nav>
        <ul>
            <li><Link to="/">Home</Link></li>
            <li><Link to="/page-2/">Go to page 2</Link></li>
            <li><Link to="/tasks/">Tasks</Link></li>
            <li><Link to="/login/">Login</Link></li>
        </ul>
    </nav>
);

export default Navigation