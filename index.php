<?php 
require_once './config/config.php';


include "./includes/header.php";
?>

<!-- MAIN -->
		<main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<h2>1500</h2>
							<p>Traffic</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="40%"></span>
					<span class="label">40%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>24</h2>
							<p>Sales</p>
						</div>
						<i class='bx bx-trending-down icon down' ></i>
					</div>
					<span class="progress" data-value="30%"></span>
					<span class="label">30%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>465</h2>
							<p>Pageviews</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="30%"></span>
					<span class="label">30%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>235</h2>
							<p>Visitors</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="80%"></span>
					<span class="label">80%</span>
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Sales Report</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chart">
						<div id="chart"></div>
					</div>
				</div>
				<div class="content-data">
					<div class="head">
						<h3><i class='bx bx-filter'></i> Filtros y Reportes</h3>
					</div>
					<form action="index.php" method="GET" class="filter-form">
						<div class="form-row">
							<div class="form-group">
								<label for="termino" class="form-label">Asunto/ID:</label>
								<input type="text" id="termino" name="termino" placeholder="Ingrese asunto o ID" value="">
							</div>
							<div class="form-group">
								<label for="cliente_nombre" class="form-label">Paciente:</label>
								<input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="Escribe el nombre del Paciente..." value="">
								<!-- ID real del cliente (oculto) -->
                        		<input type="hidden" id="paciente" name="paciente" value="<?php echo htmlspecialchars($filtro_cliente); ?>">
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
								<label for="estado_cita">Estado Cita:</label>
								<select id="estado_cita" name="estado_cita">
									<option value="">Todos</option>
									<option value="pendiente">Pendiente</option>
									<option value="confirmada">Confirmada</option>
									<option value="cancelada">Cancelada</option>
									<option value="completada">Completada</option>
								</select>
							</div>
							<div class="form-group">
								<label for="fecha_inicio">Fecha Inicio:</label>
								<input type="date" id="fecha_inicio" name="fecha_inicio">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group">
								<label for="fecha_fin">Fecha Fin:</label>
								<input type="date" id="fecha_fin" name="fecha_fin">
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

						<div class="form-actions">
							<button type="submit" class="btn btn-primary"><i class='bx bx-search'></i> Filtrar</button>
							<button type="reset" class="btn btn-secondary"><i class='bx bx-eraser'></i> Limpiar</button>
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
										<th>Asunto</th>
										<th>Paciente</th>
										<th>Doctor(a)</th>
										<th>Prioridad</th>
										<th>Estado Cita</th>
										<th>Fecha</th>
										<th>Estado Facturación</th>
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
<!-- /MAIN -->
</section> 
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>
