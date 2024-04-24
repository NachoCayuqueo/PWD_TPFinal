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
            $objetoUsuario = new Usuario();
            $objetoUsuario->setIdUsuario($param['idUsuario']);

            $obj = new Compra();
            $obj->setear(
                $param['idCompra'],
                $param['coFecha'],
                $objetoUsuario
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

    /**
     * Obtiene las compras realizadas por un usuario y los detalles de cada compra.
     * @param array $param - Parámetros de búsqueda, en este caso el idUsuario.
     * @return array - Arreglo de objetos que representa las compras del usuario con sus detalles.
     */
    public function obtenerCompras($param)
    {
        $compras = [];
        $compraItem = [];
        $objetoCompraEstado = new AbmCompraEstado();

        $listaCompra = $this->buscar($param);
        if (!empty($listaCompra)) {
            // buscar datos usuario
            $objetoUsuario = new AbmUsuario();
            $usuario = $objetoUsuario->buscar(['idUsuario' => $param['idUsuario']]);
            $usuario = $usuario[0];

            foreach ($listaCompra as $compra) {
                // Obtener detalles de los items de la compra
                $detallesCompra = $this->obtenerDetallesCompraItems($compra);

                // obtener el estado actual de la compra
                $detallesEstado = $objetoCompraEstado->obtenerEstadoActual($compra->getIdCompra());

                // construir datos de la compra
                $compra_data = [
                    'idCompra' => $compra->getIdCompra(),
                    'estadoCompra' => $detallesEstado['estadoActual'],
                    'fechaFin' => $detallesEstado['fechaFin'],
                    'cantidadItems' => count($detallesCompra['items']),
                    'precioTotal' => $detallesCompra['precioTotal'],
                    'fechaCompra' => $compra->getCofecha(),
                    'idUsuario' => $param['idUsuario'],
                    'nombreUsuario' => $usuario->getUsNombre(),
                    'emailUsuario' =>  $usuario->getUsMail(),
                    'compraItem' => $detallesCompra['items']
                ];
                array_push($compras, $compra_data);
            }
        }

        return $compras;
    }

    public function obtenerDetallesCompras()
    {
        $arregloIdUsuarios = [];
        $arregloCompras = [];
        $compras = $this->buscar(null);
        if (!empty($compras)) {
            foreach ($compras as $compra) {
                $idUsuario = $compra->getObjetoUsuario()->getIdUsuario();
                array_push($arregloIdUsuarios, $idUsuario);
            }
            $arregloIdUsuarios = array_unique($arregloIdUsuarios);

            foreach ($arregloIdUsuarios as $idUsuario) {
                $compraUsuario = $this->obtenerCompras(['idUsuario' => $idUsuario]);
                array_push($arregloCompras, $compraUsuario);
            }
        }
        return $arregloCompras;
    }

    /**
     * Obtiene los detalles de los items de una compra.
     * @param Compra $compra - Objeto de la compra.
     * @return array - Arreglo de objetos que representa los detalles de los items de la compra.
     */
    private function obtenerDetallesCompraItems($compra)
    {
        $objetoCompraItem = new AbmCompraItem();
        $objetoProducto = new AbmProducto();
        $compraItem = [];
        $precioTotal = 0;

        // Obtener los items de la compra
        $paramIdCompra = ['idCompra' => $compra->getIdCompra()];
        $listaItems = $objetoCompraItem->buscar($paramIdCompra);

        // Calcular el precio total y construir los datos de los items
        foreach ($listaItems as $item) {
            $producto = $item->getObjetoProducto();
            $stockProducto = $producto->getProCantStock();
            $precioUnitario = $producto->getProPrecio();
            $tipo = $producto->getProTipo();
            $nombreImagen = $producto->getProImagen();
            $urlImagen =  $GLOBALS['IMAGES'] . "/products/" . $tipo . "/" . $nombreImagen;

            $cantidad = $item->getCiCantidad();
            $precioTotal += ($cantidad * $precioUnitario);

            $item_data = [
                'idCompraItem' => $item->getIdCompraItem(),
                'idProducto' => $producto->getIdProducto(),
                'nombreProducto' => $producto->getProNombre(),
                'urlImagen' => $urlImagen,
                'precioUnitarioProducto' => $precioUnitario,
                'cantidadProducto' => $cantidad,
                'stockDisponible' => $stockProducto
            ];
            $compraItem[] = $item_data;
        }

        return ['items' => $compraItem, 'precioTotal' => $precioTotal];
    }

    /**
     * Agrega un producto al carrito de compras de un usuario.
     *
     * Esta función busca un carrito de compras activo para el usuario proporcionado.
     * Si encuentra un carrito activo, agrega el producto al carrito existente.
     * Si no encuentra un carrito activo, crea uno nuevo y luego agrega el producto.
     *
     * @param array $param Los parámetros de entrada para agregar el producto al carrito.
     *   - idUsuario: El ID del usuario al que se agregará el producto al carrito.
     *   - idProducto: El ID del producto que se agregará al carrito.
     *   - cantidad: La cantidad del producto que se agregará al carrito.
     * @return bool Devuelve true si el producto se agregó exitosamente al carrito, de lo contrario, devuelve false.
     */
    public function agregarProductoCarrito($param)
    {
        $idUsuario = $param['idUsuario'];
        $idProducto = $param['idProducto'];
        $cantidadProducto = $param['cantidad'];

        $altaExitosa = false;
        $idCompraConCarrito = "";

        $carrito = $this->buscarCarritoActivo($idUsuario);
        if (!is_null($carrito)) {
            $objetoCompra = $carrito->getObjetoCompra();
            $idCompraConCarrito = $objetoCompra->getIdCompra();
            $altaExitosa = $this->agregarAlCarrito($idCompraConCarrito, $idProducto, $cantidadProducto);
        } else {
            $altaExitosa = $this->crearNuevoCarritoYAgregarProducto($param);
        }

        return $altaExitosa;
    }

    /**
     * Busca un carrito de compras activo para un usuario.
     *
     * @param int $idUsuario El ID del usuario.
     * @return mixed El carrito de compras activo si se encuentra, de lo contrario, devuelve null.
     */
    private function buscarCarritoActivo($idUsuario)
    {
        $listaCompras = $this->buscar(['idUsuario' => $idUsuario]);

        if (!empty($listaCompras)) {
            foreach ($listaCompras as $compra) {
                $carrito = $this->obtenerCarritoActivo($compra);
                if (!is_null($carrito)) {
                    return $carrito;
                }
            }
        }
        return null;
    }

    /**
     * Verifica si una compra tiene un carrito de compras activo.
     *
     * @param Compra $compra La compra a verificar.
     * @return mixed El carrito de compras activo si se encuentra, de lo contrario, devuelve null.
     */
    private function obtenerCarritoActivo($compra)
    {
        $objetoCompraEstado = new AbmCompraEstado();
        $paramCompraEstado = [
            'idCompra' => $compra->getIdCompra(),
            'idCompraEstadoTipo' => 1,
            'ceFechaFin' => 'NULL'
        ];
        $compraEstado = $objetoCompraEstado->buscar($paramCompraEstado);
        return !empty($compraEstado) ? $compraEstado[0] : null;
    }

    /**
     * Crea un nuevo carrito de compras y agrega un producto al mismo.
     *
     * @param array $param Los parámetros de entrada para agregar el producto al carrito.
     *   - idUsuario: El ID del usuario al que se agregará el producto al carrito.
     *   - idProducto: El ID del producto que se agregará al carrito.
     *   - cantidad: La cantidad del producto que se agregará al carrito.
     * @return bool Devuelve true si el carrito y el producto se agregaron exitosamente, de lo contrario, devuelve false.
     */
    private function crearNuevoCarritoYAgregarProducto($param)
    {
        $objetoCompraEstado = new AbmCompraEstado();
        $altaExitosa = false;
        $fechaActual = date('Y-m-d H:i:s');
        //crear compra
        $paramCompra = [
            'coFecha' => $fechaActual,
            'idUsuario' => $param['idUsuario']
        ];
        $altaExitosa = $this->alta($paramCompra);
        if ($altaExitosa) {
            //necesito el id de la compra creada, buscar todas las compras con la ultima fecha creada
            $compra = $this->buscar($paramCompra);
            $idCompraActual =  $compra[0]->getIdCompra();

            //crear compraEstado
            $paramCompraEstado = [
                'ceFechaIni' => $fechaActual,
                'ceFechaFin' => NULL,
                'idCompra' => $idCompraActual,
                'idCompraEstadoTipo' => 1
            ];
            $altaExitosa = $objetoCompraEstado->alta($paramCompraEstado);
            if ($altaExitosa) {
                //crear compraItem
                $idProducto = $param['idProducto'];
                $cantidad = $param['cantidad'];
                $altaExitosa = $this->agregarAlCarrito($idCompraActual, $idProducto, $cantidad);
            }
        }
        return $altaExitosa;
    }

    private function agregarAlCarrito($idCompra, $idProducto, $cantidadProducto)
    {
        $objetoCompraItem = new AbmCompraItem();
        $paramBuscar = [
            'idCompra' => $idCompra,
            'idProducto' =>  $idProducto
        ];
        $compraItem = $objetoCompraItem->buscar($paramBuscar);
        if (!empty($compraItem)) {
            //existe el producto => solo se debe sumar la cantidad
            $cantidad = $cantidadProducto + $compraItem[0]->getCiCantidad();
            $paramModificar = [
                'idCompraItem' => $compraItem[0]->getIdCompraItem(),
                'ciCantidad' => $cantidad,
                'idCompra' => $idCompra,
                'idProducto' => $idProducto
            ];
            $modificacionExitosa = $objetoCompraItem->modificacion($paramModificar);
        } else {
            $paramAlta = [
                'idCompra' => $idCompra,
                'idProducto' =>  $idProducto,
                'ciCantidad' => $cantidadProducto
            ];
            $modificacionExitosa = $objetoCompraItem->alta($paramAlta);
        }

        if ($modificacionExitosa) {
            //actualizar stock
            $objetoProducto = new AbmProducto();
            return $objetoProducto->actualizarStock($idProducto, $cantidadProducto);
        }

        return false;
    }
}
