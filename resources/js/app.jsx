import React, { useState, useEffect } from 'react';

// --- DATOS DE EJEMPLO ---
// Esto simula información que en el futuro vendría de una API
const serviciosData = [
    { id: 1, nombre: 'Masaje Relajante', precio: '$50', icon: 'self_improvement', desc: '60 minutos de pura relajación muscular.' },
    { id: 2, nombre: 'Limpieza Facial', precio: '$35', icon: 'face_retouching_natural', desc: 'Tratamiento profundo con exfoliación y mascarilla.' },
    { id: 3, nombre: 'Manicura Spa', precio: '$20', icon: 'back_hand', desc: 'Cuidado completo para tus manos con esmalte semipermanente.' },
    { id: 4, nombre: 'Pedicura Spa', precio: '$25', icon: 'water_drop', desc: 'Relajación y belleza para tus pies cansados.' },
    { id: 5, nombre: 'Terapia de Piedras Calientes', precio: '$65', icon: 'spa', desc: 'Equilibra tu energía con piedras volcánicas.' },
    { id: 6, nombre: 'Aromaterapia', precio: '$40', icon: 'local_florist', desc: 'Sesión relajante utilizando aceites esenciales puros.' }
];

// Componente funcional con Props para recibir la función que cambia de vista
const Inicio = ({ setRutaActual }) => (
    <div className="flex flex-col items-center justify-center text-center py-16 md:py-24 px-4 animate-fade-in">
        <div className="w-32 h-32 bg-teal-100 rounded-full flex items-center justify-center mb-8 shadow-inner">
            <span className="material-icons text-6xl text-teal-600">spa</span>
        </div>
        <h2 className="text-4xl md:text-6xl font-extrabold text-teal-800 mb-6 tracking-tight">
            Encuentra tu centro con AURA
        </h2>
        <p className="text-xl text-gray-600 max-w-2xl mb-10 leading-relaxed">
            Un santuario de tranquilidad en medio del caos. Descubre nuestros tratamientos diseñados para revitalizar tu cuerpo y serenar tu mente.
        </p>
        <div className="flex gap-4 flex-col sm:flex-row w-full sm:w-auto">
            <button 
                onClick={() => setRutaActual('/servicios')}
                className="bg-teal-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-teal-700 transition shadow-lg flex items-center justify-center gap-2"
            >
                <span className="material-icons">list_alt</span>
                Ver Servicios
            </button>
            <button 
                onClick={() => setRutaActual('/contacto')}
                className="bg-white text-teal-600 border-2 border-teal-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-teal-50 transition flex items-center justify-center gap-2"
            >
                <span className="material-icons">event</span>
                Reservar Cita
            </button>
        </div>
    </div>
);

// Un componente reutilizable para vistas que aún no están construidas
const VistaGenerica = ({ titulo, icono }) => (
    <div className="flex flex-col items-center justify-center text-center py-20 px-4">
        <span className="material-icons text-8xl text-gray-300 mb-4">{icono}</span>
        <h2 className="text-3xl font-bold text-gray-600 mb-2">{titulo}</h2>
        <p className="text-gray-500">Esta sección está actualmente en construcción.</p>
    </div>
);

// Componente para un servicio individual con estado local.
const ServicioCard = ({ servicio }) => {
    const [agregado, setAgregado] = useState(false);

    const manejarClick = () => {
        setAgregado(!agregado);
    };

    return (
        <div className="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col h-full">
            <div className="w-16 h-16 bg-teal-50 rounded-xl flex items-center justify-center mb-4">
                <span className="material-icons text-3xl text-teal-500">{servicio.icon}</span>
            </div>
            <h3 className="text-xl font-bold mb-2 text-gray-800">{servicio.nombre}</h3>
            <p className="text-gray-500 mb-4 flex-grow text-sm">{servicio.desc}</p>
            <div className="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                <span className="text-teal-700 font-extrabold text-xl">{servicio.precio}</span>
                <button 
                    onClick={manejarClick}
                    className={`p-2 rounded-lg transition-colors flex items-center justify-center ${agregado ? 'bg-green-100 text-green-700' : 'bg-teal-50 text-teal-600 hover:bg-teal-100'}`}
                    title={agregado ? "Quitar" : "Agregar"}
                >
                    <span className="material-icons">{agregado ? 'check' : 'add_shopping_cart'}</span>
                </button>
            </div>
        </div>
    );
};

