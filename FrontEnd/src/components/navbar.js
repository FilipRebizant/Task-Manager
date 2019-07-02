import React from "react"
import { Link } from "gatsby"

const Navigation = () => (
    <nav>
        <ul>
            <li><Link to="/page-2/">Go to page 2</Link></li>
            <li><Link to="/tasks/">Tasks</Link></li>
        </ul>
    </nav>
);

export default Navigation