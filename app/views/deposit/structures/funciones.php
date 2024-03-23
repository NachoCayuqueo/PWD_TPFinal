<?php

function crearTablaProducto($listaProducto)
{
  //viewStructure($listaProducto);
  echo '
    <h4 class="mb-4 title text-center">Listado de Productos</h4>
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
    <tbody class="table-group-divider card-text">
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
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample' . $id . '" role="button" aria-expanded="false" aria-controls="multiCollapseExample' . $id . '">Mostrar Información</a>
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
                <a href="modifyProduct.php?nombre=' . $producto->getProNombre() .
      '&idProducto=' . $producto->getIdProducto() .
      '&precio=' . $producto->getProPrecio() .
      '&tipo=' . $producto->getProTipo() .
      '&descripcionCompleta=' . $descripcionCompleta .
      '&stock=' . $producto->getProCantStock() .
      '&esNuevo=' . $esNuevo .
      '&esPopular=' . $esPopular .
      '&nombreImagen=' . $producto->getProImagen() .
      '&nombreCompleto=' . $producto->getProDescripcion() . '" class="btn btn-outline-primary">
                    <img src="' . $GLOBALS['BOOTSTRAP_ICONS'] . '/pen.svg" alt="editar">
                </a>

                <a href="#" class="btn btn-outline-danger">
                    <img src="' . $GLOBALS['BOOTSTRAP_ICONS'] . '/trash3.svg" alt="eliminar">
                </a>   
</td>';

    echo "</tr>";
  }
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
