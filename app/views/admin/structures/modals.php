<?php
function modalEdit($modalId, $idUsuario, $nombre, $mail)
{
    echo '
            <div  class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form id="formulario_' . $idUsuario . '" class="formulario-editar card-title card-body" novalidate>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalEditLabel">Editar Usuario</h1>
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

function modalDelete($modalId, $idUsuario, $nombre)
{
    echo '
        <div class="modal fade modal-borrar" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form id="formulario_' . $idUsuario . '" class="formulario-borrar" data-name="' . $nombre . '">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar Usuario</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ¿Esta seguro que desea  eliminar al usuario ' . $nombre . '?
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

function modalEditMenu($modalId, $idRolPadre, $idItem, $nombreItem, $subMenu, $roles)
{
    echo '
            <div  class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="formulario_' . $idItem . '" class="formulario-editar-menu card-title card-body" novalidate>
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="idItem_' . $idItem . '" class="form-label">ID</label>
                                            <input type="text" class="form-control bg-secondary" id="idItem_' . $idItem . '" value="' . $idItem . '" name="idItem_' . $idItem . '" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="nombreItem_' . $idItem . '" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombreItem_' . $idItem . '" name="nombreItem_' . $idItem . '" value="' . $nombreItem . '" required>
                                            <div class="invalid-feedback">Ingresar nombre</div>
                                        </div>
                                    </div>';

    if (!empty($subMenu)) {
        echo '<hr class="mb-3" style="color: grey;">';
        echo '<p for="rol" class="form-label">Item del Selector</p>    
                                        ';
        foreach ($subMenu as $item) {
            $idItemSelector = $item['id'];
            $nombreItemSelector = $item['nombre'];
            echo '
            <div class="row mb-4">
                <div class="col">
                    <label for="idItemSelector_' . $idItemSelector . '_' . $idItem . '" class="form-label">ID</label>
                    <input type="text" class="form-control bg-secondary" id="idItemSelector_' . $idItemSelector . '_' . $idItem . '" value="' . $idItemSelector . '" name="idItemSelector_' . $idItemSelector . '_' . $idItem . '" readonly>
                </div>
                <div class="col">
                    <label for="nombreItemSelector_' . $idItemSelector . '_' . $idItem . '" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreItemSelector_' . $idItemSelector . '_' . $idItem . '" name="nombreItemSelector_' . $idItemSelector . '_' . $idItem . '" value="' . $nombreItemSelector . '" required>
                    <div class="invalid-feedback">Ingresar nombre</div>
                </div>
                <div class="col form-check form-switch">
                    <p>Cambiar Item</p>
                    <input class="form-check-input" type="checkbox" role="switch" id="switchCheck_' . $idItemSelector . '_' . $idItem . '">
                    <label class="form-check-label" for="switchCheck_' . $idItemSelector . '_' . $idItem . '">Mover item</label>
                </div>
            </div>
            ';
        }
        //* Nuevo switch
        echo '
    <div class="row mb-4">
        <div class="col">
            <label for="nuevoSwitch_' . $idItem . '" class="form-label">¿Desea cambiar el selector o solo los items?</label>
            <input class="form-check-input switchCheck" type="checkbox" id="nuevoSwitch_' . $idItem . '">
        </div>
    </div>';
        echo '<hr class="mb-3" style="color: grey;">';
    }
    echo '
        <div class="row mb-4">
            <div class="col">
            <p for="rol" class="form-label">Roles Disponibles</p>';

    if ($roles) {
        foreach ($roles as $rol) {
            $idRol = $rol->getIdRol();
            $descripionRol = $rol->getRoDescripcion();
            $esRolActivo = $idRol === $idRolPadre;
            echo '
    <input type="radio" class="btn-check" name="options-base" id="optionRol_' . $idRol . '_' . $idItem . '" value="' . $idRol . '" ' . ($esRolActivo ? "checked" : "") . ' autocomplete="off">
    <label class="btn" for="optionRol_' . $idRol . '_' . $idItem . '">' . $descripionRol . '</label>
';
        }
    }

    echo '</div>
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

function modalDeleteMenu($modalId, $idRolPadre, $idItem, $nombreMenu, $subMenu)
{
    echo '
        <div class="modal fade modal-borrar" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formulario_' . $idItem . '" class="formulario-borrar-menu">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Deshabilitar Menu</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col form-floating">
                                <input type="text" class="form-control" id="idMenu_' . $idItem . '" value="' . $idItem . '" name="idMenu_' . $idItem . '" readonly>
                                <label for="idMenu_' . $idItem . '" class="ms-2">ID Menu</label>
                            </div>
                            <div class="col form-floating">
                                <input type="text" class="form-control" id="nombreItem_' . $idItem . '" name="nombreItem_' . $idItem . '" value="' . $nombreMenu . '" readonly>
                                <label for="nombreItem_' . $idItem . '" class="ms-2">Nombre</label>
                            </div>
                        </div>';
    if (!empty($subMenu)) {
        echo '<hr class="mb-3" style="color: grey;">';
        echo '<p for="rol" class="form-label">Item del Selector</p>    
                                                            ';
        foreach ($subMenu as $item) {
            $idItemSelector = $item['id'];
            $nombreItemSelector = $item['nombre'];
            echo '
                                <div class="row mb-4">
                                    <div class="col form-floating">
                                    <input type="text" class="form-control" id="idItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" value="' . $idItemSelector . '" name="idItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" readonly>
                                    <label for="idItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" class="ms-2">ID</label>
                                    </div>
                                    <div class="col form-floating">
                                        <input type="text" class="form-control" id="nombreItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" name="nombreItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" value="' . $nombreItemSelector . '" readonly>
                                        <label for="nombreItemSelectorBorrar_' . $idItemSelector . '_' . $idItem . '" class="ms-2">Nombre</label>
                                    </div>
                                    <div class="col form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckBorrar_' . $idItemSelector . '_' . $idItem . '">
                                        <label class="form-check-label" for="switchCheckBorrar_' . $idItemSelector . '_' . $idItem . '">Deshabilitar item</label>
                                    </div>
                                </div>
                                ';
        }
        //* Nuevo switch
        echo '
                        <div class="row mb-4">
                            <div class="col">
                                <label for="deleteSwitch_' . $idItem . '" class="form-label">Deshabilitar el selector completo</label>
                                <input class="form-check-input switchCheck" type="checkbox" id="deleteSwitch_' . $idItem . '">
                            </div>
                        </div>';
    }
    echo '</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger">Desactivar</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    ';
}

function modalActivarMenu($modalId, $idMenuPadre, $nombreMenu)
{
    echo '
    <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="formulario_' . $modalId . '" class="formulario-activar-menu" data-idPadre="' . $idMenuPadre . '">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Activar Item Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Esta seguro que desea activar al item ' . $nombreMenu . '?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Activar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    ';
}

function modalActivarUsuario($idUsuario, $nombreUsuario)
{
    echo '
    <div class="modal fade" id="' . $idUsuario . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="formulario_' . $idUsuario . '" class="formulario-activar-usuario">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Activar Usuario</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Esta seguro que desea activar al usuario ' . $nombreUsuario . '?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button id="btnMailer_' . $idUsuario . '" type="submit" class="btn btn-primary">
                  <span class="spinner-border spinner-border-sm d-none"  role="status" aria-hidden="true"></span>
                  Activar
                  </button>
                </div>
            </form>
        </div>
      </div>
    </div>
    ';
}

function modalHabilitarUsuario($idUsuario, $nombreUsuario)
{
    echo '
    <div class="modal fade" id="' . $idUsuario . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="formulario_' . $idUsuario . '" class="formulario-habilitar-usuario">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Habilitar Usuario</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Esta seguro que desea habilitar al usuario ' . $nombreUsuario . '?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Activar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    ';
}

echo '<script src="' . $PUBLIC_JS . '/admin/validations.js"></script>';
echo '<script src="' . $PUBLIC_JS . '/admin/buttonActionsAjax.js"></script>';
