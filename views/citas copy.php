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
            <div id="calendar"></div>
        </div>
    </div>
</main>
</section>

<!-- FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        events: '/prodent-soporte/api/get_events.php', // aquí traemos los eventos de PHP
        eventColor: '#0d6efd',
        eventClick: function(info) {
            alert("Cita: " + info.event.title + "\nFecha: " + info.event.start.toLocaleString());
        }
    });

    calendar.render();
});
</script>
</section> 
<script src="/prodent-soporte/assets/js/apexcharts.js"></script>
<script src="/prodent-soporte/assets/js/script_dashboard.js"></script>
</body>
</html>