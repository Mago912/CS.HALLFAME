@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Hero --}}
    <div class="home-hero">
        <div class="home-hero__bg"></div>
        <div class="home-hero__content">
            <div class="home-hero__eyebrow">Counter-Strike</div>
            <h1 class="home-hero__title">Hall of Fame</h1>
            <p class="home-hero__sub">
                Los mejores jugadores de la historia de Counter-Strike reunidos en un solo lugar.
            </p>
            <a href="{{ route('jugadores.index') }}" class="home-hero__btn">
                Ver todos los jugadores
            </a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="home-stats">

        <div class="home-stat-card">
            <div class="home-stat-card__icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="home-stat-card__value">{{ $totalJugadores }}</div>
                <div class="home-stat-card__label">Jugadores registrados</div>
            </div>
        </div>

        <div class="home-stat-card">
            <div class="home-stat-card__icon">
                <i class="bi bi-star"></i>
            </div>
            <div>
                @if ($masMvps)
                    <div class="home-stat-card__value">{{ $masMvps->nickname }}</div>
                    <div class="home-stat-card__label">Más MVPs</div>
                    <div class="home-stat-card__sub">{{ $masMvps->mvps }} MVPs</div>
                @endif
            </div>
        </div>

        <div class="home-stat-card">
            <div class="home-stat-card__icon">
                <i class="bi bi-trophy"></i>
            </div>
            <div>
                @if ($masMajors)
                    <div class="home-stat-card__value">{{ $masMajors->nickname }}</div>
                    <div class="home-stat-card__label">Más Majors</div>
                    <div class="home-stat-card__sub">{{ $masMajors->majors }} Majors</div>
                @endif
            </div>
        </div>

    </div>

    {{-- Top 3 --}}
    <div class="home-section-header">
        <div class="home-section-title">Top 3 por MVPs</div>
        <a href="{{ route('ranking') }}" class="home-section-link">
            Ver ranking completo →
        </a>
    </div>

    <div class="home-top3">
        @foreach ($topJugadores as $jugador)
        <a href="{{ route('jugadores.show', $jugador) }}"
           class="top3-card rank-{{ $loop->iteration }}"
           style="text-decoration:none;">

            <div class="top3-card__img">
                @if ($jugador->imagen)
                    <img src="{{ $jugador->imagen }}"
                         alt="{{ $jugador->nickname }}">
                @else
                    <i class="bi bi-person" style="font-size:3.5rem; color:#2d3748;"></i>
                @endif
                <div class="top3-card__rank">{{ $loop->iteration }}</div>
            </div>

            <div class="top3-card__body">
                <div class="top3-card__nick">{{ $jugador->nickname }}</div>
                <div class="top3-card__country">{{ $jugador->pais }}</div>
                <div class="top3-card__stats">
                    <div class="top3-card__stat">
                        <div class="top3-card__stat-val">{{ $jugador->mvps }}</div>
                        <div class="top3-card__stat-lbl">MVPs</div>
                    </div>
                    <div class="top3-card__stat">
                        <div class="top3-card__stat-val">{{ $jugador->majors }}</div>
                        <div class="top3-card__stat-lbl">Majors</div>
                    </div>
                </div>
            </div>

        </a>
        @endforeach
    </div>

</div>

<style>
/* Hero */
.home-hero {
    position: relative;
    min-height: 340px;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    margin-bottom: 20px;
    background: #0d1117;
}
.home-hero__bg {
    position: absolute; inset: 0;
    background: url('https://img-cdn.hltv.org/gallerypicture/eEPJz4pAKEJQYis-jOB5KK.jpg?auto=compress&fm=avif&ixlib=java-2.1.0&m=%2Fm.png&mw=160&mx=30&my=710&q=75&w=1200&s=2f93b798f142b986f42ed20691684c32')
                center / cover no-repeat;
    filter: brightness(0.3);
}
.home-hero__content {
    position: relative;
    padding: 40px 36px;
    width: 100%;
}
.home-hero__eyebrow {
    font-size: 12px;
    font-weight: 700;
    color: #e8b400;
    text-transform: uppercase;
    letter-spacing: .14em;
    margin-bottom: 8px;
}
.home-hero__title {
    font-size: 3rem;
    font-weight: 800;
    color: #e6edf3;
    line-height: 1;
    margin-bottom: 10px;
}
.home-hero__sub {
    font-size: 15px;
    color: #8b949e;
    margin-bottom: 24px;
    max-width: 480px;
}
.home-hero__btn {
    background: #e8b400;
    color: #0d1117;
    border: none;
    border-radius: 8px;
    padding: 11px 28px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    transition: background .15s;
}
.home-hero__btn:hover { background: #f0c420; color: #0d1117; }

/* Stat cards */
.home-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 28px;
}
.home-stat-card {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.home-stat-card__icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: #161b22;
    border: 1px solid #21262d;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    color: #e8b400;
    flex-shrink: 0;
}
.home-stat-card__value {
    font-size: 20px;
    font-weight: 800;
    color: #e6edf3;
    line-height: 1.1;
}
.home-stat-card__label {
    font-size: 12px;
    color: #7d8590;
    margin-top: 2px;
}
.home-stat-card__sub {
    font-size: 13px;
    color: #e8b400;
    font-weight: 600;
    margin-top: 2px;
}

/* Section header */
.home-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}
.home-section-title {
    font-size: 16px;
    font-weight: 700;
    color: #e6edf3;
    display: flex;
    align-items: center;
    gap: 8px;
}
.home-section-title::before {
    content: '';
    display: block;
    width: 3px; height: 18px;
    background: #e8b400;
    border-radius: 2px;
}
.home-section-link {
    font-size: 13px;
    color: #7d8590;
    text-decoration: none;
    transition: color .15s;
}
.home-section-link:hover { color: #e8b400; }

/* Top 3 */
.home-top3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.top3-card {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    transition: transform .18s, border-color .18s;
    display: block;
}
.top3-card:hover { transform: translateY(-4px); border-color: #e8b400; }
.top3-card.rank-1 { border-color: #e8b400; }
.top3-card.rank-2 { border-color: #555; }
.top3-card__img {
    height: 180px;
    background: #161b22;
    overflow: hidden;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.top3-card__img img {
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: top center;
}
.top3-card__rank {
    position: absolute;
    top: 10px; left: 10px;
    width: 30px; height: 30px;
    border-radius: 50%;
    font-size: 13px;
    font-weight: 800;
    display: flex; align-items: center; justify-content: center;
}
.rank-1 .top3-card__rank { background: #e8b400; color: #0d1117; }
.rank-2 .top3-card__rank { background: #8b949e; color: #0d1117; }
.rank-3 .top3-card__rank { background: #b08d57; color: #0d1117; }
.top3-card__body { padding: 14px; }
.top3-card__nick {
    font-size: 16px;
    font-weight: 700;
    color: #e6edf3;
    margin-bottom: 2px;
}
.top3-card__country {
    font-size: 12px;
    color: #7d8590;
    margin-bottom: 10px;
}
.top3-card__stats { display: flex; gap: 8px; }
.top3-card__stat {
    flex: 1;
    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 7px;
    padding: 6px;
    text-align: center;
}
.top3-card__stat-val {
    font-size: 15px;
    font-weight: 700;
    color: #e8b400;
}
.top3-card__stat-lbl {
    font-size: 10px;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .06em;
}

/* Responsive */
@media (max-width: 768px) {
    .home-stats,
    .home-top3 { grid-template-columns: 1fr; }
    .home-hero__title { font-size: 2rem; }
}
</style>

@endsection