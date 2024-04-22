let nuevoModal = document.getElementById('nuevoModal');
let editaModal = document.getElementById('editaModal');
let eliminaModal = document.getElementById('eliminaModal');

nuevoModal.addEventListener('shown.bs.modal', event => {
    nuevoModal.querySelector('.modal-body #folio').focus();
});

nuevoModal.addEventListener('hide.bs.modal', event => {
    nuevoModal.querySelector('.modal-body #folio').value = "";
    nuevoModal.querySelector('.modal-body #estado').value = "";
    nuevoModal.querySelector('.modal-body #ingresoFecha').value = "";
    nuevoModal.querySelector('.modal-body #modulos').value = "";
    nuevoModal.querySelector('.modal-body #cliente').value = "";
    nuevoModal.querySelector('.modal-body #fallaCliente').value = "";
});

editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-bs-id');

    let inputId = editaModal.querySelector('.modal-body #id');
    let inputFolio = editaModal.querySelector('.modal-body #folio');
    let inputEstado = editaModal.querySelector('.modal-body #estado');
    let inputIngreso = editaModal.querySelector('.modal-body #ingresoFecha');
    let inputModulos = editaModal.querySelector('.modal-body #modulos');
    let inputCliente = editaModal.querySelector('.modal-body #cliente');
    let inputFalla = editaModal.querySelector('.modal-body #fallaCliente');

    let url = "getEntradas.php";
    let formData = new FormData();
    formData.append('id', id);

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        inputId.value = data.id;
        inputFolio.value = data.folio;
        inputEstado.value = data.estado;
        inputIngreso.value = data.ingresoFecha;
        // Buscar el módulo correspondiente en la lista de módulos y seleccionarlo
        let options = inputModulos.querySelectorAll('option');
        for (let option of options) {
            if (option.value == data.id_modulo) {
                option.selected = true;
                break;
            }
        }
        inputCliente.value = data.cliente;
        inputFalla.value = data.fallaCliente;
    })
    .catch(err => console.log(err));
});

eliminaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-bs-id');
    eliminaModal.querySelector('.modal-footer #id').value = id;
});

function agregarEntrada() {
    // Obtener los datos del formulario de la nueva entrada
    var formData = new FormData(document.getElementById('formularioNuevaEntrada'));

    // Enviar los datos al servidor mediante AJAX
    $.ajax({
        type: 'POST',
        url: 'agregarEntrada.php', // URL del script PHP para guardar la entrada
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response); // Puedes mostrar un mensaje de éxito o actualizar la lista de entradas
            $('#agregarEntradaModal').modal('hide'); // Cerrar el modal después de guardar la entrada
        },
        error: function(xhr, status, error) {
            // Manejar errores en caso de que ocurran
            console.error(xhr.responseText);
        }
    });
}
