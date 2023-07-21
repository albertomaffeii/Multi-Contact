<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <!-- Aplication CSS -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>    
    </head>   

    <body class="antialiased">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id ="navbar">
                    <a href="/" class="navbar-brand">
                          <strong> ALBERTO MAFFEI</strong>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="home-outline"></ion-icon> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contacts/create" class="nav-link">New Contacts</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">My Contacts</a>
                            </li>
                            <li class="nav-item">
                                <button type="button" wire:click="logout">Log Out</button>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Register</a>
                            </li>
                        @endguest

                    </ul>
                </div>
            </nav>
        </header>

        <div>
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                        <p class="msg">{{ session('msg')}}</p>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </main>

            

            <footer>
                <dic class="row">
                <div class="col-md-6">
                    GitHub: 
                <a href="https://github.com/albertomaffeii/Multi-Contact" target="_blank" >github.com/albertomaffeii/Multi-Contact</a>

                </div>
                <div class="col-md-6">
                    <a href="#" target="_blank" >Laravel v{{ Illuminate\Foundation\Application::VERSION }} | (PHP v{{ PHP_VERSION }})</a>
                </div>
                </dic>
            </footer>        
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>