// Componente de lista que mapea un arreglo a componentes (Uso de 'key')
const Servicios = ({ servicios }) => (
    <div className="py-8 px-4 max-w-6xl mx-auto">
        <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-teal-800 mb-4">Catálogo de Tratamientos</h2>
            <p className="text-gray-600 max-w-2xl mx-auto">Elige los tratamientos que deseas disfrutar en tu próxima visita a nuestro Spa.</p>
        </div>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {servicios.map(servicio => (
                <ServicioCard key={servicio.id} servicio={servicio} />
            ))}
        </div>
    </div>
);

const Nosotros = () => (
    <div className="max-w-4xl mx-auto mt-8 px-4 pb-12">
        <div className="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            <div className="md:w-5/12 bg-teal-600 flex items-center justify-center p-12 text-white">
                <div className="text-center">
                    <span className="material-icons text-9xl mb-4 opacity-90">volunteer_activism</span>
                    <h3 className="text-2xl font-bold">AURA Spa</h3>
                </div>
            </div>
            <div className="md:w-7/12 p-8 md:p-12 flex flex-col justify-center">
                <h2 className="text-3xl font-bold text-teal-800 mb-4">Nuestra Filosofía</h2>
                <p className="text-gray-600 leading-relaxed mb-6">
                    En AURA Beauty & Spa creemos que la verdadera belleza exterior nace del equilibrio y la paz interior. 
                    Nuestro equipo de profesionales está dedicado a brindarte una experiencia transformadora 
                    para relajar tu cuerpo, serenar tu mente y elevar tu espíritu.
                </p>
                <div className="flex items-center gap-4 bg-teal-50 p-4 rounded-xl">
                    <div className="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                        <span className="material-icons">star</span>
                    </div>
                    <span className="text-teal-800 font-medium">Más de 10 años de experiencia brindando bienestar y salud.</span>
                </div>
            </div>
        </div>
    </div>
);

