@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="text-white mb-1" style="font-size:1.6rem; font-weight:700;">
        Ranking Histórico
    </h1>
    <p style="color:#7d8590; font-size:14px; margin-bottom:2rem;">
        Los jugadores con más MVPs de la historia del Counter-Strike
    </p>

    {{-- Top 3 Podio --}}
    @if ($jugadores->count() >= 3)
    <div class="podium">
        @php
            $second = $jugadores[1];
            $first = $jugadores[0];
            $third = $jugadores[2];
        @endphp

        {{-- Segundo lugar --}}
        <div class="podium-item podium-second">
            <div class="podium-avatar-wrap">
                <div class="podium-rank rank-2">2</div>
                @if ($second->imagen)
                    <img src="{{ $second->imagen }}" alt="{{ $second->nickname }}" class="podium-avatar">
                @else
                    <div class="podium-avatar podium-avatar-empty"><i class="bi bi-person"></i></div>
                @endif
            </div>
            <div class="podium-name">{{ $second->nickname }}</div>
            <div class="podium-team">{{ $second->equipo->nombre ?? '' }}</div>
            <div class="podium-stat">
                <span class="podium-stat-value">{{ $second->mvps }}</span>
                <span class="podium-stat-label">MVPs</span>
            </div>
        </div>

        {{-- Primer lugar --}}
        <div class="podium-item podium-first">
            <div class="podium-crown"><i class="bi bi-trophy-fill" style="color:#e8b400;"></i></div>
            <div class="podium-avatar-wrap">
                <div class="podium-rank rank-1">1</div>
                @if ($first->imagen)
                    <img src="{{ $first->imagen }}" alt="{{ $first->nickname }}" class="podium-avatar podium-avatar-lg">
                @else
                    <div class="podium-avatar podium-avatar-lg podium-avatar-empty"><i class="bi bi-person"></i></div>
                @endif
            </div>
            <div class="podium-name">{{ $first->nickname }}</div>
            <div class="podium-team">{{ $first->equipo->nombre ?? '' }}</div>
            <div class="podium-stat">
                <span class="podium-stat-value">{{ $first->mvps }}</span>
                <span class="podium-stat-label">MVPs</span>
            </div>
        </div>

        {{-- Tercer lugar --}}
        <div class="podium-item podium-third">
            <div class="podium-avatar-wrap">
                <div class="podium-rank rank-3">3</div>
                @if ($third->imagen)
                    <img src="{{ $third->imagen }}" alt="{{ $third->nickname }}" class="podium-avatar">
                @else
                    <div class="podium-avatar podium-avatar-empty"><i class="bi bi-person"></i></div>
                @endif
            </div>
            <div class="podium-name">{{ $third->nickname }}</div>
            <div class="podium-team">{{ $third->equipo->nombre ?? '' }}</div>
            <div class="podium-stat">
                <span class="podium-stat-value">{{ $third->mvps }}</span>
                <span class="podium-stat-label">MVPs</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Tabla del resto --}}
    @if ($jugadores->count() > 3)
    <div class="ranking-table-wrap">
        <table class="ranking-table">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th style="width:50px;"></th>
                    <th>Jugador</th>
                    <th>Equipo</th>
                    <th class="text-center">MVPs</th>
                    <th class="text-center">Majors</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jugadores->skip(3) as $jugador)
                <tr>
                    <td class="rank-num">{{ $loop->iteration + 3 }}</td>
                    <td>
                        @if ($jugador->imagen)
                            <img src="{{ $jugador->imagen }}" alt="" class="table-avatar">
                        @else
                            <div class="table-avatar table-avatar-empty"><i class="bi bi-person"></i></div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('jugadores.show', $jugador->id) }}" class="table-nickname">
                            {{ $jugador->nickname }}
                        </a>
                        <div class="table-country">{{ $jugador->pais }}</div>
                    </td>
                    <td style="color:#7d8590; font-size:13px;">
                        {{ $jugador->equipo->nombre ?? '—' }}
                    </td>
                    <td class="text-center">
                        <span class="table-badge badge-gold">{{ $jugador->mvps }}</span>
                    </td>
                    <td class="text-center">
                        <span class="table-badge badge-silver">{{ $jugador->majors }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

<style>
.podium {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 20px;
    margin-bottom: 3rem;
    padding: 0 1rem;
}
.podium-item {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 16px;
    padding: 1.5rem 1.25rem;
    text-align: center;
    flex: 1;
    max-width: 220px;
    transition: border-color .2s;
}
.podium-item:hover { border-color: #333; }
.podium-first { order: 2; border-color: #e8b400; }
.podium-second { order: 1; }
.podium-third { order: 3; }
.podium-crown {
    font-size: 1.8rem;
    margin-bottom: 8px;
}
.podium-avatar-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 12px;
}
.podium-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #21262d;
    display: block;
}
.podium-avatar-lg {
    width: 100px;
    height: 100px;
    border-color: #e8b400;
}
.podium-avatar-empty {
    background: #161b22;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2d3748;
    font-size: 2rem;
}
.podium-rank {
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    font-size: 12px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0d1117;
}
.rank-1 { background: #e8b400; }
.rank-2 { background: #8b949e; }
.rank-3 { background: #cd7f32; }
.podium-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #e6edf3;
    margin-bottom: 2px;
}
.podium-team {
    font-size: 12px;
    color: #7d8590;
    margin-bottom: 10px;
    min-height: 16px;
}
.podium-stat-value {
    display: block;
    font-size: 1.6rem;
    font-weight: 800;
    color: #e8b400;
    line-height: 1.1;
}
.podium-stat-label {
    display: block;
    font-size: 10px;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .08em;
}
.ranking-table-wrap {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    overflow: hidden;
}
.ranking-table {
    width: 100%;
    border-collapse: collapse;
}
.ranking-table th {
    background: #161b22;
    color: #7d8590;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .06em;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #21262d;
}
.ranking-table td {
    padding: 12px 16px;
    border-bottom: 1px solid #161b22;
    vertical-align: middle;
}
.ranking-table tr:last-child td { border-bottom: none; }
.ranking-table tr:hover { background: #161b22; }
.rank-num {
    color: #7d8590;
    font-weight: 700;
    font-size: 14px;
}
.table-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #21262d;
    display: block;
}
.table-avatar-empty {
    background: #161b22;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2d3748;
    font-size: 1rem;
}
.table-nickname {
    color: #e6edf3;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
}
.table-nickname:hover { color: #e8b400; }
.table-country {
    color: #7d8590;
    font-size: 12px;
}
.table-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}
.badge-gold {
    background: rgba(232, 180, 0, 0.12);
    color: #e8b400;
}
.badge-silver {
    background: rgba(139, 148, 158, 0.12);
    color: #8b949e;
}
.text-center { text-align: center; }
</style>
@endsection
