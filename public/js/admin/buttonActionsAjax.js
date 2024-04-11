$(document).ready(function () {
  $(".formulario-editar").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idForm = obtenerId(formulario);

    if (validarModalEditarUsuario(event, idForm)) {
      formularioEditar(idForm);
    }
  });

  function formularioEditar(idForm) {
    const idUsuario = $("#idUsuario_" + idForm).val();
    const nombre = $("#usNombre_" + idForm).val();
    const email = $("#usMail_" + idForm).val();

    $.ajax({
      url: "../../views/admin/actions/editUserDataAction.php",
      type: "POST",
      data: {
        idUsuario,
        nombre,
        email,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "Los datos fueron modificados correctamente.",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
        if (response.title === "SIN CAMBIOS") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "No se realizaron cambios",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  }

  $(".formulario-borrar").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idCompleto = formulario.attr("id"); // Recuperar el id completo del formulario actual
    const partesId = idCompleto.split("_"); // Dividir el id completo para obtener solo el idUsuario
    const id = partesId[partesId.length - 1]; // Obtener el último elemento

    const nombre = formulario.data("name");

    $.ajax({
      url: "../../views/admin/actions/deleteUserAction.php",
      type: "POST",
      data: {
        idUsuario: id,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "El usuario " + nombre + " ha sido eliminado correctamente.",
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#exampleModal_" + id).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        console.error("status: " + status);
        console.error("error: " + error);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });

  $(".formulario-editar-menu").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idMenu = obtenerId(formulario);

    if (validarModalEditarMenu(event, idMenu)) {
      formularioEditarMenu(idMenu);
    }
  });

  function formularioEditarMenu(idMenu) {
    const nombreItem = obtenerNombreItem(idMenu);
    const idRolSeleccionado = obtenerIdRol(idMenu);
    const switchDisabled = obtenerSwitchDisabled("nuevoSwitch", idMenu);

    const idItemSelectorValues = obtenerValores("idItemSelector", idMenu);
    const nombreItemSelectorValues = obtenerValores(
      "nombreItemSelector",
      idMenu
    );
    const switches = obtenerSwitches("switchCheck", idMenu);

    const subItems = armarArregloItems(
      idItemSelectorValues,
      nombreItemSelectorValues,
      switches
    );

    // console.log({
    //   idMenu,
    //   nombreItem,
    //   idRolSeleccionado,
    //   switchDisabled,
    //   subItems,
    // });

    // AJAX
    $.ajax({
      url: "../../views/admin/actions/editMenuAction.php",
      type: "POST",
      data: {
        idMenu,
        nombreItem,
        idRolSeleccionado,
        deshabilitarSwitch: switchDisabled ? switchDisabled : null,
        subItems,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalEdit_" + idMenu).modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalEdit_" + idMenu).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  }

  $(".formulario-borrar-menu").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idMenu = obtenerId(formulario);
    const nombreItem = obtenerNombreItem(idMenu);
    const idRolSeleccionado = obtenerIdRol(idMenu);
    const switchDisabled = obtenerSwitchDisabled("deleteSwitch", idMenu);

    const idItemSelectorValues = obtenerValores("idItemSelectorBorrar", idMenu);
    const nombreItemSelectorValues = obtenerValores(
      "nombreItemSelectorBorrar",
      idMenu
    );
    const switches = obtenerSwitches("switchCheckBorrar", idMenu);

    const subItems = armarArregloItems(
      idItemSelectorValues,
      nombreItemSelectorValues,
      switches
    );

    // console.log({
    //   idMenu,
    //   nombreItem,
    //   idRolSeleccionado,
    //   switchDisabled,
    //   subItems,
    // });

    $.ajax({
      url: "../../views/admin/actions/deleteMenuAction.php",
      type: "POST",
      data: {
        idMenu,
        nombreItem,
        idRolSeleccionado,
        deshabilitarSwitch: switchDisabled ? switchDisabled : null,
        subItems,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalEdit_" + idMenu).modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalEdit_" + idMenu).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(xhr.responseText);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });

  $(".formulario-activar-menu").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idMenu = obtenerId(formulario);
    console.log({ idMenu });

    $.ajax({
      url: "../../views/admin/actions/activateMenuAction.php",
      type: "POST",
      data: {
        idMenu,
      },
      success: function (response) {
        response = JSON.parse(response);

        if (response.title === "EXITO") {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalActivarMenu_" + idMenu).modal("hide");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          }).then(() => {
            // Cerrar el modal después de que se cierre el mensaje
            $("#modalActivarMenu_" + idMenu).modal("hide");
            location.reload();
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        console.error("status: " + status);
        console.error("error: " + error);
        // Muestra una alerta de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        });
      },
    });
  });

  //TODO: mover esta funcion para utilizarla de manera global
  function obtenerId(formulario) {
    const idCompleto = formulario.attr("id");
    const partesId = idCompleto.split("_");
    return partesId[partesId.length - 1];
  }

  function obtenerNombreItem(id) {
    return $("#nombreItem_" + id).val();
  }

  function obtenerIdRol(id) {
    const idRolSeleccionado = $(
      "input[id^='optionRol_'][id$='_" + id + "']:checked"
    ).attr("id");
    const partesIdRolSeleccionado = idRolSeleccionado.split("_");
    return partesIdRolSeleccionado[1];
  }

  function obtenerValores(selectorPrefix, id) {
    const valores = [];
    $("input[id^='" + selectorPrefix + "_'][id$='_" + id + "']").each(
      function () {
        const valor = $(this).val();
        valores.push(valor);
      }
    );
    return valores;
  }

  function armarArregloItems(arregloId, arregloNombre, arregloSwitch) {
    const idNombreArray = [];

    for (let i = 0; i < arregloId.length; i++) {
      const id = arregloId[i];
      const nombre = arregloNombre[i];
      const cambiarItem = arregloSwitch[i];

      idNombreArray.push({ id, nombre, cambiarItem: cambiarItem.value });
    }

    return idNombreArray;
  }

  function obtenerSwitches(selectorPrefix, id) {
    const switches = [];
    $("input[id^='" + selectorPrefix + "_'][id$='_" + id + "']").each(
      function () {
        const switchId = $(this).attr("id");
        const switchValue = $(this).prop("checked");
        switches.push({ id: switchId, value: switchValue });
      }
    );
    return switches;
  }

  function obtenerSwitchDisabled(selectorPrefix, id) {
    const nuevoSwitchId = selectorPrefix + "_" + id;
    const nuevoSwitchValue = $("#" + nuevoSwitchId).prop("checked");
    return nuevoSwitchValue;
  }

  //* Escuchar clics en el nuevo switch
  $("[id^='nuevoSwitch_']").click(function () {
    const idNuevoSwitch = $(this).attr("id");
    const partesIdNuevoSwitch = idNuevoSwitch.split("_");
    const id = partesIdNuevoSwitch[partesIdNuevoSwitch.length - 1];
    if ($(this).prop("checked")) {
      // Deshabilitar los dos switches anteriores
      $("input[id^='switchCheck_'][id$='_" + id + "']").each(function () {
        $(this).prop("disabled", true);
      });
    } else {
      // Habilitar los dos switches anteriores
      $("input[id^='switchCheck_'][id$='_" + id + "']").each(function () {
        $(this).prop("disabled", false);
      });
    }
  });

  $("[id^='deleteSwitch_']").click(function () {
    const idNuevoSwitch = $(this).attr("id");
    const partesIdNuevoSwitch = idNuevoSwitch.split("_");
    const id = partesIdNuevoSwitch[partesIdNuevoSwitch.length - 1];
    if ($(this).prop("checked")) {
      // Deshabilitar los dos switches anteriores
      $("input[id^='switchCheckBorrar_'][id$='_" + id + "']").each(function () {
        $(this).prop("disabled", true);
      });
    } else {
      // Habilitar los dos switches anteriores
      $("input[id^='switchCheckBorrar_'][id$='_" + id + "']").each(function () {
        $(this).prop("disabled", false);
      });
    }
  });
});
