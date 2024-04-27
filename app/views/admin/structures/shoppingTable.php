<?php

function crearTablaNuevasCompras($compras)
{
    $itemsEncontrados = 0;
    echo '
        <table class="table table-striped table-bordered">
        <thead>
        <tr class="text-center card-title">   
            <th scope="col"></th>
            <th scope="col">ID Compra</th>    
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fecha Compra</th>
            <th scope="col">Total Compra</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="table-group-divider card-text">
        ';
    foreach ($compras as $compraUsuario) {
        foreach ($compraUsuario as $compra) {
            $estadoCompra = $compra['estadoCompra'];
            if ($estadoCompra === 2) {
                $itemsEncontrados++;
                $idCompra = $compra['idCompra'];
                $idUsuario = $compra['idUsuario'];
                $nombreUsuario = $compra['nombreUsuario'];
                $emailUsuario = $compra['emailUsuario'];
                $estadoCompra = $compra['estadoCompra'];
                $fechaCompra = $compra['fechaCompra'];
                $fechaCompra = dateFormat($fechaCompra);
                $precioTotalCompra = $compra['precioTotal'];
                $arregloCompraItems = $compra['compraItem'];
                $mostrarBotones = true;
                mostrarDatosTabla($idCompra, $idUsuario, $nombreUsuario, $emailUsuario, $estadoCompra, $fechaCompra, $precioTotalCompra, $arregloCompraItems, $mostrarBotones);
            }
        }
    }
    echo '</tbody>
        </table>';
    return $itemsEncontrados;
}

function crearTablaComprasAutorizadas($compras)
{
    $itemsEncontrados = 0;
    echo '
        <table class="table table-striped table-bordered">
        <thead>
        <tr class="text-center card-title">   
            <th scope="col"></th>
            <th scope="col">ID Compra</th>    
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fech Compra</th>
            <th scope="col">Total Compra</th>
        </tr>
        </thead>
        <tbody class="table-group-divider card-text">
        ';
    foreach ($compras as $compraUsuario) {
        foreach ($compraUsuario as $compra) {
            $estadoCompra = $compra['estadoCompra'];
            if ($estadoCompra === 3 || $estadoCompra === 4) {
                $itemsEncontrados++;
                $idCompra = $compra['idCompra'];
                $idUsuario = $compra['idUsuario'];
                $nombreUsuario = $compra['nombreUsuario'];
                $emailUsuario = $compra['emailUsuario'];
                $estadoCompra = $compra['estadoCompra'];
                $fechaCompra = $compra['fechaCompra'];
                $fechaCompra = dateFormat($fechaCompra);
                $precioTotalCompra = $compra['precioTotal'];
                $arregloCompraItems = $compra['compraItem'];
                mostrarDatosTabla($idCompra, $idUsuario, $nombreUsuario, $emailUsuario, $estadoCompra, $fechaCompra, $precioTotalCompra, $arregloCompraItems);
            }
        }
    }
    echo '</tbody>
        </table>';
    return $itemsEncontrados;
}

function crearTablaComprasCanceladas($compras)
{
    $itemsEncontrados = 0;
    echo '
        <table class="table table-striped table-bordered">
        <thead>
        <tr class="text-center card-title">   
            <th scope="col"></th>
            <th scope="col">ID Compra</th>    
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Email Usuario</th>
            <th scope="col">Fecha Compra</th>
            <th scope="col">Total Compra</th>
        </tr>
        </thead>
        <tbody class="table-group-divider card-text">
        ';
    foreach ($compras as $compraUsuario) {
        foreach ($compraUsuario as $compra) {
            $estadoCompra = $compra['estadoCompra'];
            if ($estadoCompra === 5) {
                $itemsEncontrados++;
                $idCompra = $compra['idCompra'];
                $idUsuario = $compra['idUsuario'];
                $nombreUsuario = $compra['nombreUsuario'];
                $emailUsuario = $compra['emailUsuario'];
                $estadoCompra = $compra['estadoCompra'];
                $fechaCompra = $compra['fechaCompra'];
                $fechaCompra = dateFormat($fechaCompra);
                $precioTotalCompra = $compra['precioTotal'];
                $arregloCompraItems = $compra['compraItem'];
                mostrarDatosTabla($idCompra, $idUsuario, $nombreUsuario, $emailUsuario, $estadoCompra, $fechaCompra, $precioTotalCompra, $arregloCompraItems);
            }
        }
    }
    echo '</tbody>
        </table>';
    return $itemsEncontrados;
}

function mostrarDatosTabla($idCompra, $idUsuario, $nombreUsuario, $emailUsuario, $estadoCompra, $fechaCompra, $precioTotalCompra, $arregloCompraItems, $mostrarBotones = false)
{
    echo "<tr>";
    echo "<td> 
            <a class='btn btn-link' data-bs-toggle='collapse' href='#collapseDatosTabla" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseDatosTabla" . $idCompra . "'>
                <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'>
            </a>
          </td>";
    echo "<td class='card-title'>" . $idCompra . "</td>";
    echo "<td class='card-title'>" . $idUsuario . "</td>";
    echo "<td>" . $nombreUsuario . "</td>";
    echo "<td>" . $emailUsuario . "</td>";
    echo "<td>" . $fechaCompra . "</td>";
    echo "<td>" . $precioTotalCompra . "</td>";
    if ($mostrarBotones) {
        echo "<td class='text-center'>
            <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#modalAutorizar_" . $idCompra . "'>
                Autorizar
            </button>
            <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#modalCancelar_" . $idCompra . "'>
                Cancelar
            </button>
        </td>";
        echo "</tr>";
        $idModal = "modalAutorizar_" . $idCompra;
        modalAutorizarCompra($idModal, $idCompra);
        $idModal = "modalCancelar_" . $idCompra;
        modalCancelarCompra($idModal, $idCompra);
    }
    mostrarCollapseProductos($idCompra, $arregloCompraItems);
}

function mostrarCollapseProductos($id, $itemsCompra)
{
    echo '
    <tr class="collapse" id="collapseDatosTabla' . $id . '">
        <td></td>
        <td colspan="5">
            <table class="table" >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                    </tr>
                </thead>
                <tbody>
                ';
    foreach ($itemsCompra as $item) {
        $idItem = $item['idCompraItem'];
        $nombreProducto = $item['nombreProducto'];
        $cantidadProducto = $item['cantidadProducto'];
        $precioProducto = $item['precioUnitarioProducto'];
        //crear tabla
        echo "<tr>";
        echo "<td class='card-title'>" . $idItem . "</td>";
        echo "<td>" . $nombreProducto . "</td>";
        echo "<td>" . $cantidadProducto . "</td>";
        echo "<td>" . $precioProducto . "</td>";
        echo "</tr>";
    }
    echo '</tbody>
            </table>    
        </td>
    </tr>';
}

function modalAutorizarCompra($idModal, $idCompra)
{
    echo '
    <div class="modal fade" id="' . $idModal . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="formulario_' . $idModal . '" class="formulario-autorizar-compra">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Autorizar Compra</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Esta seguro que desea autorizar la compra con id ' . $idCompra . '?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Activar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    ';
}

function modalCancelarCompra($idModal, $idCompra)
{
    echo '
        <div class="modal fade modal-borrar" id="' . $idModal . '" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form id="formulario_' . $idCompra . '" class="formulario-cancelar-compra">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Cancelar Compra</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ¿Esta seguro que desea cancelar la compra con id ' . $idCompra . '?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    ';
}

echo '<script src="' . $PUBLIC_JS . '/admin/buttonShoppingAjax.js"></script>';
