<?php 
require_once '../config/config.php';
include "../includes/header.php";
$stmt = $pdo->query( "SELECT id_cliente, nombre, empresa, correo_electronico, telefono, pais, ciudad, activo 
        FROM pacientes");
$pacientes = $stmt->fetchAll();
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
                      <input type="text" id="termino" name="termino" placeholder="Ingrese nombre o empresa" value="">
                  </div>
                  <div class="form-group">
                      <label for="cliente_nombre" class="form-label">Teléfono:</label>
                      <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Escribe teléfono" value="">
                  </div>
                  <div class="form-group">
                      <label for="cliente_nombre" class="form-label">Pais:</label>
                      <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Escriba el pais" value="">
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
                        <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($paciente['id_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['empresa']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['correo_electronico']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['pais']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['ciudad']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['activo']); ?></td>
                            <td>
                              <div class="actions">
                                  <button class="btn btn-sm btn-primary btnEdit" 
                                          data-id="<?php echo $paciente['id_cliente']; ?>">
                                      <i class="bx bxs-pencil"></i>
                                  </button>
                                  <button class="btn btn-danger btn-delet" 
                                          data-id="<?php echo $paciente['id_cliente']; ?>">
                                      <i class="bx bxs-trash-alt"></i>
                                  </button>
                              </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal Editar Paciente -->
<div id="modalEditarPaciente" class="modal">
  <div class="modal-content">
    <span class="modal-close" id="btnCerrarEditarPaciente">&times;</span>
    <h2><i class="fa-solid fa-user-edit"></i> Editar Paciente</h2>
    <div class="form-container">
      <form id="formEditarPaciente">
        <input type="hidden" id="edit_id_cliente" name="id_cliente">
        <div class="form-row">
          <div class="form-group">
            <label for="edit_nombre">Nombre Completo</label>
            <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="edit_empresa">DNI</label>
            <input type="text" id="edit_empresa" name="empresa" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="edit_correo">Correo Electronico</label>
            <input type="email" id="edit_correo" name="correo_electronico" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_ciudad">Ciudad</label>
            <input type="text" id="edit_ciudad" name="ciudad" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="edit_telefono">Teléfono</label>
            <input type="text" id="edit_telefono" name="telefono" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_pais">Pais</label>
            <input type="text" id="edit_pais" name="pais" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="edit_activo">Estado</label>
            <select id="edit_activo" name="activo" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" id="btnCerrarEditarPaciente2"><i class="fa-solid fa-xmark"></i> Cerrar</button>
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Abrir modal y cargar datos
  document.querySelectorAll('.btnEdit').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      fetch('../api/obtener_paciente.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_cliente=' + encodeURIComponent(id)
      })
      .then(res => res.json())
      .then(data => {
        if(data.success) {
          document.getElementById('edit_id_cliente').value = data.paciente.id_cliente;
          document.getElementById('edit_nombre').value = data.paciente.nombre;
          document.getElementById('edit_empresa').value = data.paciente.empresa;
          document.getElementById('edit_correo').value = data.paciente.correo_electronico;
          document.getElementById('edit_ciudad').value = data.paciente.ciudad;
          document.getElementById('edit_telefono').value = data.paciente.telefono;
          document.getElementById('edit_pais').value = data.paciente.pais;
          document.getElementById('edit_activo').value = data.paciente.activo;
          document.getElementById('modalEditarPaciente').classList.add('show');
          document.getElementById('modalEditarPaciente').style.display = 'flex';
        } else {
          alert('No se pudo cargar el paciente');
        }
      });
    });
  });

  // Cerrar modal
  document.getElementById('btnCerrarEditarPaciente').onclick = function() {
    document.getElementById('modalEditarPaciente').classList.remove('show');
    document.getElementById('modalEditarPaciente').style.display = 'none';
  };
  document.getElementById('btnCerrarEditarPaciente2').onclick = function() {
    document.getElementById('modalEditarPaciente').classList.remove('show');
    document.getElementById('modalEditarPaciente').style.display = 'none';
  };

  // Guardar cambios
  document.getElementById('formEditarPaciente').onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('../api/editar_paciente.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if(data.success) {
        alert('Paciente actualizado correctamente');
        document.getElementById('modalEditarPaciente').classList.remove('show');
        document.getElementById('modalEditarPaciente').style.display = 'none';
        location.reload();
      } else {
        alert('Error al actualizar paciente');
      }
    });
  };
});
</script>
</body>
</html>