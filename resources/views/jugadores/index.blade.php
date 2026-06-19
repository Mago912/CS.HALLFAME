@extends ('layouts.app')
@section('content')



<h1 class="mb-4">Jugadores Históricos</h1>


<a href="{{ route('jugadores.create') }}"
   class="btn mb-3"
   style="background-color:#ff7b00;color:white;">
    Agregar Jugador
</a>

<div class="card shadow-sm">
    <div class="card-body">


<div class="mb-3">
    <input
        type="text"
        id="buscador"
        class="form-control"
        placeholder="Buscar jugador..."
    >
</div>

<div class="row">

@foreach($jugadores as $jugador)

<div class="col-md-4 mb-4 fila-jugador">

    <div class="card player-card h-100">

        @if($jugador->imagen)
           <img src="{{ $jugador->imagen }}" alt="{{ $jugador->nickname }}">
                 
                 
        @endif

        <div class="card-body">

            <h3 class="card-title">
                {{ $jugador->nickname }}
            </h3>

            @if ($jugador->equipo)
            <p style="color:#e8b400; font-size:13px; font-weight:600; margin-bottom:6px;">
                🛡️ {{ $jugador->equipo->nombre }}
            </p>
            @endif

            <p>
                🌍 {{ $jugador->pais }}
            </p>

            <p>
                🏆 {{ $jugador->mvps }} MVPs
            </p>

            <p>
                🏅 {{ $jugador->majors }} Majors
            </p>

        </div>

        <div class="card-footer">

            <a href="{{ route('jugadores.show', $jugador->id) }}"
               class="btn btn-dark-custom btn-sm">
                Ver
            </a>

            <a href="{{ route('jugadores.edit', $jugador->id) }}"
               class="btn btn-cs btn-sm">
                Editar
            </a>

            <form action="{{ route('jugadores.destroy', $jugador->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Eliminar jugador?')">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

</div>


            </body>

        </table>

    </div>
</div>

<script>
document.getElementById('buscador').addEventListener('keyup', function() {

    let texto = this.value.toLowerCase();

    document.querySelectorAll('.fila-jugador').forEach(fila => {

        let contenido = fila.textContent.toLowerCase();

        fila.style.display =
            contenido.includes(texto)
            ? ''
            : 'none';

    });

});
</script>



@endsection