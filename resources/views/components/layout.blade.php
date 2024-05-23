@props(['isHtmxRequest'])

@php
    $year = date("Y");
@endphp

@empty($isHtmxRequest)
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DrewB.com - @yield("title")</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/drewb.css?v=4">
        <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script src="/js/drewb.js?v=4"></script>
    </head>
    <body id="body" class="mx-2 mx-md-auto">
        <div id="full-page">
            <header>
                <nav class="navbar navbar-expand-md navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" hx-get="/" hx-target="#content" hx-push-url="true">
                            <img class="mb-1" src="/img/drewb_logo.png" alt="DrewB.com" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="main-nav">
                            <ul class="navbar-nav ms-md-2 me-auto mb-2 mb-md-0">
                                <li class="nav-item mt-2 mt-md-0 mb-4 mb-md-0">
                                    <a href="" class="nav-link links"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/home"
                                        hx-target="#content"
                                        hx-push-url="true">home</a>
                                </li>
                                <li class="nav-item mb-4 mb-md-0">
                                    <a href="" class="nav-link links"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/links"
                                        hx-target="#content"
                                        hx-push-url="true">links</a>
                                </li>
                                <li class="nav-item mb-4 mb-md-0">
                                    <a href="" class="nav-link links"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/gallery"
                                        hx-target="#content"
                                        hx-push-url="true">photos</a>
                                </li>
                                <li class="nav-item mb-md-0">
                                    <a href="" class="nav-link links"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/work"
                                        hx-target="#content"
                                        hx-push-url="true">work</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ms-md-auto me-md-2 mb-2 mb-md-0">
                                <li class="nav-item mt-2 mb-md-0">
                                    <a href="" class="nav-link admin"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/admin"
                                        hx-target="#content"
                                        hx-push-url="true">
                                        <span class="bi bi-gear-fill"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- nav, etc. -->
            </header>
            <main id="content">
<!-- end header -->
@endempty

                {{ $slot }}

@empty($isHtmxRequest)
<!-- start footer -->
            </main>
            <footer>
                <p class="text-center copyright">copyright &copy; 1998-{{ $year }} by Andrew C. Bertola</p>
            </footer>
        </div>
    </body>
</html>
@endempty
