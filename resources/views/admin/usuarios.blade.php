@extends('admin.layout')

@section('content')
<header>
    <h2>👥 Gestión de Usuarios</h2>
    <p>Administra los usuarios registrados y su estado dentro de la aplicación MiBienestarDigital.</p>
</header>

<div class="card">
    <h3>🌿 Lista de Usuarios</h3>

    @php
        $usuarios = [
            ['nombre' => 'Juan Pérez', 'correo' => 'juan@gmail.com', 'estado' => 'Activo', 'diasDesactivado' => 0],
            ['nombre' => 'María López', 'correo' => 'maria@gmail.com', 'estado' => 'Desactivado', 'diasDesactivado' => 12],
            ['nombre' => 'Carlos Ruiz', 'correo' => 'carlos@gmail.com', 'estado' => 'Activo', 'diasDesactivado' => 0],
            ['nombre' => 'Ana Torres', 'correo' => 'ana@gmail.com', 'estado' => 'Desactivado', 'diasDesactivado' => 5],
            ['nombre' => 'Laura Gómez', 'correo' => 'laura@gmail.com', 'estado' => 'Activo', 'diasDesactivado' => 0],
            ['nombre' => 'Pedro Salinas', 'correo' => 'pedro@gmail.com', 'estado' => 'Desactivado', 'diasDesactivado' => 50],
        ];
    @endphp

    <div class="tabla-container">
        <table id="tablaUsuarios">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr class="{{ $u['estado'] === 'Desactivado' ? 'inactivo' : '' }}">
                    <td><strong>{{ $u['nombre'] }}</strong></td>
                    <td>{{ $u['correo'] }}</td>
                    <td class="estado">
                        @if($u['estado'] === 'Activo')
                            <span class="activo">🟢 Activo</span>
                        @else
                            <span class="desactivo">
                                🔴 Desactivado <br>
                                <small>Hace {{ $u['diasDesactivado'] }} días</small>
                                @if($u['diasDesactivado'] >= 30)
                                    <br><small class="alerta">⚠️ Inactivo por largo tiempo</small>
                                @endif
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="acciones">
                            <button class="btn edit" onclick="abrirEdicion(this)">✏️ Editar</button>
                            @if($u['estado'] === 'Activo')
                                <button class="btn deactivate" onclick="mostrarConfirmacion(this)">🚫 Desactivar</button>
                            @else
                                <button class="btn activate" onclick="activarUsuario(this)">✅ Activar</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Confirmación -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <h3>⚠️ Confirmar Acción</h3>
        <p id="confirmText">¿Deseas desactivar a este usuario?</p>
        <div class="modal-actions">
            <button class="btn cancel" onclick="cerrarModal()">Cancelar</button>
            <button class="btn confirm" onclick="desactivarUsuario()">Desactivar</button>
        </div>
    </div>
</div>

<!-- Modal Edición -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>✏️ Editar Usuario</h3>
        <form id="editForm">
            <input type="text" id="editNombre" placeholder="Nombre completo" required><br>
            <input type="email" id="editCorreo" placeholder="Correo electrónico" required><br>
            <select id="editEstado">
                <option value="Activo">Activo</option>
                <option value="Desactivado">Desactivado</option>
            </select>
        </form>
        <div class="modal-actions">
            <button class="btn cancel" onclick="cerrarEditModal()">Cancelar</button>
            <button class="btn confirm" onclick="guardarEdicion()">Guardar Cambios</button>
        </div>
    </div>
</div>

