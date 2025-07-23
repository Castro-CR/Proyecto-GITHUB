function inicializarPaginaCRUD(config) {

    const manejarEstadoDeExito = () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: "¡Acción completada!",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    };

    // Obtenemos los elementos usando los IDs genéricos
    const form = document.getElementById(config.formId);
    const btnAgregar = document.getElementById('btn-agregar');
    const btnEliminar = document.getElementById('btn-eliminar');
    const btnCancelar = document.getElementById('btn-cancelar');
    const filaAgregar = document.getElementById('fila-agregar');
    const divControles = document.getElementById('controles-confirmacion');
    const btnGuardarNuevo = document.getElementById('btn-guardar-nuevo');
    const btnConfirmarEliminacion = document.getElementById('btn-confirmar-eliminacion');
    
    let accionActual = null;

    // La lógica de los botones
    if (btnAgregar) {
        btnAgregar.addEventListener('click', () => {
            accionActual = 'agregar';
            if(filaAgregar) filaAgregar.style.display = 'table-row';
            if(divControles) divControles.style.display = 'block';
            if(btnGuardarNuevo) btnGuardarNuevo.style.display = 'inline-block';
            if(btnConfirmarEliminacion) btnConfirmarEliminacion.style.display = 'none';
            if(btnCancelar) btnCancelar.style.display = 'inline-block';
        });
    }

    if (btnEliminar) {
        btnEliminar.addEventListener('click', () => {
            accionActual = 'eliminar';
            document.querySelectorAll('.checkbox-eliminar').forEach(el => {
                el.style.display = 'table-cell';
            });
            if(divControles) divControles.style.display = 'block';
            if(btnConfirmarEliminacion) btnConfirmarEliminacion.style.display = 'inline-block';
            if(btnGuardarNuevo) btnGuardarNuevo.style.display = 'none';
            if(btnCancelar) btnCancelar.style.display = 'inline-block';
        });
    }

    if (btnCancelar) {
        btnCancelar.addEventListener('click', () => {
            window.location.reload();
        });
    }

    // El envío del formulario
    if (form) {
        form.addEventListener('submit', function(event) {
            if (accionActual === 'eliminar') {
                event.preventDefault();

                const checkboxesSeleccionados = document.querySelectorAll('input[name="eliminar_ids[]"]:checked').length;
                if (checkboxesSeleccionados === 0) {
                    Swal.fire('Error', `Debes seleccionar al menos un ${config.nombreEntidad} para eliminar.`, 'error');
                    return;
                }

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'confirmar_eliminacion';
                        hiddenInput.value = '1';
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            }
        });
    }
    
    manejarEstadoDeExito();
}


document.addEventListener('DOMContentLoaded', function() {
    const checkboxOtro = document.getElementById('interes_otro');
    const textoOtro = document.getElementById('otro_interes_texto');
    if (checkboxOtro && textoOtro) {
        checkboxOtro.addEventListener('change', function() {
            if (this.checked) {
                textoOtro.style.display = 'inline-block';
                textoOtro.focus();
            } else {
                textoOtro.style.display = 'none';
                textoOtro.value = '';
            }
        });
    }
});