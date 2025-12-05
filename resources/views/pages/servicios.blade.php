@extends('layouts.app')

@section('content')

<style>
    :root {
        --primario: #B98D7B;
        --secundario: #5c4b45;
        --acento: #d4a894;
        --fondo: #f8f4f2;
        --superficie: #ffffff;
        --texto: #5c4b45;
        --texto-suave: #8a7872;
    }

    body {
        background: var(--fondo);
        color: var(--texto);
        overflow-x: hidden;
    }

    /* HERO CON PARALLAX MOUSE */
    .hero-interactive {
        height: 30vh;
        min-height: 250px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: visible;
        background: linear-gradient(135deg, #f8f4f2 0%, #faf7f5 50%, #f5f0ed 100%);
        margin-bottom: 80px;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(185, 141, 123, 0.1);
    }

    .parallax-layer {
        position: absolute;
        inset: 0;
        transition: transform 0.3s ease-out;
        overflow: hidden;
        border-radius: 0 0 50px 50px;
    }

    .floating-shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
        transition: transform 0.5s ease-out;
    }

    .shape-1 {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, var(--primario), transparent);
        top: -80px;
        right: 10%;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, var(--acento), transparent);
        bottom: -60px;
        left: 15%;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, var(--secundario), transparent);
        top: 20%;
        left: 40%;
    }

    .hero-content-interactive {
        position: relative;
        z-index: 10;
        text-align: center;
        transition: transform 0.3s ease-out;
    }

    .hero-title-interactive {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        background: linear-gradient(135deg, var(--secundario) 0%, var(--primario) 50%, var(--acento) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 15px;
        cursor: default;
        transition: all 0.3s ease;
    }

    .hero-title-interactive:hover {
        letter-spacing: 8px;
        transform: scale(1.05);
    }

    .hero-subtitle-interactive {
        font-size: 0.95rem;
        color: var(--texto-suave);
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 400;
    }

    /* BÚSQUEDA INTERACTIVA */
    .search-container {
        max-width: 600px;
        margin: -40px auto 50px;
        position: relative;
        z-index: 20;
        padding: 0 20px;
    }

    .search-wrapper {
        position: relative;
        animation: slideDown 0.6s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .search-input {
        width: 100%;
        padding: 18px 60px 18px 25px;
        border: 2px solid rgba(185, 141, 123, 0.3);
        border-radius: 50px;
        background: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(185, 141, 123, 0.1);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primario);
        box-shadow: 0 15px 40px rgba(185, 141, 123, 0.25);
        transform: translateY(-2px);
    }

    .search-icon {
        position: absolute;
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primario);
        font-size: 1.3rem;
        pointer-events: none;
    }

    /* FILTROS ANIMADOS */
    .filters-wrapper {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-bottom: 50px;
        flex-wrap: wrap;
        padding: 0 20px;
    }

    .filter-chip {
        background: white;
        color: var(--texto-suave);
        border: 2px solid rgba(185, 141, 123, 0.2);
        padding: 12px 28px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 0.85rem;
        position: relative;
        overflow: hidden;
    }

    .filter-chip::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        transition: left 0.5s ease;
    }

    .filter-chip:hover::before {
        left: 100%;
    }

    .filter-chip:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(185, 141, 123, 0.2);
    }

    .filter-chip.active {
        background: var(--primario);
        color: white;
        border-color: var(--primario);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(185, 141, 123, 0.3);
    }

    .filter-chip .count {
        display: inline-block;
        background: rgba(255, 255, 255, 0.3);
        padding: 2px 8px;
        border-radius: 10px;
        margin-left: 8px;
        font-size: 0.75rem;
    }

    /* CONTADOR DE RESULTADOS */
    .results-counter {
        text-align: center;
        margin-bottom: 30px;
        color: var(--texto-suave);
        font-size: 1rem;
        animation: fadeIn 0.5s ease;
    }

    .results-counter strong {
        color: var(--primario);
        font-weight: 700;
        font-size: 1.2rem;
    }

    /* GRID CON STAGGER ANIMATION */
    .servicios-grid-interactive {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 80px;
        perspective: 1000px;
    }

    /* TARJETA INTERACTIVA CON FLIP */
    .card-interactive {
        position: relative;
        height: 450px;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
        cursor: pointer;
    }

    .card-interactive.flipped .card-front {
        transform: rotateY(180deg);
    }

    .card-interactive.flipped .card-back {
        transform: rotateY(0deg);
    }

    .card-front,
    .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 25px;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(185, 141, 123, 0.15);
    }

    .card-front {
        background: white;
        transform: rotateY(0deg);
    }

    .card-back {
        background: linear-gradient(135deg, var(--primario), var(--acento));
        transform: rotateY(-180deg);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px;
        color: white;
    }

    .card-interactive:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(185, 141, 123, 0.25);
    }

    /* IMAGEN CON ZOOM */
    .imagen-wrapper-interactive {
        position: relative;
        height: 250px;
        overflow: hidden;
        border-radius: 25px 25px 0 0;
        background: linear-gradient(135deg, #fafafa, #f5f5f5);
    }

    .imagen-servicio {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-interactive:hover .imagen-servicio {
        transform: scale(1.15) rotate(2deg);
    }

    .imagen-overlay-interactive {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(185, 141, 123, 0.6) 100%);
        opacity: 0;
        transition: opacity 0.5s ease;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 20px;
    }

    .card-interactive:hover .imagen-overlay-interactive {
        opacity: 1;
    }

    .quick-view-btn {
        background: white;
        color: var(--primario);
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transform: translateY(20px);
        transition: all 0.3s ease;
        opacity: 0;
    }

    .card-interactive:hover .quick-view-btn {
        transform: translateY(0);
        opacity: 1;
        transition-delay: 0.2s;
    }

    .quick-view-btn:hover {
        background: var(--primario);
        color: white;
        transform: translateY(-3px);
    }

    /* PRECIO FLOTANTE MEJORADO */
    .precio-floating {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        color: var(--secundario);
        padding: 10px 18px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1.1rem;
        z-index: 10;
        border: 2px solid var(--primario);
        box-shadow: 0 5px 20px rgba(185, 141, 123, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-interactive:hover .precio-floating {
        transform: scale(1.15) rotate(-8deg);
        box-shadow: 0 10px 30px rgba(185, 141, 123, 0.5);
        background: var(--primario);
        color: white;
    }

    /* CONTENIDO TARJETA */
    .card-content-interactive {
        padding: 25px;
    }

    .categoria-tag {
        display: inline-block;
        background: linear-gradient(135deg, rgba(185, 141, 123, 0.15), rgba(212, 168, 148, 0.15));
        color: var(--primario);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 12px;
        border: 1px solid rgba(185, 141, 123, 0.2);
    }

    .servicio-nombre-interactive {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--texto);
        margin-bottom: 15px;
        line-height: 1.3;
        min-height: 2.6em;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .card-interactive:hover .servicio-nombre-interactive {
        color: var(--primario);
    }

    /* BOTÓN RESERVAR INTERACTIVO */
    .btn-reservar-interactive {
        width: 100%;
        background: transparent;
        border: 2px solid var(--primario);
        color: var(--primario);
        padding: 14px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: 0.9rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-reservar-interactive::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: var(--primario);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.5s ease, height 0.5s ease;
    }

    .btn-reservar-interactive span {
        position: relative;
        z-index: 1;
        transition: color 0.3s ease;
    }

    .btn-reservar-interactive:hover::before {
        width: 500px;
        height: 500px;
    }

    .btn-reservar-interactive:hover span {
        color: white;
    }

    .btn-reservar-interactive:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(185, 141, 123, 0.3);
    }

    /* INFO REVERSO */
    .back-info {
        text-align: center;
    }

    .back-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .back-description {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 20px;
        opacity: 0.95;
    }

    .flip-hint {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.85rem;
        opacity: 0.7;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    /* NO RESULTS */
    .no-results {
        text-align: center;
        padding: 100px 20px;
        animation: fadeIn 0.5s ease;
    }

    .no-results-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .no-results h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primario);
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .no-results p {
        color: var(--texto-suave);
        font-size: 1.1rem;
    }

    /* LOADING ANIMATION */
    .loading-skeleton {
        animation: skeleton-loading 1.5s infinite;
    }

    @keyframes skeleton-loading {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; }
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .hero-interactive {
            height: 25vh;
            min-height: 200px;
            border-radius: 0 0 30px 30px;
        }

        .servicios-grid-interactive {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .filters-wrapper {
            gap: 10px;
        }

        .filter-chip {
            padding: 10px 20px;
            font-size: 0.8rem;
        }

        .card-interactive {
            height: 420px;
        }
        
        .hero-title-interactive {
            font-size: 1.8rem;
        }
        
        .hero-subtitle-interactive {
            font-size: 0.85rem;
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

{{-- Hero Interactivo con Parallax --}}
<div class="hero-interactive" id="heroInteractive">
    <div class="parallax-layer" id="parallaxLayer">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>
    
    <div class="hero-content-interactive" id="heroContent">
        <h1 class="hero-title-interactive">Servicios</h1>
        <p class="hero-subtitle-interactive">Experiencias diseñadas para ti</p>
    </div>
</div>

{{-- Búsqueda Interactiva --}}
<div class="search-container">
    <div class="search-wrapper">
        <input type="text" 
               class="search-input" 
               id="searchInput" 
               placeholder="Buscar servicios..."
               autocomplete="off">
        <span class="search-icon">🔍</span>
    </div>
</div>

{{-- Filtros por Categoría --}}
<div class="filters-wrapper" id="filtersWrapper">
    <button class="filter-chip active" data-categoria="todos">
        Todos <span class="count" id="countTodos">{{ $categorias->sum(fn($c) => $c->servicios->count()) }}</span>
    </button>
    @foreach($categorias as $categoria)
        @if($categoria->servicios->count() > 0)
            <button class="filter-chip" data-categoria="{{ $categoria->id }}">
                {{ $categoria->nombre_categoria }} <span class="count">{{ $categoria->servicios->count() }}</span>
            </button>
        @endif
    @endforeach
</div>

{{-- Contador de Resultados --}}
<div class="results-counter" id="resultsCounter">
    Mostrando <strong id="resultCount">{{ $categorias->sum(fn($c) => $c->servicios->count()) }}</strong> servicios
</div>

{{-- Grid de Servicios --}}
<div class="container pb-5">
    
    @if($categorias->where(fn($c) => $c->servicios->count() > 0)->count() > 0)
        
        <div class="servicios-grid-interactive" id="serviciosGrid">
            @foreach($categorias as $categoria)
                @foreach($categoria->servicios as $servicio)
                    <div class="card-interactive" 
                         data-categoria="{{ $categoria->id }}"
                         data-nombre="{{ strtolower($servicio->nombre_servicio) }}">
                        
                        {{-- FRENTE DE LA TARJETA --}}
                        <div class="card-front">
                            <div class="imagen-wrapper-interactive">
                                @if($servicio->imagen && file_exists(public_path($servicio->imagen)))
                                    <img src="{{ asset($servicio->imagen) }}" 
                                         alt="{{ $servicio->nombre_servicio }}"
                                         class="imagen-servicio">
                                @else
                                    <img src="{{ asset('imagen/sinfoto.jpg') }}" 
                                         alt="Sin imagen" 
                                         class="imagen-servicio"
                                         style="filter: grayscale(100%) brightness(0.7);">
                                @endif
                                
                                <div class="imagen-overlay-interactive">
                                    <button class="quick-view-btn" onclick="event.stopPropagation()">
                                        👁️ Vista rápida
                                    </button>
                                </div>
                                
                                <div class="precio-floating">
                                    ${{ number_format($servicio->precio, 2) }}
                                </div>
                            </div>
                            
                            <div class="card-content-interactive">
                                <div class="categoria-tag">
                                    {{ $categoria->nombre_categoria }}
                                </div>
                                
                                <h3 class="servicio-nombre-interactive">
                                    {{ $servicio->nombre_servicio }}
                                </h3>
                                
                                <a href="{{ route('reservaciones') }}" 
                                   class="btn-reservar-interactive"
                                   onclick="event.stopPropagation()">
                                    <span>Reservar Ahora</span>
                                </a>
                            </div>
                        </div>
                        
                        {{-- REVERSO DE LA TARJETA --}}
                        <div class="card-back">
                            <div class="back-info">
                                <h3 class="back-title">{{ $servicio->nombre_servicio }}</h3>
                                <p class="back-description">
                                    Descubre una experiencia única diseñada especialmente para ti. 
                                    Calidad premium y atención personalizada.
                                </p>
                                <a href="{{ route('reservaciones') }}" 
                                   class="btn-reservar-interactive"
                                   style="max-width: 250px; margin: 0 auto;"
                                   onclick="event.stopPropagation()">
                                    <span>Reservar</span>
                                </a>
                            </div>
                            <div class="flip-hint">Clic para voltear</div>
                        </div>
                        
                    </div>
                @endforeach
            @endforeach
        </div>
        
        {{-- No Results Message --}}
        <div class="no-results" id="noResults" style="display: none;">
            <div class="no-results-icon">🔍</div>
            <h3>No se encontraron servicios</h3>
            <p>Intenta con otra búsqueda o categoría</p>
        </div>
        
    @else
        
        <div class="no-results">
            <div class="no-results-icon">✨</div>
            <h3>Próximamente</h3>
            <p>Estamos preparando experiencias increíbles para ti</p>
        </div>
        
    @endif
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== PARALLAX HERO CON MOUSE =====
    const hero = document.getElementById('heroInteractive');
    const parallaxLayer = document.getElementById('parallaxLayer');
    const heroContent = document.getElementById('heroContent');
    
    if (hero && parallaxLayer) {
        hero.addEventListener('mousemove', function(e) {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            const moveX = (mouseX - 0.5) * 50;
            const moveY = (mouseY - 0.5) * 50;
            
            parallaxLayer.style.transform = `translate(${moveX}px, ${moveY}px)`;
            
            if (heroContent) {
                heroContent.style.transform = `translate(${moveX * 0.3}px, ${moveY * 0.3}px)`;
            }
        });
        
        hero.addEventListener('mouseleave', function() {
            parallaxLayer.style.transform = 'translate(0, 0)';
            if (heroContent) {
                heroContent.style.transform = 'translate(0, 0)';
            }
        });
    }
    
    // ===== FLIP CARDS =====
    const cards = document.querySelectorAll('.card-interactive');
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (!e.target.closest('a') && !e.target.closest('button')) {
                this.classList.toggle('flipped');
            }
        });
    });
    
    // ===== BÚSQUEDA EN TIEMPO REAL =====
    const searchInput = document.getElementById('searchInput');
    const serviciosGrid = document.getElementById('serviciosGrid');
    const noResults = document.getElementById('noResults');
    const resultCount = document.getElementById('resultCount');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            filterServices();
        });
    }
    
    // ===== FILTROS POR CATEGORÍA =====
    const filterChips = document.querySelectorAll('.filter-chip');
    let activeCategoria = 'todos';
    
    filterChips.forEach(chip => {
        chip.addEventListener('click', function() {
            filterChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            activeCategoria = this.dataset.categoria;
            filterServices();
        });
    });
    
    // ===== FUNCIÓN DE FILTRADO =====
    function filterServices() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;
        
        cards.forEach(card => {
            const categoria = card.dataset.categoria;
            const nombre = card.dataset.nombre;
            
            const matchCategoria = activeCategoria === 'todos' || categoria === activeCategoria;
            const matchSearch = nombre.includes(searchTerm);
            
            if (matchCategoria && matchSearch) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Actualizar contador
        if (resultCount) {
            resultCount.textContent = visibleCount;
        }
        
        // Mostrar/ocultar mensaje "no results"
        if (noResults && serviciosGrid) {
            if (visibleCount === 0) {
                noResults.style.display = 'block';
                serviciosGrid.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                serviciosGrid.style.display = 'grid';
            }
        }
    }
    
    // ===== ANIMACIÓN DE ENTRADA ESCALONADA =====
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });
    
    // ===== QUICK VIEW =====
    const quickViewButtons = document.querySelectorAll('.quick-view-btn');
    quickViewButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const card = this.closest('.card-interactive');
            card.classList.add('flipped');
        });
    });
});
</script>

@endsection