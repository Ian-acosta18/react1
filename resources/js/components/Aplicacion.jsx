import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

// Importación de las páginas creadas a partir de las vistas Blade
import Inicio from '../pages/Inicio';
import Servicios from '../pages/Servicios';
import Productos from '../pages/Productos';
import Instalaciones from '../pages/Instalaciones';
import Nosotros from '../pages/Nosotros';
import Contacto from '../pages/Contacto';
import Reservaciones from '../pages/Reservaciones';
import NoExiste from '../pages/NoExiste';

const Aplicacion = () => {
    return (
        <Router>
            <Switch>
                <Route exact path="/" component={Inicio} />
                <Route exact path="/servicios" component={Servicios} />
                <Route exact path="/productos" component={Productos} />
                <Route exact path="/instalaciones" component={Instalaciones} />
                <Route exact path="/nosotros" component={Nosotros} />
                <Route exact path="/contacto" component={Contacto} />
                <Route exact path="/reservaciones" component={Reservaciones} />

                {/* Ruta por defecto para manejar errores 404 de URLs inválidas */}
                <Route component={NoExiste} />
            </Switch>
        </Router>
    );
};

export default Aplicacion;