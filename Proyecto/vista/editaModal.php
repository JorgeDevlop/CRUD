<!-- Modal de Edición -->
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editaModalLabel">Editar Registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actualiza.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="folio" class="form-label">Folio</label>
                        <select name="folio" id="folio" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php 
                            $consecutivo->data_seek(0);
                            while($row_consecutivo = $consecutivo->fetch_assoc()): ?>
                                <option value="<?= $row_consecutivo["id"]; ?>"><?= $row_consecutivo["codigo"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class ="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php 
                            $estados->data_seek(0); 
                            while($row_estado = $estados->fetch_assoc()){?>
                                <option value=" <?php echo $row_estado["id"];?>"><?= $row_estado["nombre"];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ingresoFecha" class ="form-label">Fecha Ingreso:</label>
                        <input type="date" name="ingresoFecha" id="ingresoFecha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="modulos" class ="form-label">Modulo:</label>
                        <select name="modulos" id="modulos" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php 
                            $modulos->data_seek(0); 
                            while($row_modulo = $modulos->fetch_assoc()){
                                $selected = ($row_modulo["id"] == $data['id_modulo']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $row_modulo["id"]; ?>" <?php echo $selected; ?>><?php echo $row_modulo["nombre"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cliente" class ="form-label">Cliente:</label>
                        <input type="cliente" name="cliente" id="cliente" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fallaCliente" class ="form-label">Falla Cliente:</label>
                        <textarea type="fallaCliente" name="fallaCliente" id="fallaCliente" class="form-control" cols="30" rows="5" required></textarea>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"> </i> Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal de Edición -->
