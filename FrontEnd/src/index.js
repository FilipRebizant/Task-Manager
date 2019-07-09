import React from 'react';
import {render} from 'react-dom';

import {App} from './App';

// setup fake backend
// import { configureFakeBackend } from './_helpers';
// configureFakeBackend();
console.log('app');

if (module.hot) {
    module.hot.accept('./index.js', function() {
        console.log('Accepting the updated printMe module!');

    })
}

render(
    <App/>,
    document.getElementById('app')
);