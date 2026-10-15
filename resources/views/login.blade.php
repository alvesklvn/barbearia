<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/global.css', 'resources/css/header.css', 'resources/js/header.js', 'resources/css/hero.css'])
</head>
<body>
    <header id="header-desktop">
        <img src="{{ asset('img/logo.png') }}" alt="Logo barbearia" class="logo">
        <nav class="desktop">
            <ul aria-label="menu">
                <a href="#"><li>Inicio</li></a>
                <a href="#"><li>Sobre</li></a>
                <a href="#"><li>Contato</li></a>
            </ul>
        </nav>
        <a href="#" class="btn-agendamento">Agendar</a>
    </header>

    <header id="header-mobile">
        <img src="{{ asset('img/logo.png') }}" alt="Logo barbearia" class="logo">
        <img src="{{ asset('img/menu-hamburguer.png')}}" alt="Menu Hamburguer" class="menu-hamburguer">
        <nav class="mobile">
            <img src="{{ asset('img/fechar.png') }}" alt="Fechar Menu" class="fechar    ">    
            <ul aria-label="menu">
                <a href="#"><li>Inicio</li></a>
                <a href="#"><li>Sobre</li></a>
                <a href="#"><li>Contato</li></a>
            </ul>
            <a href="#">Agendar</a>
        </nav>
    </header>

    <div class="blur-background"></div>
    <section class="hero">
        <h2>mais que um corte</h2>
        <h1>Seu estilo<br><span>começa aqui.</span></h1>
        <p>Cortes modernos, cuidados com<br>a barba e uma experiência<br>completa. Agendamento prático,<br>no seu tempo.</p>
        <div class="botoes">
            <a href="#">Agendar agora</a>
            <a href="#">Entrar</a>
            <a href="#">Criar conta</a>
        </div>
    </section>
</body>
</html>