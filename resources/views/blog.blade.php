<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Test Tecnico Rosanyelis Mendoza</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('blog.css') }}" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-12 px-0 text-center">
                <h1 class="display-4 fst-italic">Test Técnico <br>Rosanyelis Mendoza <br>(Ross Digital)</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <h4>Categorías</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="\?categoria=bitcoin">Bitcoin</a>
                    </li>
                    <li class="list-group-item">
                        <a href="\?categoria=apple">Apple</a>
                    </li>
                    <li class="list-group-item">
                        <a href="\?categoria=google">Google</a>
                    </li>
                    <li class="list-group-item">
                        <a href="\?categoria=economy">Economía</a>
                    </li>
                    <li class="list-group-item">
                        <a href="\?categoria=policy">Política</a>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <form class="row " action="" method="GET">
                        @csrf
                    <input type="hidden" name="categoria" value="@if ($categoria){{ $categoria }}@endif">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="dateInit" class="form-control" id="fechaInicio"
                            value="{{ request()->dateInit }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha Fin</label>
                            <input type="date" name="dateFin" class="form-control" id="fechaFin"
                            value="{{ request()->dateFin }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary mt-4" type="submit">Filtrar</button>
                    </div>
                </form>
                <div class="row gy-3">
                    @foreach ($articles as $item)
                    <div class="col-md-6">
                        <div class="card" >
                            <img src="{{ $item['image'] }}" class="card-img-top img-fluid" alt="{{ $item['title'] }}">
                            <div class="card-body">
                                <h4>{{ $item['title'] }}</h4>
                                <div class="mb-1 text-body-secondary"><strong>Autor:</strong> {{ $item['autor'] }}</div>
                                <div class="mb-1 text-body-secondary"><strong>Fecha de Publicación:</strong> {{ $item['date_published'] }}</div>
                                <p class="card-text text-truncate">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-md-12 mt-4 mb-4 text-center">
                    @foreach ($pages as $page)
                        @if ($page == $currentPage)
                        <a class="btn btn-secondary" href="#" disabled>{{ $page }}</a>
                        @else
                        <a class="btn btn-primary" href="@if ($categoria) /?categoria={{ $categoria }}@endif&@if (request()->dateInit)dateInit={{ request()->dateInit }}@endif&@if (request()->dateFin)dateFin={{ request()->dateFin }}@endif&page={{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
