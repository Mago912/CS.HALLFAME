@extends('layouts.app')

@section('content')
<div class="container py-4">

    <a href="{{ route('jugadores.index') }}" class="btn-card-icon mb-4 d-inline-flex">
        <i class="bi bi-arrow-left"></i>
    </a>

    <div class="profile-card">

        {{-- Columna imagen --}}
        <div class="profile-img-col">
            @if ($jugador->imagen)
                <img src="{{ $jugador->imagen }}"
                     alt="{{ $jugador->nickname }}"
                     class="profile-img">
            @else
                <div class="profile-img-empty">
                    <i class="bi bi-person" style="font-size:5rem; color:#2d3748;"></i>
                </div>
            @endif
        </div>

        {{-- Columna info --}}
        <div class="profile-info-col">

            <div class="profile-country">{{ $jugador->pais }}</div>
            <h1 class="profile-nickname">{{ $jugador->nickname }}</h1>

            @if ($jugador->equipo)
            <div class="profile-team">
                <i class="bi bi-shield-fill" style="color:#e8b400;"></i>
                {{ $jugador->equipo->nombre }}
                @if ($jugador->equipo->pais)
                    <span class="team-country">({{ $jugador->equipo->pais }})</span>
                @endif
            </div>
            @endif

            <div class="profile-stats">
                <div class="profile-stat">
                    <span class="profile-stat-value">{{ $jugador->mvps }}</span>
                    <span class="profile-stat-label">MVPs</span>
                </div>
                <div class="profile-stat">
                    <span class="profile-stat-value">{{ $jugador->majors }}</span>
                    <span class="profile-stat-label">Majors</span>
                </div>
            </div>

            @if ($jugador->descripcion)
            <div class="profile-bio">
                <div class="profile-bio-label">Sobre el jugador</div>
                <p class="profile-bio-text">{{ $jugador->descripcion }}</p>
            </div>
            @endif

            <div class="profile-actions">
                <a href="{{ route('jugadores.edit', $jugador) }}"
                   class="btn-ver-perfil">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <form action="{{ route('jugadores.destroy', $jugador) }}"
                      method="POST" style="display:contents"
                      onsubmit="return confirm('¿Eliminar a {{ $jugador->nickname }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-card-icon danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
.profile-card {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    gap: 0;
    max-width: 860px;
}
.profile-img-col {
    width: 300px;
    flex-shrink: 0;
    background: #161b22;
}
.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    display: block;
    min-height: 380px;
}
.profile-img-empty {
    width: 100%;
    min-height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.profile-info-col {
    flex: 1;
    padding: 2rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.profile-country {
    font-size: 13px;
    font-weight: 600;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-bottom: 8px;
}
.profile-nickname {
    font-size: 2.8rem;
    font-weight: 800;
    color: #e6edf3;
    line-height: 1;
    margin-bottom: .75rem;
}
.profile-team {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 600;
    color: #e6edf3;
    margin-bottom: 1.25rem;
}
.team-country {
    color: #7d8590;
    font-weight: 400;
    font-size: 13px;
}
.profile-stats {
    display: flex;
    gap: 12px;
    margin-bottom: 1.75rem;
}
.profile-stat {
    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 10px;
    padding: 14px 24px;
    text-align: center;
    min-width: 90px;
}
.profile-stat-value {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    color: #e8b400;
    line-height: 1.1;
}
.profile-stat-label {
    display: block;
    font-size: 11px;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 4px;
}
.profile-bio {
    margin-bottom: 1.75rem;
}
.profile-bio-label {
    font-size: 12px;
    font-weight: 600;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 6px;
}
.profile-bio-text {
    color: #8b949e;
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
}
.profile-actions {
    display: flex;
    gap: 8px;
}
</style>

@endsection