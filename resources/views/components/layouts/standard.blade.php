<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/navigation/standard-nav.css'])
</head>

<body>
    <header>
        <nav id="standard-nav">
            <section id="nav-links">
                <a href=""><small>About</small></a>
                <a href=""><small>Contact</small></a>
                <a href=""><small>More</small></a>
                <a href=""><small>Terms and Conditions</small></a>
                <a href=""><small>Delivery</small></a>
            </section>
            <section id="nav-main">
                <div id="logo">Logo</div>
                <div id="searchbar">SearchBar</div>
                <div id="actions">Actions</div>
                <div id="menu"><x-helpers.menu> </x-helpers.menu></div>
            </section>
            <section id="nav-filters">Filters</section>
        </nav>
    </header>
    {{ $slot }}
    <footer>

    </footer>
</body>

</html>
