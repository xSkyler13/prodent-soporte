<?php 
require_once '../config/config.php';


include "../includes/header.php";
?>

<main>
    <h1 class="title">Calendario de Citas</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Calendario</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            <!-- Contenedor del calendario -->
            <div id="calendar"></div>
        </div>
    </div>
</main>
<!-- FullCalendar JS -->
<script src="../assets/js/index.global.min.js"></script>
<script src="../assets/js/es.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // vista inicial tipo Google Calendar
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        locale: 'es', // idioma español
        navLinks: true, // permite clickear días o semanas
        selectable: true,
        editable: true,
        events: 'cargar_eventos.php', // aquí irán tus citas desde la BD
    });

    calendar.render();
});
</script>
</section> 
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>