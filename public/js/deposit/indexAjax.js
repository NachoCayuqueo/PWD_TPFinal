$(document).ready(function () {
  // console.log("estoy en indexAjax.js");
  $.ajax({
    url: "../../views/deposit/actions/indexAction.php",
    type: "POST",
    data: { idMenu: 2 },
    success: function (response) {
      response = JSON.parse(response);
      // console.log(response);
      generarMenuHTML(response.datosMenu);
    },
    error: function (xhr, status, error) {
      console.log({ error });
      // console.log("error en ajax");
      // console.log(response.message);
      const datosAlerta = {
        title: "Error",
        text: "Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.",
        icon: "error",
      };
      Swal.fire(datosAlerta);
    },
  });
});

function generarMenuHTML(datosMenu) {
  var menuHTML = "";
  datosMenu.forEach(function (menu) {
    menuHTML += '<div class="col">';
    console.log(menu.href);
    console.log(menu.nombre);
    menuHTML += buttonCard(menu.href, menu.nombre);
    menuHTML += "</div>";
  });

  $("#menuDeposito").html(menuHTML);
}

function buttonCard(href, text) {
  var url = `/PWD_TPFinal/app/views/${href}`;
  var cardHTML = `
      <div class="card p-2 shadow border border-0">
          <a href="${url}" class="btn">
              <div class="card-body">
                  <h5 class="card-title title">${text}</h5>
              </div>
          </a>
      </div>
  `;
  return cardHTML;
}
