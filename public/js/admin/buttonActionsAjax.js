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

    const btnMailer = $("#btnMailer_" + idUsuario);
    // Mostrar el spinner al enviar el formulario
    btnMailer.find(".spinner-border").removeClass("d-none");
    btnMailer.prop("disabled", true);

    $.ajax({
      url: "../../views/admin/actions/editUserDataAction.php",
      type: "POST",
      data: {
        idUsuario,
        nombre,
        email,
        esConfiguracionPersonal: false,
      },
      success: function (response) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);
        response = JSON.parse(response);
        const idModal = "exampleModal_" + idForm;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);
        console.error(xhr.responseText);
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

  $(".formulario-borrar").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const id = obtenerId(formulario);

    const btnMailer = $("#btn_borrar_Mailer_" + id);
    // Mostrar el spinner al enviar el formulario
    btnMailer.find(".spinner-border").removeClass("d-none");
    btnMailer.prop("disabled", true);

    $.ajax({
      url: "../../views/admin/actions/deleteUserAction.php",
      type: "POST",
      data: {
        idUsuario: id,
      },
      success: function (response) {
        btnMailer.find(".spinner-border").removeClass("d-none");
        btnMailer.prop("disabled", false);

        response = JSON.parse(response);
        const idModal = "exampleModal_" + id;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        btnMailer.find(".spinner-border").removeClass("d-none");
        btnMailer.prop("disabled", false);

        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
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

        const idModal = "modalEdit_" + idMenu;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  }

  $(".formulario-borrar-menu").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idMenu = obtenerId(formulario);
    const nombreItem = obtenerNombreItem(idMenu);
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

    $.ajax({
      url: "../../views/admin/actions/deleteMenuAction.php",
      type: "POST",
      data: {
        idMenu,
        nombreItem,
        deshabilitarSwitch: switchDisabled ? switchDisabled : null,
        subItems,
      },
      success: function (response) {
        response = JSON.parse(response);
        const idModal = "modalEdit_" + idMenu;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  });

  $(".formulario-activar-menu").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idMenu = obtenerId(formulario);

    $.ajax({
      url: "../../views/admin/actions/activateMenuAction.php",
      type: "POST",
      data: {
        idMenu,
      },
      success: function (response) {
        response = JSON.parse(response);
        const idModal = "modalActivarMenu_" + idMenu;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  });

  $(".formulario-activar-usuario").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);

    const idUsuario = obtenerId(formulario);
    const btnMailer = $("#btnMailer_modalActivarUsuario_" + idUsuario);
    // Mostrar el spinner al enviar el formulario
    btnMailer.find(".spinner-border").removeClass("d-none");
    // Deshabilitar el botón mientras se procesa la solicitud
    btnMailer.prop("disabled", true);
    $.ajax({
      url: "../../views/admin/actions/activateUserAction.php",
      type: "POST",
      data: {
        idUsuario,
      },
      success: function (response) {
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);

        response = JSON.parse(response);
        const idModal = "modalActivarUsuario_" + idUsuario;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        // Ocultar el spinner en caso de error
        btnMailer.find(".spinner-border").addClass("d-none");
        btnMailer.prop("disabled", false);

        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
      },
    });
  });

  $(".formulario-habilitar-usuario").submit(function (event) {
    event.preventDefault();
    const formulario = $(this);
    const idUsuario = obtenerId(formulario);

    const btnMailer = $("#btn_modalHabilitarUsuario_" + idUsuario);
    btnMailer.find(".spinner-border").removeClass("d-none");
    btnMailer.prop("disabled", true);

    $.ajax({
      url: "../../views/admin/actions/enableUserAction.php",
      type: "POST",
      data: {
        idUsuario,
      },
      success: function (response) {
        response = JSON.parse(response);
        const idModal = "modalHabilitarUsuario_" + idUsuario;
        mostrarAlerta(response, idModal);
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
        const datosAlerta = {
          title: "Error",
          message:
            "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        };
        mostrarAlerta(datosAlerta);
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
