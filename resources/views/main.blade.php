<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Shop at Fresh2GoHub; Fruits, Veggies, Sauces and more! It's all Fresh2Go." />
    <meta name="robots" content="index, follow" />

    <title>{{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="ico"
        href="{{ App\Http\Controllers\FileController::serveImageFile('favicon', 'ico') }}">

    <!-- Fonts and CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        defer>

    {{-- Vite assets from production --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="inter-font">
    {{-- Navigation --}}
    <header>
       <x-nav />
    </header>
    <main>
        <div id="push"></div>
        <div id="content" class="center">
            <section id="hero" class="center section">
                @livewire('main.carousel', ['title' => $title])
            </section>
            <div class="divider-sp"></div>
            <section id="aboutus" class="section center">
                @livewire('main.section', ['heading' => 'Why choose Fresh2Go?', 'text' => "When you're passionate about something, ideas tend to expand and eventually become the sparks for action. We at Fresh2GoHub believe in better ingredients, better food and the best quality to go"])
            </section>
            <div class="divider"></div>
        </div>
    </main>

    <footer class="center">
        <x-footer />
    </footer>
</body>

</html>
