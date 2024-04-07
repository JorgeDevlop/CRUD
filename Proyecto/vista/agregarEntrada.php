<div class="modal fade" id="agregarEntradaModal" tabindex="-1" aria-labelledby="agregarEntradaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarEntradaModalLabel">Agregar Nueva Entrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar nueva entrada -->
                <form action="guardar.php" method="post" enctype="multipart/form-data" id="formularioNuevaEntrada">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Entrada:</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php while($row_entrar = $entra->fetch_assoc()): ?>
                                <option value="<?= $row_entrar["id"]; ?>"><?= $row_entrar["folio"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="responsable" class="form-label">Consecutivo</label>
                        <select name="consecutivo" id="consecutivo" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php while($row_consecutivo = $consecutivo->fetch_assoc()): ?>
                                <option value="<?= $row_consecutivo["id"]; ?>"><?= $row_consecutivo["codigo"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <select name="responsable" id="responsable" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php while($row_responsables = $responsable->fetch_assoc()): ?>
                                <option value="<?= $row_responsables["id"]; ?>"><?= $row_responsables["nombre"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <div class="mb-3">
                <label for="diagMotor" class ="form-label">Falla Motor:</label>
                    <textarea type="diagMotor" name="diagMotor" id="diagMotor" class="form-control" cols="10" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="repMotor" class ="form-label">Reparacion:</label>
                    <textarea type="repMotor" name="repMotor" id="repMotor" class="form-control" cols="10" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="infoCpl" class ="form-label">Cpl:</label>
                    <textarea type="infoCpl" name="infoCpl" id="infoCpl" class="form-control" cols="1" rows="1" required></textarea>
            </div>

            <div class="mb-3">
                <label for="comentario" class ="form-label">Comentario:</label>
                    <textarea type="comentario" name="comentario" id="comentario" class="form-control" cols="10" rows="3"></textarea>
            </div>


                        
                    </div>
                    <!-- Otros campos de entrada para diag_motor, rep_motor, info_cpl, comentario -->
                    
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
