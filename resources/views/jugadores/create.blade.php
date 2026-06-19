@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('jugadores.index') }}" class="btn-card-icon">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="text-white mb-0" style="font-size:1.6rem; font-weight:700;">
            Agregar jugador
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

        <form action="{{ route('jugadores.store') }}"
              method="POST">
            @csrf

            {{-- Nickname --}}
            <div class="form-group">
                <label class="form-label">Nickname</label>
                <input type="text"
                       name="nickname"
                       class="form-input"
                       value="{{ old('nickname') }}"
                       placeholder="ej: s1mple"
                       required>
            </div>

            {{-- País --}}
            <div class="form-group">
                <label class="form-label">País</label>
                <input type="text"
                       name="pais"
                       class="form-input"
                       value="{{ old('pais') }}"
                       placeholder="ej: Ucrania"
                       required>
            </div>

            {{-- MVPs y Majors en fila --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">MVPs</label>
                    <input type="number"
                           name="mvps"
                           class="form-input"
                           value="{{ old('mvps', 0) }}"
                           min="0"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Majors</label>
                    <input type="number"
                           name="majors"
                           class="form-input"
                           value="{{ old('majors', 0) }}"
                           min="0"
                           required>
                </div>
            </div>

            {{-- Equipo (si ya tenés la relación) --}}
            @isset($equipos)
            <div class="form-group">
                <label class="form-label">Equipo</label>
                <select name="equipo_id" class="form-input">
                    <option value="">— Sin equipo —</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}"
                            {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endisset

            {{-- Descripción --}}
            <div class="form-group">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion"
                          class="form-input"
                          rows="3"
                          placeholder="Breve historia o logros del jugador...">{{ old('descripcion') }}</textarea>
            </div>

            {{-- Imagen --}}
            <div class="form-group">
                <label class="form-label">Foto del jugador (URL)</label>
                <input type="text"
                       name="imagen"
                       class="form-input"
                       value="{{ old('imagen') }}"
                       placeholder="https://ejemplo.com/imagen.jpg">
                <div id="img-preview-wrap" style="margin-top:10px; display:none;">
                    <img id="img-preview" src="" alt="preview"
                         style="width:100px; border-radius:8px; border:1px solid #21262d;">
                </div>
            </div>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('jugadores.index') }}" class="btn-cancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn-guardar">
                    <i class="bi bi-check-lg"></i> Guardar jugador
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

.form-group {
    margin-bottom: 1.25rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

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

.form-input:focus {
    border-color: #e8b400;
}

.form-input::placeholder {
    color: #444;
}

textarea.form-input {
    resize: vertical;
    min-height: 90px;
}

select.form-input option {
    background: #161b22;
}

.file-upload-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    background: #161b22;
    border: 1px dashed #21262d;
    border-radius: 8px;
    padding: 2rem;
    cursor: pointer;
    transition: border-color .15s;
}

.file-upload-area:hover {
    border-color: #e8b400;
}

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

.btn-cancelar:hover {
    border-color: #444;
    color: #e6edf3;
}
</style>

<script>
document.querySelector('[name="imagen"]').addEventListener('input', function () {
    let wrap = document.getElementById('img-preview-wrap');
    let preview = document.getElementById('img-preview');
    if (this.value.trim()) {
        preview.src = this.value;
        wrap.style.display = 'block';
        preview.onerror = function () { wrap.style.display = 'none'; };
    } else {
        wrap.style.display = 'none';
    }
});
</script>

@endsection