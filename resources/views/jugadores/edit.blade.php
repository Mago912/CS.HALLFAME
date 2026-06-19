@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('jugadores.index') }}" class="btn-card-icon">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="text-white mb-0" style="font-size:1.6rem; font-weight:700;">
            Editar jugador
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

        <form action="{{ route('jugadores.update', $jugador->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nickname</label>
                <input type="text"
                       name="nickname"
                       class="form-input"
                       value="{{ old('nickname', $jugador->nickname) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">País</label>
                <input type="text"
                       name="pais"
                       class="form-input"
                       value="{{ old('pais', $jugador->pais) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Equipo</label>
                <select name="equipo_id" class="form-input">
                    <option value="">— Sin equipo —</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}"
                            {{ old('equipo_id', $jugador->equipo_id) == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">MVPs</label>
                    <input type="number"
                           name="mvps"
                           class="form-input"
                           value="{{ old('mvps', $jugador->mvps) }}"
                           min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Majors</label>
                    <input type="number"
                           name="majors"
                           class="form-input"
                           value="{{ old('majors', $jugador->majors) }}"
                           min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion"
                          class="form-input"
                          rows="3">{{ old('descripcion', $jugador->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Imagen</label>

                @if ($jugador->imagen)
                <div class="current-image-box">
                    <img src="{{ $jugador->imagen }}"
                         alt="{{ $jugador->nickname }}"
                         id="img-preview"
                         class="current-image">
                    <label class="clear-image-label">
                        <input type="checkbox"
                               name="clear_image"
                               value="1"
                               id="clear-image-check">
                        Quitar imagen actual
                    </label>
                </div>
                @endif

                <label class="file-upload-area" id="file-label">
                    <i class="bi bi-image" style="font-size:2rem; color:#7d8590;"></i>
                    <span id="file-text" style="color:#7d8590; font-size:14px; margin-top:6px;">
                        {{ $jugador->imagen ? 'Cambiar imagen (subir archivo)' : 'Hacé click para seleccionar una imagen' }}
                    </span>
                    <span style="color:#555; font-size:12px;">JPG, PNG — máx. 2MB</span>
                    <input type="file"
                           name="imagen"
                           id="imagen-input"
                           accept="image/*"
                           style="display:none">
                </label>

                <div class="or-divider">o pegá una URL</div>

                <input type="text"
                       name="imagen_url"
                       class="form-input"
                       value="{{ old('imagen_url') }}"
                       placeholder="https://ejemplo.com/imagen.jpg">
            </div>

            <div class="form-actions">
                <a href="{{ route('jugadores.index') }}" class="btn-cancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn-guardar">
                    <i class="bi bi-check-lg"></i> Guardar cambios
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
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.form-label {
    display: block;
    font-size: 12px;
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
textarea.form-input { resize: vertical; min-height: 90px; }
.current-image-box {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 12px;
    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 8px;
    padding: 10px 14px;
}
.current-image {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #21262d;
}
.clear-image-label {
    font-size: 13px;
    color: #7d8590;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}
.clear-image-label input[type="checkbox"] {
    accent-color: #f85149;
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
    padding: 1.5rem;
    cursor: pointer;
    transition: border-color .15s;
}
.file-upload-area:hover { border-color: #e8b400; }
.or-divider {
    text-align: center;
    color: #555;
    font-size: 12px;
    margin: 12px 0;
    position: relative;
}
.or-divider::before,
.or-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #21262d;
}
.or-divider::before { left: 0; }
.or-divider::after { right: 0; }
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

<script>
document.getElementById('imagen-input').addEventListener('change', function () {
    const name = this.files[0]?.name ?? 'Cambiar imagen (subir archivo)';
    document.getElementById('file-text').textContent = name;
    document.getElementById('clear-image-check').checked = false;
    let preview = document.getElementById('img-preview');
    if (preview && this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
    }
});
document.getElementById('clear-image-check')?.addEventListener('change', function () {
    if (this.checked) {
        document.getElementById('imagen-input').value = '';
        document.getElementById('file-text').textContent = 'Hacé click para seleccionar una imagen';
    }
});
</script>

@endsection