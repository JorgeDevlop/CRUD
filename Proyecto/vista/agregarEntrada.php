<div class="modal fade" id="agregarEntradaModal" tabindex="-1" aria-labelledby="agregarEntradaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarEntradaModalLabel">Agregar Nueva Entrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar nueva entrada -->
                <form action="guarda.php" method="post" enctype="multipart/form-data" id="formularioNuevaEntrada">
                    <div class="mb-3">
                        <label for="folio" class="form-label">Folio:</label>
                        <input type="text" class="form-control" id="folio" name="folio" required>
                    </div>
                    <div class="mb-3">
                        <label for="consecutivo" class="form-label">Consecutivo</label>
                        <input type="text" class="form-control" id="consecutivo" name="consecutivo" required>
                    </div>
                    <div class="mb-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <input type="text" class="form-control" id="responsable" name="responsable" required>
                    </div>
                    <!-- Otros campos de entrada para diag_motor, rep_motor, info_cpl, comentario -->
                    <!-- Recuerda agregar un campo oculto para el id_entrada (FK) -->
                    <input type="hidden" id="idEntrada" name="idEntrada" value="valor_folio_aqui">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="formularioNuevaEntrada"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
