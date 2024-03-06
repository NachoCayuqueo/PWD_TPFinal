$(document).ready(function () {
  $(".checkBoxActiveUser").on("change", function () {
    const checkBox = $(this);
    const idCompleto = checkBox.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    var esActivo = checkBox.prop("checked");
    var mensaje = esActivo
      ? "El usuario está activo"
      : "El usuario no está activo";

    // Actualizar el mensaje del estado del usuario
    $("#estadoUsuario_" + id).text(mensaje);
  });
});
