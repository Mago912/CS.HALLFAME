@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('equipos.index') }}" class="btn-card-icon">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="text-white mb-0" style="font-size:1.6rem; font-weight:700;">
            Nuevo equipo
        </h1>
    </div>

    <div class="form-card">

        @if ($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-triangle"></i>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('equipos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text"
                       name="nombre"
                       class="form-input"
                       value="{{ old('nombre') }}"
                       placeholder="ej: FaZe Clan"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">País</label>
                <input type="text"
                       name="pais"
                       class="form-input"
                       value="{{ old('pais') }}"
                       placeholder="ej: Estados Unidos">
            </div>

            <div class="form-actions">
                <a href="{{ route('equipos.index') }}" class="btn-cancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn-guardar">
                    <i class="bi bi-check-lg"></i> Guardar equipo
                </button>
            </div>

        </form>
    </div>
</div>

<style>
.form-card {
    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    padding: 2rem;
    max-width: 620px;
}
.form-group { margin-bottom: 1.25rem; }
.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #7d8590;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 6px;
}
.form-input {
    width: 100%;
    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 8px;
    padding: 10px 14px;
    color: #e6edf3;
    font-size: 14px;
    outline: none;
    transition: border-color .15s;
    box-sizing: border-box;
}
.form-input:focus { border-color: #e8b400; }
.form-input::placeholder { color: #444; }
.alert-error {
    background: #1a0a0a;
    border: 1px solid #f85149;
    border-radius: 8px;
    padding: 12px 16px;
    color: #f85149;
    font-size: 14px;
    margin-bottom: 1.5rem;
    display: flex;
    gap: 10px;
    align-items: flex-start;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 1.75rem;
    padding-top: 1.25rem;
    border-top: 1px solid #21262d;
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
    transition: background .15s;
}
.btn-guardar:hover { background: #f0c420; }
.btn-cancelar {
    background: transparent;
    border: 1px solid #21262d;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 14px;
    color: #7d8590;
    text-decoration: none;
    transition: border-color .15s, color .15s;
}
.btn-cancelar:hover { border-color: #444; color: #e6edf3; }
</style>
@endsection