<style>
    h3 {
        color: #00BCD4;
        margin-bottom: 20px;
    }

    .tabla-container {
        margin-top: 10px;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    thead th {
        background: linear-gradient(90deg, #4CAF50, #00BCD4);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px 8px 0 0;
        text-align: center;
    }

    tbody tr {
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-radius: 12px;
    }

    tbody tr td {
        padding: 18px;
        text-align: center;
        vertical-align: middle;
    }

    tbody tr.inactivo {
        background-color: #f7f7f7;
        opacity: 0.8;
    }

    .activo {
        color: #4CAF50;
        font-weight: bold;
    }

    .desactivo {
        color: #E53935;
        font-weight: bold;
    }

    .alerta {
        color: #FF9800;
    }

    .acciones {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .btn {
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn.edit {
        background: #00BCD4;
    }

    .btn.deactivate {
        background: #E53935;
    }

    .btn.activate {
        background: #4CAF50;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    /* --- Modal --- */
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .modal-content {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        width: 350px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .modal-content h3 {
        color: #00BCD4;
        margin-bottom: 10px;
    }

    .modal-content p {
        color: #555;
        margin-bottom: 20px;
    }

    .modal-actions {
        display: flex;
        justify-content: space-around;
    }

    .btn.cancel {
        background: #9E9E9E;
    }

    .btn.confirm {
        background: #4CAF50;
    }

    input, select {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 10px;
    }

    form {
        margin-bottom: 10px;
    }
</style>

<script>
    let filaSeleccionada = null;
    let filaEditada = null;

    // Mostrar modal de confirmación
    function mostrarConfirmacion(boton) {
        filaSeleccionada = boton.closest('tr');
        const nombre = filaSeleccionada.cells[0].textContent;
        document.getElementById('confirmText').textContent = `¿Deseas desactivar a ${nombre}?`;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function cerrarModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    function desactivarUsuario() {
        if (filaSeleccionada) {
            const estado = filaSeleccionada.querySelector('.estado');
            estado.innerHTML = `<span class="desactivo">🔴 Desactivado<br><small>Hace 1 día</small></span>`;
            filaSeleccionada.classList.add('inactivo');
            filaSeleccionada.querySelector('.deactivate').outerHTML = `<button class="btn activate" onclick="activarUsuario(this)">✅ Activar</button>`;
        }
        cerrarModal();
    }

    function activarUsuario(boton) {
        const fila = boton.closest('tr');
        const estado = fila.querySelector('.estado');
        estado.innerHTML = `<span class="activo">🟢 Activo</span>`;
        fila.classList.remove('inactivo');
        boton.outerHTML = `<button class="btn deactivate" onclick="mostrarConfirmacion(this)">🚫 Desactivar</button>`;
    }

    function abrirEdicion(boton) {
        filaEditada = boton.closest('tr');
        document.getElementById('editNombre').value = filaEditada.cells[0].textContent.trim();
        document.getElementById('editCorreo').value = filaEditada.cells[1].textContent.trim();
        document.getElementById('editEstado').value = filaEditada.querySelector('.estado').textContent.includes('Activo') ? 'Activo' : 'Desactivado';
        document.getElementById('editModal').style.display = 'flex';
    }

    function cerrarEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function guardarEdicion() {
        const nuevoNombre = document.getElementById('editNombre').value;
        const nuevoCorreo = document.getElementById('editCorreo').value;
        const nuevoEstado = document.getElementById('editEstado').value;

        filaEditada.cells[0].textContent = nuevoNombre;
        filaEditada.cells[1].textContent = nuevoCorreo;

        if (nuevoEstado === 'Activo') {
            filaEditada.querySelector('.estado').innerHTML = `<span class="activo">🟢 Activo</span>`;
            filaEditada.classList.remove('inactivo');
            const boton = filaEditada.querySelector('.activate');
            if (boton) boton.outerHTML = `<button class="btn deactivate" onclick="mostrarConfirmacion(this)">🚫 Desactivar</button>`;
        } else {
            filaEditada.querySelector('.estado').innerHTML = `<span class="desactivo">🔴 Desactivado<br><small>Hace 1 día</small></span>`;
            filaEditada.classList.add('inactivo');
            const boton = filaEditada.querySelector('.deactivate');
            if (boton) boton.outerHTML = `<button class="btn activate" onclick="activarUsuario(this)">✅ Activar</button>`;
        }

        cerrarEditModal();
        alert(`✅ Datos de "${nuevoNombre}" actualizados correctamente.`);
    }
</script>
@endsection

