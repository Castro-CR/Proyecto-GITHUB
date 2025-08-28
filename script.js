function inicializarPaginaCRUD(config) {

    const manejarEstadoDeExito = () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: "¡Acción completada!", icon: "success", timer: 2000, showConfirmButton: false
            }).then(() => {
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    };

    // --- Definición de todos los elementos
    const form = document.getElementById(config.formId);
    const btnAgregar = document.getElementById('btn-agregar');
    const btnEditar = document.getElementById('btn-editar');
    const btnEliminar = document.getElementById('btn-eliminar');
    const btnCancelar = document.getElementById('btn-cancelar');
    const filaAgregar = document.getElementById('fila-agregar');
    const filaEditar = document.getElementById('fila-editar');
    const divControles = document.getElementById('controles-confirmacion');
    const btnGuardarNuevo = document.getElementById('btn-guardar-nuevo');
    const btnConfirmarEliminacion = document.getElementById('btn-confirmar-eliminacion');
    const btnConfirmarEdicion = document.getElementById('btn-confirmar-edicion');
    
    let accionActual = null;

    // --- Lógica para el botón AGREGAR
    if (btnAgregar) {
        btnAgregar.addEventListener('click', () => {
            accionActual = 'agregar';
            if(filaAgregar) filaAgregar.style.display = 'table-row';
            if(divControles) divControles.style.display = 'block';
            if(btnGuardarNuevo) btnGuardarNuevo.style.display = 'inline-block';
            if(btnConfirmarEliminacion) btnConfirmarEliminacion.style.display = 'none';
            if(btnCancelar) btnCancelar.style.display = 'inline-block';
            
            
            if(btnAgregar) btnAgregar.style.display = 'none';
            if(btnEditar) btnEditar.style.display = 'none';
            if(btnEliminar) btnEliminar.style.display = 'none';
        });
    }

    // --- Lógica para el botón ELIMINAR
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

            // Oculta los botones de acción principal
            if(btnAgregar) btnAgregar.style.display = 'none';
            if(btnEditar) btnEditar.style.display = 'none';
            if(btnEliminar) btnEliminar.style.display = 'none';
        });
    }

    // --- Lógica para el botón EDITAR
    if (btnEditar) {
        btnEditar.addEventListener('click', () => {
            accionActual = 'editar';
            document.querySelectorAll('.checkbox-eliminar').forEach(el => {
                el.style.display = 'table-cell';
            });
            if(btnAgregar) btnAgregar.style.display = 'none';
            if(btnEditar) btnEditar.style.display = 'none';
            if(btnEliminar) btnEliminar.style.display = 'none';

            if(divControles) divControles.style.display = 'block';
            if(btnConfirmarEdicion) btnConfirmarEdicion.style.display = 'inline-block';
            if(btnCancelar) btnCancelar.style.display = 'inline-block';
        });
    }
    
    // --- Lógica para el botón CONFIRMAR EDICIÓN
    if (btnConfirmarEdicion) {
        let listoParaGuardar = false;

        btnConfirmarEdicion.addEventListener('click', (event) => {
            if (listoParaGuardar) {
                return; // Permite el envío del formulario
            }
            event.preventDefault();

            const seleccionado = document.querySelectorAll('input[name="eliminar_ids[]"]:checked');
            if (seleccionado.length !== 1) {
                Swal.fire('Atención', `Debes seleccionar exactamente un ${config.nombreEntidad} para editar.`, 'warning');
                return;
            }

            if (filaEditar) filaEditar.style.display = 'none';
            const fila = seleccionado[0].closest('tr');
            const celdas = fila.querySelectorAll('td[data-columna]');
            const id = seleccionado[0].value;

            document.getElementById('editar_id').value = id;
            celdas.forEach(celda => {
                const columna = celda.dataset.columna;
                const valor = celda.innerText;
                const inputOculto = document.getElementById('editar_' + columna);
                if (inputOculto) {
                    inputOculto.value = valor;
                }
            });

            celdas.forEach(celda => {
                const columna = celda.dataset.columna;
                const valor = celda.innerText;
                const inputOculto = document.getElementById('editar_' + columna);
                const tipoInput = inputOculto ? inputOculto.type : 'text';
                celda.innerHTML = `<input type="${tipoInput}" value="${valor}" oninput="document.getElementById('editar_${columna}').value = this.value">`;
            });
            
            seleccionado[0].disabled = true;
            btnConfirmarEdicion.innerText = 'Guardar Cambios';
            listoParaGuardar = true;
        });
    }

    // --- Lógica para el botón CANCELAR
    if (btnCancelar) {
        btnCancelar.addEventListener('click', () => {
            window.location.reload();
        });
    }

    // --- Lógica para el envío del formulario 
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
                    title: '¿Estás seguro?', text: "¡No podrás revertir esta acción!", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar'
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

    // --- Lógica para el FILTRO DE BÚSQUEDA ---
    const filtroInput = document.getElementById('filtro-busqueda');
    if (filtroInput) {
        filtroInput.addEventListener('keyup', () => {
            const terminoBusqueda = filtroInput.value.toLowerCase();
            const filasParaFiltrar = document.querySelectorAll(config.selectorFila);

            filasParaFiltrar.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                if (textoFila.includes(terminoBusqueda)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }
}

// Lógica específica para la página de registro
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