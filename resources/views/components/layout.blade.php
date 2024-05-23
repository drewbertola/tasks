@props(['isHtmxRequest'])

@empty($isHtmxRequest)
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tasks</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/tasks.css?v=1">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body id="body" class="mx-2 mx-md-auto">
        <div id="full-page">
            <header>
                <nav class="navbar navbar-expand-md navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" hx-get="/" hx-target="#content" hx-push-url="true">
                            Tasks
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="main-nav">
                            @auth
                            <ul class="navbar-nav ms-md-auto me-md-2 mb-2 mb-md-0">
                                <li class="nav-item mt-2 mb-md-0">
                                    <a href="" class="nav-link active"
                                        data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse.show"
                                        hx-get="/logout"
                                        hx-target="#content"
                                        hx-push-url="false">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            @endauth
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
            </footer>
        </div>
    </body>
</html>
@endempty
