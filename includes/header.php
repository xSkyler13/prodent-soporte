<?php
session_start();

// Si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/prodent-soporte/assets/css/style_dashboard.css">
	<title>Prodent</title>
</head>
<body>
	
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><i class="fa-solid fa-tooth"></i> Prodent</a>
		<ul class="side-menu">
			<li><a href="index.php" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon'></i> Elements <i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="#">Alert</a></li>
					<li><a href="#">Badges</a></li>
					<li><a href="#">Breadcrumbs</a></li>
					<li><a href="#">Button</a></li>
				</ul>
			</li>
			<li><a href="#"><i class='bx bxs-chart icon'></i> Charts</a></li>
			<li><a href="#"><i class='bx bxs-widget icon'></i> Widgets</a></li>
			<li class="divider" data-text="table and forms">Table and forms</li>
			<li><a href="#"><i class='bx bx-table icon'></i> Tables</a></li>
			<li>
				<a href="#"><i class='bx bxs-notepad icon'></i> Forms <i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="#">Basic</a></li>
					<li><a href="#">Select</a></li>
					<li><a href="#">Checkbox</a></li>
					<li><a href="#">Radio</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<nav>
			<i class='bx bx-menu toggle-sidebar'></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon'></i>
				</div>
			</form>
			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon'></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon'></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="profile">
				<img src="<?php echo $_SESSION['foto'] ?? '/prodent-soporte/assets/img/default.png'; ?>" alt="">
				<ul class="profile-link">
					<li>
						<a href="#"><i class='bx bxs-user-circle icon'></i>
							<?php echo htmlspecialchars($_SESSION['nombre_completo']); ?>
						</a>
					</li>
					<li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li>
					<li><a href="/prodent-soporte/api/logout.php"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
				</ul>
			</div>
		</nav>
    <!-- /NAVBAR -->