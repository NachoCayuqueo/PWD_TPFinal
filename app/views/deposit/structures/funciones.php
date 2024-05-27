<?php

function crearTablaProducto($listaProducto)
{
  echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Tipo</th>        
        <th scope="col">Detalles</th>
        <th scope="col">Stock</th>
        <th scope="col">Destacado</th>
        <th scope="col">Nuevo</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text text">
    ';


  foreach ($listaProducto as $producto) {

    $id =  $producto->getIdProducto();

    $esPopular = $producto->getEsProPopular();
    $esNuevo = $producto->getEsProNuevo();

    $check = seleccionCheck($esNuevo, $esPopular);
    $esNuevito = $check[0];
    $esPopu = $check[1];

    $descripcionCompleta = $producto->getProMasInfo();


    echo "<tr style='text-align: center;'>";
    echo "<td style='width: max-content;'>" . $producto->getIdProducto() . "</td>";
    echo '<td style="max-width: 200px; width: max-content;">' . $producto->getProNombre() . '</td>';
    echo "<td style='width: max-content;'>" . $producto->getProPrecio() . "</td>";
    echo "<td style='width: max-content;'>" . $producto->getProTipo() . "</td>";
    echo '<td style="width: max-content; margin: 0; padding: 3;">
        <p style="margin: 0;">
          <a class="btn btn-text btn-color" data-bs-toggle="collapse" href="#multiCollapseExample' . $id . '" role="button" aria-expanded="false" aria-controls="multiCollapseExample' . $id . '">Mostrar Información</a>
        </p>
        <div class="row " style="margin: 0;">
          <div class="col " style="margin: 0;">
            <div class="collapse multi-collapse" id="multiCollapseExample' . $id . '" style="margin: ;">
              <div class="card card-body" style="margin: 0;">
                ' . $descripcionCompleta . '
              </div>
            </div>
          </div>
        </div>
      </td>';
    echo "<td style='width: max-content;'>" . $producto->getProCantStock() . "</td>";
    echo "<td>$esPopu</td>";
    echo "<td >$esNuevito</td>";
    echo '<td>
    <form action="modifyProduct.php" method="post">
    <input type="hidden" name="nombre" value="' . $producto->getProNombre() . '">
    <input type="hidden" name="idProducto" value="' . $producto->getIdProducto() . '">
    <input type="hidden" name="precio" value="' . $producto->getProPrecio() . '">
    <input type="hidden" name="tipo" value="' . $producto->getProTipo() . '">
    <input type="hidden" name="descripcionCompleta" value="' . $descripcionCompleta . '">
    <input type="hidden" name="stock" value="' . $producto->getProCantStock() . '">
    <input type="hidden" name="esNuevo" value="' . $esNuevo . '">
    <input type="hidden" name="esPopular" value="' . $esPopular . '">
    <input type="hidden" name="nombreImagen" value="' . $producto->getProImagen() . '">
    <input type="hidden" name="nombreCompleto" value="' . $producto->getProDescripcion() . '">
    <button type="submit" class="btn btn-outline-primary">
      <img src="' . $GLOBALS['BOOTSTRAP_ICONS'] . '/pen.svg" alt="editar">
    </button>
  </form>

    <a href="" class="btn btn-outline-danger deleteButton" id="deleteButton-' . $producto->getIdProducto() . '" data-id="' . $producto->getIdProducto() . '">
        <img src="' . $GLOBALS['BOOTSTRAP_ICONS'] . '/trash3.svg" alt="eliminar">
    </a>  
</td>';


    echo "</tr>";
  }
  echo '</tbody></table>';
}
function seleccionCheck($esNuevo, $esPopular)
{

  if ($esNuevo === 0) {
    $esNuevito = '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
     </div>';
  } else {
    $esNuevito = '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
    </div>';
  }

  if ($esPopular === 0) {
    $esPopu = '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
     </div>';
  } else {
    $esPopu = '<div class="form-check" style="margin: 0; padding: 0; display: flex; justify-content: center; align-items: center;">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                </div>';
  }

  return [$esNuevito, $esPopu];
}
