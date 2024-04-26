<?php
class AbmValoracionProducto
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return ValoracionProducto
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idValoracionProducto', $param)  &&
            array_key_exists('ranking', $param) &&
            array_key_exists('descripcion', $param)  &&
            array_key_exists('fechaCreacion', $param) &&
            array_key_exists('idUsuario', $param)  &&
            array_key_exists('idProducto', $param)
        ) {
            $objetoUsuario = new Usuario();
            $objetoUsuario->setIdUsuario($param['idUsuario']);

            $objetoProducto = new Producto();
            $objetoProducto->setIdProducto($param['idProducto']);

            $obj = new ValoracionProducto();
            $obj->setear(
                $param['idValoracion'],
                $param['ranking'],
                $param['descripcion'],
                $param['fechaCreacion'],
                $objetoUsuario,
                $objetoProducto
            );
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idValoracion'])) {
            $obj = new ValoracionProducto();
            $obj->setear($param['idValoracion'], null, null, null, null, null);
        }
        return $obj;
    }
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idValoracion']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idValoracionProducto'] = null;

        $objetoValoracion = $this->cargarObjeto($param);
        if ($objetoValoracion != null and $objetoValoracion->insertar()) {
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
            $objetoValoracion = $this->cargarObjeto($param);
            if ($objetoValoracion != null and $objetoValoracion->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objetoProducto = $this->cargarObjetoConClave($param);
            if ($objetoProducto != null and $objetoProducto->eliminar()) {

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
            if (isset($param['idValoracion']))
                $where[] = " idvaloracion = '" . $param['idValoracion'] . "'";
            if (isset($param['idUsuario']))
                $where[] = " idusuario = '" . $param['idUsuario'] . "'";
            if (isset($param['idProducto']))
                $where[] = " idproducto = '" . $param['idProducto'] . "'";
            if (isset($param['ranking']))
                $where[] = " ranking = '" . $param['ranking'] . "'";
            if (isset($param['descripcion']))
                $where[] = " descripcion = '" . $param['descripcion'] . "'";
        }
        $whereClause = implode(" AND ", $where);

        $objetoValoracion = new ValoracionProducto();
        $arreglo = $objetoValoracion->listar($whereClause);
        return $arreglo;
    }

    //param es un arreglo de valoraciones
    public function cargarValoraciones($param)
    {
        $productosRankeados = $param['productosRankeados'];

        foreach ($productosRankeados as $producto) {
            $idUsuario = $producto['idUsuario'];
            $idProducto = $producto['idProducto'];
            $estrellas = $producto['estrellas'];
            $comentario = $producto['comentario'];

            $paramAlta = [
                'ranking' => $estrellas,
                'descripcion' => $comentario,
                'fechaCreacion' => date("Y-m-d H:i:s"),
                'idUsuario' => $idUsuario,
                'idProducto' => $idProducto
            ];

            $altaExitosa = $this->alta($paramAlta);
            if (!$altaExitosa) return false;
        }
        return $altaExitosa;
    }

    public function obtenerValoracionProducto($idUsuario, $idProducto)
    {
        $paramBuscar = [
            'idUsuario' => $idUsuario,
            'idProducto' => $idProducto
        ];
        $valoracionProducto = $this->buscar($paramBuscar);
        if (!empty($valoracionProducto)) {
            $ranking = $valoracionProducto[0]->getRanking();
            $descripcion = $valoracionProducto[0]->getDescripcion();
            $fecha = $valoracionProducto[0]->getFechaCreacion();
            $valoracion = [
                'ranking' => $ranking,
                'descripcion' => $descripcion,
                'fecha' => $fecha
            ];
            return $valoracion;
        } else {
            return [];
        }
    }
}
