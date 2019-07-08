import React from 'react';
import { Provider } from 'react-redux';
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap-css-only/css/bootstrap.min.css'
import 'mdbreact/dist/css/mdb.css'


import store from './src/store';

export const wrapRootElement = ({ element }) => {
  return (
      <Provider store={store}>{element}</Provider>
  );
};
