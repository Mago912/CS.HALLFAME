@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="text-white mb-0" style="font-size:1.6rem; font-weight:700;">
            Equipos
        </h1>
        <a href="{{ route('equipos.create') }}" class="btn-guardar">
            <i class="bi bi-plus-lg"></i> Nuevo equipo
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if ($equipos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-people" style="font-size:3rem; color:#7d8590;"></i>
            <p class="text-white mt-3">No hay equipos creados todavía.</p>
            <a href="{{ route('equipos.create') }}" class="btn-guardar mt-2">Crear primer equipo</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="equipo-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>País</th>
                        <th>Jugadores</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                        <tr>
                            <td class="text-white fw-bold">{{ $equipo->nombre }}</td>
                            <td style="color:#7d8590;">{{ $equipo->pais ?: '—' }}</td>
                            <td style="color:#7d8590;">{{ $equipo->jugadores_count }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn-action" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('equipos.destroy', $equipo->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este equipo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
.equipo-table {
    width: 100%;
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    overflow: hidden;
    border-collapse: separate;
    border-spacing: 0;
}
.equipo-table th {
    background: #161b22;
    color: #7d8590;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .06em;
    padding: 12px 16px;
    border-bottom: 1px solid #21262d;
}
.equipo-table td {
    padding: 12px 16px;
    border-bottom: 1px solid #21262d;
    vertical-align: middle;
}
.equipo-table tr:last-child td {
    border-bottom: none;
}
.btn-action {
    background: transparent;
    border: 1px solid #21262d;
    border-radius: 6px;
    padding: 6px 10px;
    color: #7d8590;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    transition: all .15s;
    display: inline-flex;
    align-items: center;
}
.btn-action:hover {
    border-color: #e8b400;
    color: #e8b400;
}
.btn-delete:hover {
    border-color: #f85149;
    color: #f85149;
}
.btn-guardar {
    background: #e8b400;
    color: #0d1117;
    border: none;
    border-radius: 8px;
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-guardar:hover { background: #f0c420; }
.alert-success {
    background: #0a1a0a;
    border: 1px solid #3fb950;
    border-radius: 8px;
    padding: 12px 16px;
    color: #3fb950;
    font-size: 14px;
    margin-bottom: 1.5rem;
    display: flex;
    gap: 10px;
    align-items: center;
}
.empty-state {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    padding: 3rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
@endsection
