@props(['isHtmxRequest', 'searchQuery'])

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
        <script src="/js/task.js?v=1"></script>
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
                            <ul class="navbar-nav ms-md-2 me-auto mb-2 mb-md-0">
                                <li class="nav-item dropdown mx-3 mt-2 mt-md-0 mb-2 mb-md-0">
                                    <a href="" class="nav-link active dropdown-toggle"
                                        role="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        View
                                    </a>
                                    <ul id="navView" class="dropdown-menu">
                                        <li>
                                            <a href="" class="dropdown-item"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#navView.show"
                                                hx-get="/"
                                                hx-target="#content"
                                                hx-push-url="true">All</a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#navView.show"
                                                hx-get="/own"
                                                hx-target="#content"
                                                hx-push-url="true">I Own</a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#navView.show"
                                                hx-get="/wrote"
                                                hx-target="#content"
                                                hx-push-url="true">I Wrote</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item mx-3 mt-2 mt-md-0 mb-2 mb-md-0">
                                    <form id="searchForm">
                                        <div class="input-group">
                                            @csrf
                                            <input type="text" class="form-control py-1 mt-1"
                                                name="searchQuery"
                                                value="{{ $searchQuery }}"
                                                placeholder="Search Tasks..."
                                                onkeyup="
                                                    const btn = document.getElementById('searchSubmit');
                                                    if (event.key !== 'Enter') {
                                                        btn.setAttribute('hx-get',
                                                            '/search/' + this.value.replace(' ', '+')
                                                        );
                                                        htmx.process('#searchSubmit');
                                                    }
                                                " />
                                            <button id="searchSubmit" type="submit" class="input-group-text bi bi-search py-1 mt-1"
                                                    hx-get=""
                                                    hx-target="#content"
                                                    hx-push-url="true"
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                            <ul class="navbar-nav ms-md-auto me-md-2 mb-2 mb-md-0">
                                <li class="nav-item mx-3 mt-2 mt-md-0 mb-4 mb-md-0">
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
