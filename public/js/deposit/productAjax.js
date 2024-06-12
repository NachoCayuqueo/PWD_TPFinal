$(document).ready(function () {
  $("#form-modificar-producto").submit(function (event) {
    event.preventDefault();
    if (validarFormulario(event)) {
      const archivo = $("#miArchivo")[0].files[0];

      if (archivo) {
        // Si se seleccionó un archivo, llamar a la función guardarImagen() para guardar la imagen
        guardarImagenModif(archivo);
      } else {
        // Si no se seleccionó un archivo, llamar directamente a enviarFormularioDeModificacion() sin pasar un nombre de imagen
        enviarFormularioDeModificacion();
      }
    }
  });
  $("#form-nuevo-producto").submit(function (event) {
    event.preventDefault();
    if (validarFormularioNuevo(event)) {
      const archivo = $("#miArchivo")[0].files[0];
      if (archivo) {
        guardarImagenNuevo(archivo);
      }
    }
  });
});

function guardarImagenModif(archivo) {
  // Crear un objeto FormData
  let formData = new FormData();

  const tipo = $("input[name='tipo']:checked").val();
  formData.append("miArchivo", archivo);
  formData.append("tipo", tipo);

  // Solicitud AJAX
  $.ajax({
    type: "POST",
    url: "../../views/deposit/actions/saveImageAction.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const nombreImg = archivo.name;
        enviarFormularioDeModificacion(nombreImg);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}
function guardarImagenNuevo(archivo) {
  // Crear un objeto FormData
  let formData = new FormData();

  const tipo = $("input[name='tipo']:checked").val();
  formData.append("miArchivo", archivo);
  // Agregar el tipo al formData
  formData.append("tipo", tipo);

  // Solicitud AJAX
  $.ajax({
    type: "POST",
    url: "../../views/deposit/actions/saveImageAction.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const nombreImg = archivo.name;
        enviarFormularioDeCreacion(nombreImg);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}

function enviarFormularioDeModificacion(nombreImg) {
  // Crear un objeto FormData
  const idProducto = $("#idProducto").val();
  const nombre = $("#nombre").val();
  const precio = $("#precio").val();
  const tipo = $("input[name='tipo']:checked").val();
  const titulo = $("#titulo").val();
  const masInfo = $("#masInfo").val();
  const nombreImagen = nombreImg ? nombreImg : $("#nombreImagen").val();
  const stock = $("#stock").val();
  const esPopular = $("input[name='esPopular']:checked").val();
  const esNuevo = $("input[name='esNuevo']:checked").val();
  //AJAX
  $.ajax({
    url: "../../views/deposit/actions/modifyProductAction.php",
    type: "POST",
    data: {
      idProducto,
      nombre,
      precio,
      tipo,
      titulo,
      masInfo,
      nombreImagen,
      stock,
      esPopular,
      esNuevo,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const href = "../../views/deposit/dashboard.php";
        mostrarAlerta(response, null, href);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      // Maneja los errores de la solicitud AJAX
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}

function enviarFormularioDeCreacion(nombreImg) {
  // Crear un objeto FormData
  const nombre = $("#nombre").val();
  const precio = $("#precio").val();
  const tipo = $("input[name='tipo']:checked").val();
  const titulo = $("#titulo").val();
  const masInfo = $("#masInfo").val();
  const stock = $("#stock").val();
  const esPopular = $("input[name='esPopular']:checked").val();
  const esNuevo = $("input[name='esNuevo']:checked").val();

  //AJAX
  $.ajax({
    url: "../../views/deposit/actions/newProductAction.php",
    type: "POST",
    data: {
      nombre,
      precio,
      tipo,
      titulo,
      masInfo,
      stock,
      esPopular,
      esNuevo,
      nombreImg,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.title === "EXITO") {
        const href = "../../views/deposit/index.php";
        mostrarAlerta(response, null, href);
      } else {
        mostrarAlerta(response);
      }
    },
    error: function (xhr, status, error) {
      // Maneja los errores de la solicitud AJAX
      console.error("error", error);
      const datosAlerta = {
        title: "Error",
        message:
          "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
      };
      mostrarAlerta(datosAlerta);
    },
  });
}
