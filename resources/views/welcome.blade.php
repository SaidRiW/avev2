<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Virtual Escolar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/assets/images/logo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-100">
    <div class="flex justify-between items-center bg-blue-950 font-semibold text-white px-14">
        <div class="flex gap-4">
            <div class="p-[1.375rem] bg-red-600 hover:bg-red-700">
                <a href="/">INICIO</a>
            </div>
            <div class="p-[1.375rem] hover:bg-red-600">
                <a href="/goals">OBJETIVOS</a>
            </div>
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/index') }}" class="py-3 px-5 bg-red-600 hover:bg-red-700 rounded-[10px]">CALENDARIO</a>
                @else
                    <a href="{{ route('login') }}" class="py-3 px-5 bg-red-600 hover:bg-red-700 rounded-[10px]">INICIAR SESIÓN</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 py-3 px-5 bg-red-600 hover:bg-red-700 rounded-[10px]">REGISTRAR</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
    <div class="flex justify-between items-center p-6 lg:p-8" style="background-image: url('/assets/images/banner.jpg'); background-size: 100% 100%;">
        <div class="w-3/5 space-y-4 ml-6 mr-12 mb-8">
            <h1 class="text-6xl font-bold text-white">Agenda Virtual Escolar</h1>
            <h1 class="text-3xl font-bold text-red-600">Dirigido a tu centro educativo</h1>
            <p class="text-lg text-justify text-white">En nuestra plataforma, hemos desarrollado un sistema de comunicación diseñado para potenciar la interacción entre los diversos servicios que ofrecen las universidades, brindando una experiencia excepcional. Con un enfoque en la eficiencia y la accesibilidad, presentamos nuestra Agenda Virtual Escolar, una herramienta que establece un puente directo entre estudiantes, docentes y administrativos académicos.</p>
            <p class="text-lg text-justify text-white">Nuestro sistema se convierte en el epicentro de la información académica, permitiendo una comunicación activa y fluida. Aquí, se difunden anuncios vitales sobre programas académicos y eventos destacados en todas las áreas de la institución. No más búsquedas exhaustivas en múltiples fuentes, centralizamos toda la información relevante en un solo lugar, listo para ser gestionado de manera intuitiva a través de nuestra plataforma.</p>
        </div>
        <div class="w-2/5 flex justify-center">
            <img src="/assets/images/logo.png" alt="Logo de AVE" class="w-4/5">
        </div>
    </div>
    <div class="text-center mt-14">
        <h1 class="text-3xl font-semibold">EQUIPO DESARROLLADOR</h1>
    </div>
    <div class="grid grid-cols-5 gap-4 p-14">
        <div class="card bg-white rounded-lg shadow-lg p-4 text-center">
            <img src="/assets/images/ema.png" alt="Imagen Circular" class="mx-auto rounded-full mt-4 w-24 h-24">
            <p class="text-lg mt-4 mb-5">Emanuel García</p>
        </div>
        <div class="card bg-white rounded-lg shadow-lg p-4 text-center">
            <img src="/assets/images/angel.jpg" alt="Imagen Circular" class="mx-auto rounded-full mt-4 w-24 h-24">
            <p class="text-lg mt-4 mb-5">Ángel Peña</p>
        </div>
        <div class="card bg-white rounded-lg shadow-lg p-4 text-center">
            <img src="/assets/images/cynthia.jpg" alt="Imagen Circular" class="mx-auto rounded-full mt-4 w-24 h-24">
            <p class="text-lg mt-4 mb-5">Cynthia Balam</p>
        </div>
        <div class="card bg-white rounded-lg shadow-lg p-4 text-center">
            <img src="/assets/images/nico.jpg" alt="Imagen Circular" class="mx-auto rounded-full mt-4 w-24 h-24">
            <p class="text-lg mt-4 mb-5">Nicolás Reyes</p>
        </div>
        <div class="card bg-white rounded-lg shadow-lg p-4 text-center">
            <img src="/assets/images/said.jpg" alt="Imagen Circular" class="mx-auto rounded-full mt-4 w-24 h-24">
            <p class="text-lg mt-4 mb-5">Said Ricardes</p>
        </div>
    </div>
    <div class="text-center mb-12">
        <h1>"El futuro pertenece a los que codifican." - Bill Gates</h1>
    </div>
    <footer class="text-white p-6" style="background-image: url('/assets/images/footer_bg.jpg'); background-size: 100% 100%;">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center">
                <img src="/assets/images/logo.png" alt="Logo" class="w-24 h-auto">
                <div class="text-left ml-6">
                    <p class="font-semibold mb-2">Menú</p>
                    <p class="mb-1"><a href="/" class="hover:text-gray-300">Inicio</a></p>
                    <p><a href="/goals" class="hover:text-gray-300">Objetivos</a></p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-semibold">TIAM22</p>
            </div>
        </div>
    </footer>
</body>
</html>
