

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Hall of Fame</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #1b1f24;">
    <div class="container">
        <a class="navbar-brand text-light fw-bold" href="/">
            CS Hall of Fame
        </a>

        <a href="{{ route('jugadores.index') }}"
           class="btn"
           style="background-color:#ff7b00;color:white;">
            Jugadores
        </a>
    </div>

    <div>

    <a href="/"
       class="btn btn-dark-custom">
        Inicio
    </a>

    <a href="{{ route('jugadores.index') }}"
       class="btn btn-cs">
        Jugadores
    </a>

    <a href="{{ route('ranking') }}"
       class="btn btn-dark-custom">
        Ranking
    </a>

    <a href="{{ route('equipos.index') }}"
       class="btn btn-dark-custom">
        Equipos
    </a>

</div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>