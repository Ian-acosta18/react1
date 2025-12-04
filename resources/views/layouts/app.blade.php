<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AURA BEAUTY & SPA - Luce radiante, siéntete tú</title>
    
    {{-- Enlace a tu hoja de estilos principal --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    {{-- Fuentes de Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400&family=Dancing+Script&display=swap" rel="stylesheet">

    {{-- 
        =========================================
        ESTILOS PARA EL PANEL DE ADMINISTRACIÓN
        (Agregados para que los CRUDs se vean bien)
        ========================================= 
    --}}
    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--color-principal, #B98D7B);
            padding-bottom: 1rem;
        }

        .tabla-admin {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .tabla-admin th {
            background-color: var(--color-principal, #B98D7B);
            color: white;
            padding: 1rem;
            font-family: 'Playfair Display', serif;
            text-align: left;
            font-weight: normal;
        }

        .tabla-admin td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            color: var(--color-texto, #5c4b45);
        }

        .tabla-admin tr:last-child td {
            border-bottom: none;
        }

        /* Botones de Acción (Editar/Borrar) */
        .btn-accion {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .btn-accion:hover { opacity: 0.8; }
        .btn-editar { background-color: #f0ad4e; color: white; }
        .btn-borrar { background-color: #d9534f; color: white; }

        /* Botón "Nuevo" */
        .btn-nuevo {
            background-color: var(--color-principal, #B98D7B);
            color: white;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            font-family: 'Playfair Display', serif;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .btn-nuevo:hover {
            background-color: #a57c6b;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <h1>AURA</h1>
            <h2>BEAUTY & SPA</h2>
        </div>
        <nav>
            <ul>
                {{-- Menú de Navegación --}}
                <li><a href="{{ route('inicio') }}">Inicio</a></li>
                <li><a href="{{ route('servicios') }}">Servicios</a></li>
                <li><a href="{{ route('instalaciones') }}">Instalaciones</a></li>
                <li><a href="{{ route('productos') }}">Productos</a></li>
                <li><a href="{{ route('nosotros') }}">Nosotros</a></li>
                <li><a href="{{ route('contacto') }}">Contacto</a></li>
                
                {{-- Botones de Acción --}}
                <li><a href="{{ route('reservaciones') }}" class="btn-reserva">Reservar Cita</a></li>
                
                {{-- Botón Administrador (Corregido el espacio en 'class') --}}
                <li><a href="{{ route('login') }}" class="btn-reserva">Administrador</a></li>
            </ul>
        </nav>
    </header>

    <main>
        {{-- Aquí se insertará el contenido de las vistas hijas --}}
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <p>"Luce radiante, siéntete tú"</p>
            
            <p>© {{ date("Y") }} AURA BEAUTY & SPA. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>