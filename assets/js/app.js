require('../css/app.scss');

import React from 'react';
import ReactDOM from 'react-dom';

class App extends React.Component {
    constructor() {
        super();
        this.state = {

        };
        console.log('react');
    }

    render() {
        return (
            <div>test</div>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('root'));
