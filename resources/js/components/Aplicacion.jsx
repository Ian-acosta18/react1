import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

// Importación de las páginas
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
            <Routes>
                <Route path="/" element={<Inicio />} />
                <Route path="/servicios" element={<Servicios />} />
                <Route path="/productos" element={<Productos />} />
                <Route path="/instalaciones" element={<Instalaciones />} />
                <Route path="/nosotros" element={<Nosotros />} />
                <Route path="/contacto" element={<Contacto />} />
                <Route path="/reservaciones" element={<Reservaciones />} />

                {/* Ruta de respaldo para Error 404 */}
                <Route path="*" element={<NoExiste />} />
            </Routes>
        </Router>
    );
};

export default Aplicacion;