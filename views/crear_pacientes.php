<?php 
require_once '../config/config.php';


include "../includes/header.php";
?>

<main>
    <h1 class="title">Crear Pacientes</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Crear Pacientes</a></li>
    </ul>
    <div class="card">
            <div class="head">
                <h3><i class='bx bx-filter'></i> Filtros y Reportes</h3>
            </div>
            <form action="index.php" method="GET" class="filter-form">
              <div class="form-row">
                  <div class="form-group">
                      <label for="termino" class="form-label">Nombre/Empresa:</label>
                      <input type="text" id="termino" name="termino" placeholder="Ingrese nommbre o empresa" value="">
                  </div>
                  <div class="form-group">
                      <label for="cliente_nombre" class="form-label">Teléfono:</label>
                      <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Escribe teléfono:..." value="">
                  </div>
                  <div class="form-group">
                      <label for="cliente_nombre" class="form-label">Pais:</label>
                      <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Escriba el pais:..." value="">
                  </div>
              </div>

              <div class="form-actions">
                  <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i> Filtrar</button>
                  <button type="reset" class="btn btn-secondary"><i class='bx bx-eraser'></i> Limpiar</button>
                  <button type="button" class="btn btn-primary" id="btnAbrirModal"><i class="fa-solid fa-save"></i> Registrar</button>
              </div>
            </form>
        </div>
    </div>

    <!-- Contenedor de resultados -->
    <div class="card">
        <div class="card-header">
            <i class='bx bx-table'></i> Resultados
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Tabla de resultados -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Correo Electronico</th>
                            <th>Telefono</th>
                            <th>Pais</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ejemplo de filas (se llenarán dinámicamente con PHP o JS) -->
                        <tr>
                            <td>001</td>
                            <td>Consulta General</td>
                            <td>Juan Pérez</td>
                            <td>Dra. López</td>
                            <td>Alta</td>
                            <td>Confirmada</td>
                            <td>2025-09-20</td>
                            <td>Facturado</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Odontología</td>
                            <td>María Gómez</td>
                            <td>Dr. Torres</td>
                            <td>Media</td>
                            <td>Pendiente</td>
                            <td>2025-09-21</td>
                            <td>No facturado</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal Registrar Paciente -->
<div id="modalRegistrar" class="modal">
  <div class="modal-content">
    <span class="modal-close" id="btnCerrarModal">&times;</span>
    <h2><i class="fa-solid fa-user-plus"></i> Registrar Paciente</h2>
    <div class="form-container">
      <form action="../api/guardar_paciente.php" method="POST" enctype="multipart/form-data">
        
        <div class="form-row">
          <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="empresa">DNI</label>
            <input type="text" id="empresa" name="empresa" class="form-control">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class= "form-container" for="correo">Correo Electronico</label>
            <input type="email" id="correo" name="correo" class="form-control">
          </div>
          <div class="form-group">
            <label class= "form-container" for="correo">Empresa (Opcional)</label>
            <input type="email" id="correo" name="correo" class="form-control">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class= "form-container" for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control">
          </div>
          <div class="form-group">
            <label class= "form-container" for="whatsapp">WhatsApp</label>
            <input type="text" id="whatsapp" name="whatsapp" class="form-control">
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Guardar</button>
          <button type="button" class="btn btn-secondary" id="btnCerrarModal2"><i class="fa-solid fa-xmark"></i> Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section> 
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>