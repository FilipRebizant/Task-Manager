import React from 'react';
import {render} from 'react-dom';

import {App} from './App';

// setup fake backend
// import { configureFakeBackend } from './_helpers';
// configureFakeBackend();
console.log('app');

if (module.hot) {
    console.log('hot reload');
    module.hot.accept('./index.js', function() {
        render(
            <App/>,
            document.getElementById('app')
        );
    })
}

render(
    <App/>,
    document.getElementById('app')
);