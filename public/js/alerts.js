function mostrarAlerta(alerta, idModal = null, redirectUrl = null) {
  const icon = obtenerIcono(alerta.title);
  Swal.fire({
    icon,
    title: alerta.title,
    text: alerta.message,
  }).then(() => {
    // si viene idModal, se cierra
    if (idModal) {
      $("#" + idModal).modal("hide");
    }
    if (redirectUrl) {
      window.location.href = redirectUrl;
    } else {
      location.reload();
    }
  });
}

function obtenerIcono(iconName) {
  iconName = iconName.toLowerCase();
  switch (iconName) {
    case "exito":
      return "success";
    case "info":
      return "info";
    case "error":
      return "error";
    default:
      return "warning";
  }
}
