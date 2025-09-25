<?php 
require_once '../config/config.php';
include "../includes/header.php";
$stmt = $pdo->query("
    SELECT  u.id_usuario, 
            u.nombre_completo,
            u.email, 
            u.activo, 
            u.telefono, 
            u.ruta_foto, 
            r.nombre_rol
    FROM usuarios u 
    JOIN roles 
    r ON 
    u.id_rol = r.id_rol 
    ORDER BY u.nombre_completo
");
$usuarios = $stmt->fetchAll();
?>

<main>
    <h1 class="title">Gestion de Usuarios</h1>
    <ul class="breadcrumbs">
        <li><a>Home</a></li>
        <li class="divider">/</li>
        <li><a class="active">Gestion de usuarios</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
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
                                    <th>Nombre Completo</th>
                                    <th>Correo Electronico</th>
                                    <th>Telefono</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['nombre_completo']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombre_rol']); ?></td>
                                    <td>
                                        <?php if ($usuario['activo']): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn btn-sm btn-primary btnEditar" 
                                                    data-id="<?php echo $usuario['id_usuario']; ?>">
                                                <i class="bx bxs-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger btn-delete" 
                                                    data-id="<?php echo $usuario['id_usuario']; ?>">
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
            <div class="form-actions">
                <!-- <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i> Filtrar</button> -->
                <button type="button" class="btn btn-primary" id="btnAbrirModal"><i class="fa-solid fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</main>
<!-- Modal Editar usuario -->
<div id="modalEditar" class="modal">
  <div class="modal-content">
    <span id="btnCerrarEditar" class="modal-close">&times;</span>
    <h2>Editar Usuario</h2>
    <form id="formEditarUsuario">
      <input type="hidden" id="edit_id" name="id_usuario">

      <div class="form-group">
        <label for="edit_nombre">Nombre Completo:</label>
        <input type="text" id="edit_nombre" name="nombre_completo">
      </div>

      <div class="form-group">
        <label for="edit_email">Correo Electrónico:</label>
        <input type="email" id="edit_email" name="email">
      </div>

      <div class="form-group">
        <label for="edit_telefono">Teléfono:</label>
        <input type="text" id="edit_telefono" name="telefono">
      </div>

      <div class="form-group">
        <label for="edit_rol">Rol:</label>
        <select id="edit_rol" name="id_rol">
            <option value="1">Administrador</option>
            <option value="2">Agente de Soporte</option>
            <option value="3">Supervisor</option>
        </select>
      </div>

      <div class="form-group">
        <label for="edit_estado">Estado:</label>
        <select id="edit_estado" name="activo">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>

      <div class="form-actions">
        <button type="button" id="btnCancelar" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Registrar usuario -->
<div id="modalRegistrar" class="modal">
    <div class="modal-content">
        <span class="modal-close" id="btnCerrarModal">&times;</span>
        <div class="heads">
            <h2><i class="fa-solid fa-user-plus"></i> Registrar Usuario</h2>
        </div>
        <form action="../api/registrar_usuario.php" method="POST" enctype="multipart/form-data" class="filter-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class= "form-container" for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class= "form-container" for="correo">Correo Electronico</label>
                <input type="email" id="correo" name="correo" class="form-control" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class= "form-container" for="correo">Contraseña</label>
                    <input type="text" id="pass" name="pass" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="doctor">Rol</label>
                    <select id="id_rol1" name="id_rol1">
                        <option value="1">Administrador</option>
                        <option value="2">Soporte</option>
                        <option value="3">Supervisor</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="btnCerrarModal2"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>
</section>
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>