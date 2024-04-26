<?php
function modalReviews($arregloValoraciones)
{
  echo '
        <div class="modal fade" id="modalReviews" tabindex="-1" aria-labelledby="modalReviewsLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reviews</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">';
  foreach ($arregloValoraciones as $valoracion) {
    $usuario = $valoracion->getObjetoUsuario();
    $nombreUsuario = $usuario->getUsNombre();
    $emailUsuario = $usuario->getUsMail();
    $promedio = $valoracion->getRanking();
    echo '<input type="hidden" id="promedio_' . $valoracion->getIdValoracionProducto() . '" value="' . $promedio . '">';
    echo '<div id="card_' . $valoracion->getIdValoracionProducto() . '" class="card card-container p-2 mb-3">
            <div class="card-body">
              <h5 class="card-title">' . $nombreUsuario . '</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">' . $emailUsuario . '</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary">
                <div class="rating">
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                </div>
              </h6>
              <p class="card-text">' . $valoracion->getDescripcion() . '</p>
              <p class="card-text">' . dateFormat($valoracion->getFechaCreacion()) . '</p>
            </div>
          </div>';
  }
  echo '  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
    ';
}

function mostrarPromedio()
{
  echo '
        <div class="rating">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
        </div>
  ';
}
