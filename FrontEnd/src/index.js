import React from 'react';
import {render} from 'react-dom';

import {App} from './App';

// setup fake backend
// import { configureFakeBackend } from './_helpers';
// configureFakeBackend();
console.log('app');


render(
    <App/>,
    document.getElementById('app')
);


if (module.hot) {
    module.hot.dispose(function() {
        // module is about to be replaced
    })

    module.hot.accept(function() {
        // module or one of its dependencies was just updated
    })
}