$(document).ready(function () {
  $.ajax({
    url: "../../views/admin/actions/createListAccion.php",
    type: "POST",
    data: {},
    success: function (response) {
      response = JSON.parse(response);
      createListaRol(response.listaRol);
    },
    error: function (xhr, status, error) {
      console.log({ error });
      //   console.log(xhr);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
});

function createListaRol(listaRol) {
  listaRol.forEach(function (rol) {
    var idRol = rol.idRol;
    var descripcionRol = rol.rolDescripcion;
    var descripcionRolLower = descripcionRol.toLowerCase();

    var checkbox =
      '<input type="checkbox" class="btn-check btn-check-roles" id="btn-check-' +
      idRol +
      '" value="' +
      descripcionRol +
      '" ' +
      (descripcionRolLower === "cliente" ? "checked" : "") +
      ' autocomplete="off">';
    var label =
      '<label class="btn" for="btn-check-' +
      idRol +
      '">' +
      descripcionRol +
      "</label>";

    $("#listaRol").append(checkbox + label);
  });
}
