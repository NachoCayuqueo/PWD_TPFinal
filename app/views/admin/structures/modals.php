<?php
function editModal($modalId, $idUsuario, $nombre, $mail)
{
    echo '
        <!-- Modal para la edición -->
            <div  class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form id="formulario_' . $idUsuario . '" class="formulario-editar card-title card-body">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="idUsuario_' . $idUsuario . '" class="form-label">ID</label>
                                        <input type="text" class="form-control bg-secondary" id="idUsuario_' . $idUsuario . '" value="' . $idUsuario . '" name="idUsuario_' . $idUsuario . '" readonly>
                                    </div>

                                    <div class="col">
                                        <label for="usNombre_' . $idUsuario . '" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="usNombre_' . $idUsuario . '" name="usNombre_' . $idUsuario . '" value="' . $nombre . '" required>
                                        <div class="invalid-feedback">Ingresar nombre</div>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="usMail_' . $idUsuario . '" class="form-label">Mail</label>
                                        <input type="text" class="form-control" id="usMail_' . $idUsuario . '" name="usMail_' . $idUsuario . '" value="' . $mail . '" required>
                                        <div class="invalid-feedback">Ingresar mail valido</div>
                                    </div>
                                </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        ';
}

echo '<script src="' . $PUBLIC_JS . '/admin/buttonActionsAjax.js"></script>';