// Componente con formulario controlado (Inputs atados al estado de React)
const Contacto = () => {
    const [form, setForm] = useState({ nombre: '', email: '', asunto: 'Cita', mensaje: '' });
    const [enviado, setEnviado] = useState(false);
    
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault(); 
        setEnviado(true);
        setForm({ nombre: '', email: '', asunto: 'Cita', mensaje: '' });
        
        setTimeout(() => setEnviado(false), 4000);
    };

    return (
        <div className="max-w-xl mx-auto bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mt-8 mb-12">
            <div className="text-center mb-8">
                <span className="material-icons text-5xl text-teal-600 mb-2">mail</span>
                <h2 className="text-3xl font-bold text-teal-800">Contáctanos</h2>
                <p className="text-gray-500 mt-2">Envíanos un mensaje y te responderemos a la brevedad.</p>
            </div>

            {enviado && (
                <div className="bg-teal-50 border-l-4 border-teal-500 text-teal-800 px-4 py-4 rounded shadow-sm mb-6 flex items-start gap-3 animate-pulse">
                    <span className="material-icons text-teal-500">check_circle</span>
                    <div>
                        <p className="font-bold">¡Mensaje enviado con éxito!</p>
                        <p className="text-sm">Nuestro equipo se pondrá en contacto contigo muy pronto.</p>
                    </div>
                </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-5">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label className="block text-gray-700 font-medium mb-1 text-sm">Nombre completo</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            value={form.nombre} 
                            onChange={handleChange} 
                            className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-colors"
                            required 
                            placeholder="Ej. María Pérez"
                        />
                    </div>
                    <div>
                        <label className="block text-gray-700 font-medium mb-1 text-sm">Correo electrónico</label>
                        <input 
                            type="email" 
                            name="email" 
                            value={form.email} 
                            onChange={handleChange} 
                            className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-colors"
                            required 
                            placeholder="correo@ejemplo.com"
                        />
                    </div>
                </div>
                <div>
                    <label className="block text-gray-700 font-medium mb-1 text-sm">Asunto</label>
                    <select 
                        name="asunto" 
                        value={form.asunto} 
                        onChange={handleChange}
                        className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-colors"
                    >
                        <option value="Cita">Agendar una cita</option>
                        <option value="Informacion">Solicitar información</option>
                        <option value="Sugerencia">Sugerencias</option>
                    </select>
                </div>
                <div>
                    <label className="block text-gray-700 font-medium mb-1 text-sm">Mensaje</label>
                    <textarea 
                        name="mensaje" 
                        value={form.mensaje} 
                        onChange={handleChange} 
                        rows="4"
                        className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-colors resize-none"
                        required 
                        placeholder="¿En qué te podemos ayudar?"
                    ></textarea>
                </div>
                <button 
                    type="submit" 
                    className="w-full bg-teal-600 text-white font-bold py-4 px-4 rounded-xl hover:bg-teal-700 active:transform active:scale-[0.99] transition-all flex items-center justify-center gap-2 shadow-md"
                >
                    <span className="material-icons">send</span>
                    Enviar Mensaje
                </button>
            </form>
        </div>
    );
};

const App = () => {
    const [rutaActual, setRutaActual] = useState('/');

    const MENU_ITEMS = [
        { path: '/', label: 'Inicio', icon: 'home' },
        { path: '/servicios', label: 'Servicios', icon: 'spa' },
        { path: '/nosotros', label: 'Nosotros', icon: 'groups' },
        { path: '/instalaciones', label: 'Instalaciones', icon: 'storefront' },
        { path: '/productos', label: 'Productos', icon: 'shopping_bag' },
        { path: '/contacto', label: 'Contacto', icon: 'mail' },
    ];

    const renderizarVista = () => {
        switch(rutaActual) {
            case '/': return <Inicio setRutaActual={setRutaActual} />;
            case '/servicios': return <Servicios servicios={serviciosData} />;
            case '/nosotros': return <Nosotros />;
            case '/contacto': return <Contacto />;
            case '/instalaciones': return <VistaGenerica titulo="Nuestras Instalaciones" icono="storefront" />;
            case '/productos': return <VistaGenerica titulo="Nuestros Productos" icono="shopping_bag" />;
            default: return <VistaGenerica titulo="Error 404 - Página no encontrada" icono="error_outline" />;
        }
    };

    return (
        <div className="min-h-screen flex flex-col bg-slate-50 text-gray-800 font-sans selection:bg-teal-200">
            {/* Navegación Superior */}
            <header className="bg-teal-800 text-white sticky top-0 z-50 shadow-lg">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex flex-col md:flex-row justify-between items-center py-4 gap-4 md:gap-0">
                        {/* Logo */}
                        <div 
                            className="flex items-center gap-2 cursor-pointer hover:text-teal-200 transition"
                            onClick={() => setRutaActual('/')}
                        >
                            <span className="material-icons text-3xl">spa</span>
                            <h1 className="text-2xl font-bold tracking-wider">AURA SPA</h1>
                        </div>
                        
                        {/* Menú principal usando mapeo de listas y Tailwind para los underlines animados */}
                        <nav className="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm font-medium">
                            {MENU_ITEMS.map(item => (
                                <button 
                                    key={item.path}
                                    onClick={() => setRutaActual(item.path)}
                                    className={`relative flex items-center gap-1 py-1 hover:text-teal-200 transition-colors after:content-[''] after:absolute after:h-[2px] after:-bottom-1 after:left-0 after:bg-white after:transition-all after:duration-300 ${rutaActual === item.path ? 'text-teal-200 font-bold after:w-full' : 'text-teal-50 after:w-0 hover:after:w-full'}`}
                                >
                                    <span className="material-icons text-[18px]">{item.icon}</span>
                                    {item.label}
                                </button>
                            ))}
                        </nav>
                    </div>
                </div>
            </header>

            {/* Contenido Dinámico */}
            <main className="flex-grow w-full">
                {renderizarVista()}
            </main>

            {/* Pie de página */}
            <footer className="bg-gray-900 text-gray-400 py-8 text-center text-sm">
                <div className="flex justify-center items-center gap-2 mb-2">
                    <span className="material-icons text-teal-600">spa</span>
                    <span className="text-gray-300 font-semibold tracking-wider">AURA SPA</span>
                </div>
                <p>&copy; {new Date().getFullYear()} AURA Beauty & Spa. Todos los derechos reservados.</p>
                <p className="mt-2 text-xs">Desarrollado con React y Tailwind CSS</p>
            </footer>
        </div>
    );
};

export default App;