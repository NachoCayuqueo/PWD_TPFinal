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

  // Función para confirmar la eliminación
  function confirmarEliminacion(idRol) {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../views/admin/actions/deleteRolAction.php",
          type: "POST",
          data: { idRol: idRol },
          success: function (response) {
            response = JSON.parse(response);
            if (response.title === "EXITO") {
              Swal.fire(response.title, response.message, "success").then(
                () => {
                  location.reload(); // Recargar la página para actualizar la lista de roles
                }
              );
            } else {
              Swal.fire(
                "Error",
                "Hubo un problema al eliminar el rol.",
                "error"
              );
            }
          },
          error: function (xhr, status, error) {
            Swal.fire(
              "Error",
              "Hubo un problema al procesar la solicitud.",
              "error"
            );
          },
        });
      }
    });
  }

  // Función para crear la tabla de roles
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
      tableHtml += `<td class='text-center'>${dateFormat(
        fechaEliminacion
      )}</td>`;
      tableHtml += `
        <td class='text-center'>
          <form action="editRole.php" method="post" class="d-inline">
            <input type="hidden" name="idRol" value="${rol.idRol}">
            <input type="hidden" name="rolDescripcion" value="${rol.rolDescripcion}">
            <button type="submit" class='btn btn-outline-primary edit-btn ${disabled}' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='Editar'>
              <img src='../../../public/lib/bootstrap/bootstrap-icons/icons/pen.svg' alt='edit'>
            </button>
          </form>
          <button class='btn btn-outline-danger delete-btn ${disabled}' id='deleteRolButton_${rol.idRol}' data-idrol='${rol.idRol}' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='Borrar'>
            <img src='../../../public/lib/bootstrap/bootstrap-icons/icons/trash3.svg' alt='trash'>
          </button>
        </td>`;
      tableHtml += `</tr>`;
    });

    tableHtml += `</tbody></table>`;

    // Insertar la tabla en el elemento con id roleList
    $("#roleList").html(tableHtml);

    // Asignar evento de click a los botones de eliminación
    $(".delete-btn").on("click", function () {
      const idRol = $(this).data("idrol");
      confirmarEliminacion(idRol);
    });
  }

  // Función para formatear la fecha
  function dateFormat(fecha) {
    if (!fecha) return "N/A";
    const date = new Date(fecha);
    return date.toLocaleDateString();
  }

  // Función para mostrar alertas
  function mostrarAlerta(datosAlerta) {
    Swal.fire({
      title: datosAlerta.title,
      text: datosAlerta.message,
      icon: datosAlerta.type || "error",
    }).then(() => {
      if (datosAlerta.redirect) {
        window.location.href = datosAlerta.redirect;
      }
    });
  }
});
