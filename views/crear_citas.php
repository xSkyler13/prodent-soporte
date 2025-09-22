<?php 
require_once '../config/config.php';


include "../includes/header.php";
?>

<main>
    <h1 class="title">Crear Cita</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Crear Cita</a></li>
    </ul>
    <div class="card">
        <div class="head">
            <h3><i class='bx bxs-notepad'></i> Datos de la Cita</h3>
        </div>
        <form action="index.php" method="GET" class="filter-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="termino" class="form-label">Paciente:</label>
                    <input type="text" id="termino" name="termino" placeholder="Ingrese nombre del Paciente..." value="">
                </div>
                <div class="form-group">
                    <label for="cliente_nombre" class="form-label">Monto:</label>
                    <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Ingrese el monto..." value="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="doctor">Doctor(a):</label>
                    <select id="doctor" name="doctor">
                        <option value="">Todos</option>
                        <option value="dr1">Dr. Juan Pérez</option>
                        <option value="dr2">Dra. María López</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prioridad">Prioridad:</label>
                    <select id="prioridad" name="prioridad">
                        <option value="">Todas</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio">
                </div>
                <div class="form-group">
                    <label for="estado_facturacion">Estado Facturación:</label>
                    <select id="estado_facturacion" name="estado_facturacion">
                        <option value="">Todos</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="pagado">Pagado</option>
                        <option value="anulado">Anulado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="detalle">Descripción:</label>
                <textarea id="detalle" name="detalle" rows="4" placeholder="Ingrese la descripción de la cita..."></textarea>
            </div>
            <div class="form-group">
                <label for="archivo">Adjuntar Archivos (Opcional)</label>
                <input type="file" id="archivo" class="custom-file-input" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.jpg,.jpeg,.png">
                <small class="form-text">Puedes seleccionar varios archivos a la vez.</small>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Registrar</button>
                <button type="reset" class="btn btn-secondary"><i class='bx bx-eraser'></i> Limpiar</button>
            </div>
        </form>
    </div>


</main>
</section> 
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>