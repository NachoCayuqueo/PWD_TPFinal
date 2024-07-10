$(document).ready(function () {
  $.ajax({
    url: "../../views/admin/actions/roleListAction.php",
    type: "POST",
    data: {},
    success: function (response) {
      response = JSON.parse(response);
      crearTablaRoles(response.listaRoles);
    },
    error: function (xhr, status, error) {
      console.log({ error });

      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
});
//! COMPROBAR EL DESHABILITADO SI ESTA BIEN ASI
function crearTablaRoles(listaRoles) {
  let tableHtml = `
        <h4 class="mb-4 title text-center">Listado de Roles</h4>
        <table class="table table-striped table-bordered">
        <thead>
        <tr class="text-center card-title">
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Deshabilitado</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="table-group-divider card-text">
    `;

  listaRoles.forEach((rol) => {
    const fechaEliminacion = rol.roFechaEliminacion;
    const disabled = fechaEliminacion ? "disabled" : "";

    tableHtml += `<tr>`;
    tableHtml += `<td class='card-title'>${rol.idRol}</td>`;
    tableHtml += `<td>${rol.rolDescripcion}</td>`;
    tableHtml += `<td class='text-center'>${dateFormat(fechaEliminacion)}</td>`;
    tableHtml += `
   <td class='text-center'>
                <form action="editRole.php" method="post" class="d-inline">
                    <input type="hidden" name="idRol" value="${rol.idRol}">
                    <input type="hidden" name="rolDescripcion" value="${rol.rolDescripcion}">
                    <button type="submit" class='btn btn-outline-primary edit-btn ${disabled}' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='Editar'>
                        <img src='../../../public/lib/bootstrap/bootstrap-icons/icons/pen.svg' alt='edit'>
                    </button>
                </form>
                <a href='#' class='btn btn-outline-danger delete-btn ${disabled}' id='deleteRolButton_${rol.idRol}' data-bs-toggle='modal' data-bs-target='#modalDelete_${rol.idRol}' type='button' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='Borrar'>
                    <img src='../../../public/lib/bootstrap/bootstrap-icons/icons/trash3.svg' alt='trash'>
                </a>
            </td>`;
    tableHtml += `</tr>`;

    // agrego los modales para editar y eliminar
  });

  tableHtml += `</tbody></table>`;

  // inserto el html
  $("#roleList").html(tableHtml);
}

function modalAddRole() {
  return `
    <div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formulario-nuevo-rol" class="formulario-nuevo-rol card-title card-body">
                    <div class="modal-header">
                        <h1 class="modal-title title fs-5" id="exampleModalLabel">Agregar Rol</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="nombreRol" class="form-label">Nombre</label>
                                <input id="nombreRol" name="nombreRol" class="form-control" type="text" required>
                                <div class="invalid-feedback">Ingresar Nombre del Rol</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-text btn-color">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    `;
}

function dateFormat(fecha) {
  if (!fecha) return "N/A";
  const date = new Date(fecha);
  return date.toLocaleDateString();
}
