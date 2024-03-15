<?php
class AbmCompra
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idCompra', $param)  &&
            array_key_exists('coFecha', $param) &&
            array_key_exists('idUsuario', $param)
        ) {
            $obj = new Compra();
            $obj->setear(
                $param['idCompra'],
                $param['coFecha'],
                $param['idUsuario']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idCompra'])) {
            $obj = new Compra();
            $obj->setear($param['idCompra'], null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idCompra']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idCompra'] = null;

        $objetoCompra = $this->cargarObjeto($param);
        if ($objetoCompra != null and $objetoCompra->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoCompra = $this->cargarObjeto($param);
            if ($objetoCompra != null and $objetoCompra->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoCompra = $this->cargarObjetoConClave($param);
            if ($objetoCompra != null and $objetoCompra->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idCompra']))
                $where[] = " idcompra = '" . $param['idCompra'] . "'";
            if (isset($param['coFecha']))
                $where[] = " cofecha = '" . $param['coFecha'] . "'";
            if (isset($param['idUsuario']))
                $where[] = " idusuario = '" . $param['idUsuario'] . "'";
        }
        $whereClause = implode(" AND ", $where);

        $objetoCompra = new Compra();
        $arreglo = $objetoCompra->listar($whereClause);
        return $arreglo;
    }

    //param: idUsuario
    public function obtenerCompras($param)
    {
        $compras = [];
        $compraItem = [];
        $compra_data = [];
        $precioTotal = 0;
        $objetoCompraItem = new AbmCompraItem();

        $listaCompra = $this->buscar($param);
        if (!empty($listaCompra)) {
            foreach ($listaCompra as $compra) {
                $compraItem = [];
                //obtener items de compra
                $paramIdCompra = ['idCompra' => $compra->getIdCompra()];

                $listaItems = $objetoCompraItem->buscar($paramIdCompra);
                foreach ($listaItems as $item) {
                    $objetoProducto = $item->getObjetoProducto();
                    $precioUnitario = $objetoProducto->getProPrecio();
                    $cantidad = $item->getCiCantidad();
                    $precioTotal += ($cantidad * $precioUnitario);

                    $item_data = [
                        'idCompraItem' => $item->getIdCompraItem(),
                        'idProducto' => $objetoProducto->getIdProducto(),
                        'nombreProducto' => $objetoProducto->getProNombre(),
                        'precioUnitarioProducto' => $precioUnitario,
                        'cantidadProducto' => $cantidad,
                    ];
                    array_push($compraItem, $item_data);
                }
                $compra_data = [
                    'idCompra' => $compra->getIdCompra(),
                    'cantidadItems' => count($compraItem),
                    'precioTotal' => $precioTotal,
                    'fechaCompra' => $compra->getCofecha(),
                    'idUsuario' => $param['idUsuario'],
                    'compraItem' => $compraItem
                ];
                array_push($compras, $compra_data);
            }
        }

        return $compras;
    }
}

// [
//     {
//         "idCompra": 3,
//         "fecha": 2024-02-11,
//         "idUsuario": 6,
//         "compraItem":[
//              {
//                "idCompraItem":4,
//                "idProducto": 5,
//                "nombreProducto": "funda de auto", 
//                "precioProducto":60000,           
//                "cantidad":1
//               },
//              {
//                "idCompraItem":5,
//                "idProducto": 6,
//                "producto": "funda de auto",
//                "precioProducto":60000,
//                "cantidad":2
//               },
//          ],
//     }
// ]