$(document).ready(function () {
  $("#form-modif-producto").submit(function (event) {
    event.preventDefault();
    if (validarFormulario()) {
      enviarFormularioDeModificacion();
    }
  });
});

function enviarFormularioDeModificacion() {
  // const nombre=$("#nombre").val;
  const precio = $("#precio").val;
  const stock = $("#stock").val;
  const titulo = $("#titulo").val;
  const info = $("#masInfo");
}

$.ajax({
  url: "../../views/deposit/actions/modifyProductAction.php",
  method: "POST",
  data: {},
  success: function (response) {
    response = json.parse(response);
    if (response.title === "EXITO") {
      $ajax({});
    }
  },
});
