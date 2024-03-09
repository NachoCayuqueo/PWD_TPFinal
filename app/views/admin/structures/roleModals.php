<?php

function modalEdit($modalId, $idRol, $nombreRol)
{
    echo '
    <div  class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="formulario-editar-rol_' . $idRol . '" class="formulario-editar-rol card-title card-body">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Rol</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="idRol_' . $idRol . '" class="form-label">ID</label>
                                <input type="text" class="form-control bg-secondary" id="idRol_' . $idRol . '" value="' . $idRol . '" name="idRol_' . $idRol . '" readonly>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="descripcionRol_' . $idRol . '" class="form-label">Mail</label>
                                <input type="text" class="form-control" id="descripcionRol_' . $idRol . '" name="descripcionRol_' . $idRol . '" value="' . $nombreRol . '" required>
                                <div class="invalid-feedback">Ingresar un nombre</div>
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

function modalDelete($modalId, $idRol, $nombreRol)
{
    echo '
        <div class="modal fade modal-borrar" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form id="formulario-borrar-rol_' . $idRol . '" class="formulario-borrar-rol">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar Rol</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ¿Esta seguro que desea  eliminar el rol ' . $nombreRol . '?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    ';
}

function modalAddRole()
{
    echo '   
        <div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form id="formulario-nuevo-rol" class="formulario-nuevo-rol card-title card-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Rol</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="nombreRol" class="form-label">Nombre</label>
                                    <input id="nombreRol" name="nombreRol" class="form-control" type="text" required>
                                    <div class="invalid-feedback">Ingresar Nombre del Rol</div>
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

echo '<script src="' . $PUBLIC_JS . '/admin/buttonRolModalAjax.js"></script>';
