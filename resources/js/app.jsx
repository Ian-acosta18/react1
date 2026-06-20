import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Aplicacion from './components/Aplicacion';

if (document.getElementById('root')) {
    const root = ReactDOM.createRoot(document.getElementById('root'));
    root.render(
        <React.StrictMode>
            <Aplicacion />
        </React.StrictMode>
    );
}