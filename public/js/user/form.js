$(document).ready(function () {
  // Agregar listeners de eventos a los enlaces
  $("#link-datos-personales").on("click", function () {
    cargarFormulario("personalDataForm.php");
  });

  $("#link-cambiar-contrasenia").on("click", function () {
    cargarFormulario("passwordChangeForm.php");
  });

  $("#link-cambiar-roles").on("click", function () {
    cargarFormulario("roleChangeForm.php");
  });

  // Función para cargar el contenido de los archivos HTML y mostrarlo en el contenedor
  function cargarFormulario(archivo) {
    // Obtener referencia al contenedor del formulario
    const $contenedorFormulario = $("#contenedor-formulario");

    // Realizar la solicitud AJAX para cargar el contenido del archivo
    $.ajax({
      url: "../../views/usuario/structures/" + archivo,
      method: "GET",
      dataType: "html",
      success: function (response) {
        // Mostrar el contenido del archivo en el contenedor
        $contenedorFormulario.html(response);
      },
      error: function (xhr, status, error) {
        console.error("Error al cargar el formulario:", error);
      },
    });
  }
});
