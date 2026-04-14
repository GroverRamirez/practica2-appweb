import './bootstrap';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';

import Alpine from 'alpinejs';

window.bootstrap = bootstrap;
window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener('submit', (event) => {
    const form = event.target;

    if (!(form instanceof HTMLFormElement) || !form.classList.contains('js-confirm-delete')) {
        return;
    }

    if (form.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    Swal.fire({
        title: form.dataset.confirmTitle || 'Confirmar eliminacion',
        text: form.dataset.confirmText || 'Esta accion no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#c2410c',
        cancelButtonColor: '#334155',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.dataset.confirmed = 'true';
            form.submit();
        }
    });
});
