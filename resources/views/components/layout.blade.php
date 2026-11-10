{{--lang="{{ str_replace('_', '-', app()->getLocale()) }}" --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Livros - Início</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

</head>
<body class="bg-light">
    <!-- Verifica la ruta atual para aplicar a classe 'active' para la navegacion -->
{{--request()->routeIs('books.*')--}}
    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
              <!-- Boton para indices de libros pagina -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
                <i class="bi bi-book me-2 fs-4"></i>
                Panel de Libros
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Adicione a classe 'active' com base a  la ruta atual -->
                    <li class="nav-item"><a @class(['nav-link', 'active' => request()->routeIs('index')]) href="{{ route('index') }}">Início</a></li>
                    <li class="nav-item"><a @class(['nav-link', 'active' => request()->routeIs('books.*')]) href="{{ route('books.index') }}">Libros</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
{{ $slot }}


</body>
</html>
