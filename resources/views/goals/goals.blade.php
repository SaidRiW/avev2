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
            <div class="p-[1.375rem] hover:bg-red-600">
                <a href="/">INICIO</a>
            </div>
            <div class="p-[1.375rem] bg-red-600 hover:bg-red-700">
                <a href="#">OBJETIVOS</a>
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
    <div class="flex justify-between items-center p-6 lg:p-8 bg-white">
        <div class="w-3/5 space-y-4 ml-6 mr-12 mb-8">
            <h1 class="text-[1.375rem] font-semibold text-blue-900 mt-4">"LA PLATAFORMA QUE OFRECEMOS CONSTITUYE UNA VALIOSA HERRAMIENTA PARA IMPULSAR LA COMUNICACIÓN".</h1>
            <h2 class="text-xl font-bold">Visión</h2>
            <p class="text-lg text-justify">Convertir a la plataforma en líder a nivel mundial en la gestión y organización escolar, brindando a docentes y alumnos una herramienta integral que les permita optimizar su tiempo, fomentar la comunicación efectiva y lograr un mayor éxito en su vida académica.</p>
            <h2 class="text-xl font-bold">Misión</h2>
            <p class="text-lg text-justify">Proporcionar a estudiantes una agenda virtual escolar intuitiva y completa, que les permita organizar sus eventos, mantener una comunicación fluida y eficiente, y llevar un seguimiento adecuado de sus eventos académicas. Nos esforzamos por desarrollar nuestra aplicación y página web para ofrecer la mejor experiencia posible, adaptada a las necesidades cambiantes de la comunidad educativa.</p>
        </div>
        <div class="w-2/5 flex justify-center">
            <img src="/assets/images/redsocial.webp" alt="Ilustración" class="w-6/7">
        </div>
    </div>
    <footer class="text-white p-6" style="background-image: url('/assets/images/footer_bg.jpg'); background-size: 100% 100%;">
        <div class="container mx-auto flex items-center">
            <img src="/assets/images/logo.png" alt="Logo de AVE" class="w-24 h-auto">
            <div class="text-left ml-6">
                <p class="font-semibold mb-2">Menú</p>
                <p class="mb-1"><a href="/" class="hover:text-gray-300">Inicio</a></p>
                <p><a href="#objetivos" class="hover:text-gray-300">Objetivos</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
