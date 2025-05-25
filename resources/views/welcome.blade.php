<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List for Me - Otimize suas Compras</title>
    @vite('resources/css/app.css')
    {{-- Para los iconos del carrusel, puedes usar Font Awesome o simplemente SVGs --}}
    {{-- Si vas a usar Font Awesome, descomenta y asegura que el kit esté configurado --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        /* Estilos para ocultar y mostrar slides del carrusel */
        .carousel-item {
            display: none;
        }
        .carousel-item.active {
            display: block;
        }
        .carousel-fade .carousel-item {
            transition: opacity 0.6s ease-in-out;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .carousel-fade .carousel-item.active {
            opacity: 1;
            position: relative; /* Asegura que ocupe espacio */
        }
    </style>
</head>
<body class="bg-[#f5f0e6] text-[#556b2f]"> {{-- Cor de fundo e texto base aproximadas das imagens --}}

    {{-- Header / Navbar --}}
    <nav class="bg-white shadow-sm p-4 flex items-center justify-between border-b border-[#e2dfd3]">
        <div class="flex items-center space-x-2">
            {{-- Ícone do Carrinho --}}
            <svg class="w-8 h-8 text-[#556b2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-2xl font-extrabold text-[#556b2f]">List for Me</span>
        </div>
        <div class="flex space-x-6 text-[#556b2f] font-semibold">
            <a href="{{ url('/') }}" class="hover:text-[#8f9779] transition-colors duration-300">Início</a>
            <a href="#how-it-works" class="hover:text-[#8f9779] transition-colors duration-300">Como Funciona</a>
            <a href="#our-team" class="hover:text-[#8f9779] transition-colors duration-300">Nossa Equipe</a> {{-- Enlace al nuevo panel --}}
            <a href="" class="hover:text-[#8f9779] transition-colors duration-300">Receitas</a>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('login') }}" class="px-6 py-2 border border-[#8f9779] text-[#556b2f] rounded-lg hover:bg-[#e2dfd3] transition-colors duration-300">
                Entrar
            </a>
            <a href="{{ route('register') }}" class="px-6 py-2 bg-[#556b2f] text-white rounded-lg hover:bg-[#425823] transition-colors duration-300">
                Cadastrar
            </a>
        </div>
    </nav>

    {{-- Hero Section with Carousel --}}
    <header class="bg-gradient-to-b from-[#eaf2e3] to-[#f5f0e6] py-16 text-center px-4 relative overflow-hidden">
        <div class="max-w-6xl mx-auto relative">
            <div id="imageCarousel" class="relative w-full h-[450px] md:h-[550px] overflow-hidden rounded-xl shadow-lg">
                {{-- Carousel Item 1 --}} 
                <div class="carousel-item active absolute inset-0 transition-opacity duration-700 ease-in-out">
                    <img src="{{ asset('images/logito.jpg') }}" alt="Cozinhe com inteligência" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-center p-4">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                                Cozinhe com inteligência, economize com sabedoria
                            </h1>
                            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                                Descubra receitas personalizadas de acordo com suas preferências e otimize
                                suas compras de ingredientes para economizar tempo e dinheiro.
                            </p>
                            <a href="{{ route('login') }}" class="inline-block bg-[#556b2f] text-white font-semibold py-3 px-8 rounded-lg text-lg hover:bg-[#425823] transition-colors duration-300 shadow-lg mt-8">
                                Começar agora
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Carousel Item 2 --}}
                <div class="carousel-item absolute inset-0 transition-opacity duration-700 ease-in-out">
                    <img src="{{ asset('images/super.jpg') }}" alt="Receitas personalizadas" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-center p-4">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                                Receitas Feitas Para Você
                            </h1>
                            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                                Filtre por ingredientes, restrições dietéticas e o tempo de preparo.
                                Encontre a receita perfeita para qualquer ocasião.
                            </p>
                            <a href="{{ route('register') }}" class="inline-block bg-[#c94f1a] text-white font-semibold py-3 px-8 rounded-lg text-lg hover:bg-[#a43b0e] transition-colors duration-300 shadow-lg mt-8">
                                Explorar Receitas
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Carousel Item 3 --}}
                <div class="carousel-item absolute inset-0 transition-opacity duration-700 ease-in-out">
                    <img src="{{ asset('images/super.jpg') }}" alt="Otimize suas compras" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-center p-4">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                                Lista de Compras Inteligente
                            </h1>
                            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                                Geramos listas otimizadas para você comprar apenas o que precisa,
                                evitando desperdícios e economizando dinheiro.
                            </p>
                            <a href="{{ route('login') }}" class="inline-block bg-[#556b2f] text-white font-semibold py-3 px-8 rounded-lg text-lg hover:bg-[#425823] transition-colors duration-300 shadow-lg mt-8">
                                Otimizar Compras
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Carousel Navigation (Arrows) --}}
            <button id="carousel-prev" class="absolute top-1/2 left-4 -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 transition-colors duration-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button id="carousel-next" class="absolute top-1/2 right-4 -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 transition-colors duration-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </header>

    {{-- Como Funciona Section --}}
    <section id="how-it-works" class="py-20 bg-white px-4">
        <h2 class="text-4xl font-extrabold text-[#556b2f] text-center mb-12">Como funciona?</h2>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card 1: Preferências Personalizadas --}}
            <div class="bg-[#fdf6e3] rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center justify-center">
                <div class="bg-[#8f9779] p-4 rounded-full mb-4 inline-flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354c.343-.377.94-.377 1.283 0l1.378 1.512a2.499 2.499 0 001.625.795h3.048c.846 0 1.25.992.732 1.63L19.2 11.41a2.499 2.499 0 00-.795 1.625v3.048c0 .846-.992 1.25-1.63.732l-1.512-1.378a2.499 2.499 0 00-1.625-.795H8.795c-.846 0-1.25.992-.732 1.63L4.8 19.2a2.499 2.499 0 00.795 1.625h3.048c.846 0 1.25-.992.732-1.63l1.512-1.378a2.499 2.499 0 001.625-.795V8.795c0-.846.992-1.25 1.63-.732L19.2 4.8a2.499 2.499 0 00-1.625-.795h-3.048c-.846 0-1.25-.992-.732-1.63l-1.512-1.378c-.343-.377-.94-.377-1.283 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-[#556b2f]">Preferências Personalizadas</h3>
                <p class="text-[#7a7a58]">
                    Conte-nos sobre seus gostos, restrições dietéticas
                    e alergias para oferecermos recomendações sob
                    medida.
                </p>
            </div>

            {{-- Card 2: Compras Inteligentes --}}
            <div class="bg-[#fdf6e3] rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center justify-center">
                <div class="bg-[#8f9779] p-4 rounded-full mb-4 inline-flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-[#556b2f]">Compras Inteligentes</h3>
                <p class="text-[#7a7a58]">
                    Encontramos os melhores preços em lojas
                    próximas e otimizamos sua lista de compras para
                    evitar desperdícios.
                </p>
            </div>

            {{-- Card 3: Economia Garantida --}}
            <div class="bg-[#fdf6e3] rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center justify-center">
                <div class="bg-[#8f9779] p-4 rounded-full mb-4 inline-flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1H17a3 3 0 013 3v2a3 3 0 01-3 3h-1.408c-.512.598-1.482 1-2.592 1m0-8a2 2 0 110 4 2 2 0 010-4zm-8 8a2 2 0 110 4 2 2 0 010-4z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-[#556b2f]">Economia Garantida</h3>
                <p class="text-[#7a7a58]">
                    Nossos algoritmos ajudam você a reduzir custos
                    sem sacrificar a qualidade das suas refeições.
                </p>
            </div>
        </div>
    </section>

    {{-- New Section: Our Team --}}
    <section id="our-team" class="py-20 bg-[#eaf2e3] px-4">
        <h2 class="text-4xl font-extrabold text-[#556b2f] text-center mb-12">Nossa Equipe</h2>
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Team Member 1 --}}
            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center">
                <img src="{{ asset('images/foto1.jpg') }}" alt="Nome do Membro 1" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-[#8f9779]">
                <h3 class="text-xl font-bold text-[#556b2f] mb-2">Arthur Hudson</h3>
                <p class="text-[#7a7a58] text-sm">Marketing</p>
                <p class="text-gray-600 text-sm mt-3">
                    Apaixonado por tecnologia, lidera a visão de um futuro com compras inteligentes.
                </p>
            </div>

            {{-- Team Member 2 --}}
            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center">
                <img src="{{ asset('images/foto2.jpg') }}" alt="Nome do Membro 2" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-[#8f9779]">
                <h3 class="text-xl font-bold text-[#556b2f] mb-2">Josues Pena</h3>
                <p class="text-[#7a7a58] text-sm">Layout e apresentador</p>
                <p class="text-gray-600 text-sm mt-3">
                    Especialista em UX/UI, garante que nossa plataforma seja intuitiva e fácil de usar para todos.
                </p>
            </div>

            {{-- Team Member 3 --}}
            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center">
                <img src="{{ asset('images/foto3.jpg') }}" alt="Nome do Membro 3" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-[#8f9779]">
                <h3 class="text-xl font-bold text-[#556b2f] mb-2">William Gomes</h3>
                <p class="text-[#7a7a58] text-sm">Gincana e organização</p>
                <p class="text-gray-600 text-sm mt-3">
                    Arquiteto das soluções por trás das listas de compras e algoritmos de recomendação.
                </p>
            </div>

            {{-- Team Member 4 --}}
            <div class="bg-white rounded-xl shadow-md p-6 text-center border border-[#e2dfd3] flex flex-col items-center">
                <img src="{{ asset('images/foto4.jpg') }}" alt="Nome do Membro 4" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-[#8f9779]">
                <h3 class="text-xl font-bold text-[#556b2f] mb-2">Viva Lima</h3>
                <p class="text-[#7a7a58] text-sm">Direção</p>
                <p class="text-gray-600 text-sm mt-3">
                    Conecta nossa plataforma com os usuários, construindo uma comunidade vibrante e engajada.
                </p>
            </div>
        </div>
    </section>

    {{-- Call to Action Final --}}
    <section class="bg-[#556b2f] py-20 text-center px-4">
        <h2 class="text-4xl font-extrabold text-white mb-6">Pronto para revolucionar sua forma de cozinhar?</h2>
        <p class="text-xl text-[#d9d7cc] mb-10 max-w-2xl mx-auto">
            Junte-se a milhares de usuários que já estão economizando tempo e dinheiro
            enquanto desfrutam de deliciosas receitas personalizadas.
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-[#c94f1a] text-white font-semibold py-3 px-8 rounded-lg text-lg hover:bg-[#a43b0e] transition-colors duration-300 shadow-lg">
            Criar conta grátis
        </a>
    </section>

    {{-- Footer (Opcional, você pode adicionar se quiser) --}}
    <footer class="bg-white py-8 text-center text-[#7a7a58] text-sm border-t border-[#e2dfd3]">
        <p>&copy; {{ date('Y') }} List for Me. Todos os direitos reservados.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('imageCarousel');
            const items = carousel.querySelectorAll('.carousel-item');
            const prevButton = document.getElementById('carousel-prev');
            const nextButton = document.getElementById('carousel-next');
            let currentIndex = 0;
            let autoSlideInterval;

            function showItem(index) {
                items.forEach((item, i) => {
                    item.classList.remove('active');
                    if (i === index) {
                        item.classList.add('active');
                    }
                });
            }

            function nextItem() {
                currentIndex = (currentIndex + 1) % items.length;
                showItem(currentIndex);
            }

            function prevItem() {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                showItem(currentIndex);
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextItem, 5000); // Cambia cada 5 segundos
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Navegación manual
            prevButton.addEventListener('click', () => {
                stopAutoSlide(); // Detener el auto-slide al interactuar
                prevItem();
                startAutoSlide(); // Reiniciar el auto-slide
            });

            nextButton.addEventListener('click', () => {
                stopAutoSlide(); // Detener el auto-slide al interactuar
                nextItem();
                startAutoSlide(); // Reiniciar el auto-slide
            });

            // Iniciar el auto-slide al cargar la página
            startAutoSlide();

            // Detener y reiniciar el auto-slide al pasar el mouse por encima del carrusel
            carousel.addEventListener('mouseenter', stopAutoSlide);
            carousel.addEventListener('mouseleave', startAutoSlide);
        });
    </script>

</body>
</html>