// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');
allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();
		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}
		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})

const links = document.querySelectorAll('.side-menu a');
links.forEach(link => {
    link.addEventListener('click', function() {
        links.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});


// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');
if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

toggleSidebar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
	if(sidebar.classList.contains('hide')) {
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})

sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})

sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})



// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');
imgProfile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
})


// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');
allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');
	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})



window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}
	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');
		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})


document.addEventListener("DOMContentLoaded", () => {
  const ANIM_MS = 300; // debe coincidir con la duración CSS de la transición
  // Utilidades para abrir / cerrar usando clases .show / .hide
  function openModal(modal) {
    if (!modal) return;
    modal.classList.remove('hide');
    modal.style.display = 'flex';          // hace visible el contenedor
    void modal.offsetWidth;                // force reflow para que la transición funcione
    modal.classList.add('show');           // activa la transición de entrada
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove('show');
    modal.classList.add('hide');           // activa la transición de salida (hacia arriba)
    setTimeout(() => {
      modal.style.display = 'none';        // ocultar después de la animación
      modal.classList.remove('hide');      // limpiar clase
    }, ANIM_MS + 20);
  }

  /* --------------------- Modal Registrar --------------------- */
  const modalRegistrar = document.getElementById('modalRegistrar');
  const btnAbrirModal = document.getElementById('btnAbrirModal');
  const btnCerrarRegistrarA = document.getElementById('btnCerrarRegistrar');
  const btnCerrarRegistrarB = document.getElementById('btnCerrarModal');
  const btnCerrarRegistrar2 = document.getElementById('btnCerrarModal2');

  if (btnAbrirModal) {
    btnAbrirModal.addEventListener('click', () => openModal(modalRegistrar));
  }
  [btnCerrarRegistrarA, btnCerrarRegistrarB, btnCerrarRegistrar2].forEach(b => {
    if (b) b.addEventListener('click', () => closeModal(modalRegistrar));
  });
  // click fuera para cerrar
  window.addEventListener('click', (e) => {
    if (e.target === modalRegistrar) closeModal(modalRegistrar);
  });

  /* --------------------- Modal Editar --------------------- */
  const modalEditar = document.getElementById('modalEditar');
  const btnCerrarEditar = document.getElementById('btnCerrarEditar') || document.getElementById('btnCerrarModal'); // fallback
  const btnCancelar = document.getElementById('btnCancelar');
  const formEditar = document.getElementById('formEditarUsuario');

  // abrir modal editar al hacer click en botones .btnEditar (tabla)
  document.querySelectorAll('.btnEditar').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id) return console.warn('btnEditar sin data-id');

      try {
        const res = await fetch('/prodent-soporte/api/obtener_usuarios.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id)
        });

        if (!res.ok) throw new Error('Error en la petición: ' + res.status);
        const data = await res.json();

        // Rellenar campos (comprueba que existan)
        const setIf = (selId, val) => {
          const el = document.getElementById(selId);
          if (el) el.value = (val ?? '');
        };

        setIf('edit_id', data.id_usuario ?? '');
        setIf('edit_nombre', data.nombre_completo ?? '');
        setIf('edit_email', data.email ?? '');
        setIf('edit_telefono', data.telefono ?? '');
        setIf('edit_rol', data.id_rol ?? '');
        setIf('edit_estado', data.activo ?? '');

        openModal(modalEditar);
      } catch (err) {
        console.error(err);
        alert('Error al cargar datos del usuario. Revisa la consola.');
      }
    });
  });

  // cerrar modal editar
  [btnCerrarEditar, btnCancelar].forEach(b => {
    if (b) b.addEventListener('click', () => closeModal(modalEditar));
  });
  window.addEventListener('click', (e) => {
    if (e.target === modalEditar) closeModal(modalEditar);
  });

  // submit del formulario de edición (AJAX)
  if (formEditar) {
    formEditar.addEventListener('submit', async (e) => {
      e.preventDefault();
      const fd = new FormData(formEditar);
      try {
        const res = await fetch('/prodent-soporte/api/editar_usuario.php', {
          method: 'POST',
          body: fd
        });
        const json = await res.json();
        if (json.success) {
          closeModal(modalEditar);
          location.reload();
        } else {
          alert(json.message || 'Error al actualizar usuario');
        }
      } catch (err) {
        console.error(err);
        alert('Error al guardar. Revisa la consola.');
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if(confirm('¿Seguro que deseas eliminar este usuario?')) {
                var id = this.getAttribute('data-id');
                fetch('/prodent-soporte/api/eliminar_usuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_usuario=' + encodeURIComponent(id)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Usuario eliminado correctamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar usuario: ' + (data.error || 'Error desconocido'));
                    }
                })
                .catch(() => alert('Error de conexión'));
            }
        });
    });
});

// PROGRESSBAR
const allProgress = document.querySelectorAll('main .card .progress');
allProgress.forEach(item=> {
	item.style.setProperty('--value', item.dataset.value)
})

// APEXCHART
var options = {
  series: [{
  name: 'series1',
  data: [31, 40, 28, 51, 42, 109, 100]
}, {
  name: 'series2',
  data: [11, 32, 45, 32, 34, 52, 41]
}],
  chart: {
  height: 350,
  type: 'area'
},
dataLabels: {
  enabled: false
},
stroke: {
  curve: 'smooth'
},
xaxis: {
  type: 'datetime',
  categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
},
tooltip: {
  x: {
    format: 'dd/MM/yy HH:mm'
  },
},
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();