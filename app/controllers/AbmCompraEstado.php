<?php
class AbmCompraEstado
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idCompraEstado', $param)  &&
            array_key_exists('ceFechaIni', $param) &&
            array_key_exists('ceFechaFin', $param) &&
            array_key_exists('idCompra', $param) &&
            array_key_exists('idCompraEstadoTipo', $param)
        ) {
            $objetoCompra = new Compra();
            $objetoCompra->setIdCompra($param['idCompra']);

            $objetoCompraEstadoTipo = new CompraEstadoTipo();
            $objetoCompraEstadoTipo->setIdCompraEstadoTipo($param['idCompraEstadoTipo']);

            $obj = new CompraEstado();
            $obj->setear(
                $param['idCompraEstado'],
                $param['ceFechaIni'],
                $param['cetFechaFin'],
                $objetoCompra,
                $objetoCompraEstadoTipo
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstado
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idCompraEstado'])) {
            $obj = new Compra();
            $obj->setear($param['idCompraEstado'], null, null, null, null);
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
        if (isset($param['idCompraEstado']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idCompraEstado'] = null;

        $objetoCompraEstado = $this->cargarObjeto($param);
        if ($objetoCompraEstado != null and $objetoCompraEstado->insertar()) {
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
            $objetoCompraEstado = $this->cargarObjeto($param);
            if ($objetoCompraEstado != null and $objetoCompraEstado->modificar()) {
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
            $objetoCompraEstado = $this->cargarObjetoConClave($param);
            if ($objetoCompraEstado != null and $objetoCompraEstado->eliminar()) {
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
        // viewStructure($param);
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idCompraEstado']))
                $where[] = " idcompraestado = '" . $param['idCompraEstado'] . "'";
            if (isset($param['ceFechaIni']))
                $where[] = " cefechaini = '" . $param['ceFechaIni'] . "'";
            // Verificar si ceFechaFin es NULL para incluirlo en la búsqueda
            if (isset($param['ceFechaFin'])) {
                // Si ceFechaFin es NULL, agregar la condición correspondiente
                if ($param['ceFechaFin'] === null || $param['ceFechaFin'] === 'NULL') {
                    $where[] = "cefechafin IS NULL";
                } else {
                    // Si ceFechaFin no es NULL, agregar la fecha como condición
                    $where[] = "cefechafin = '" . $param['ceFechaFin'] . "'";
                }
            }
            // if (isset($param['ceFechaFin']))
            //     $where[] = " cefechafin = '" . $param['ceFechaFin'] . "'";
            if (isset($param['idCompra']))
                $where[] = " idcompra = '" . $param['idCompra'] . "'";
            if (isset($param['idCompraEstadoTipo']))
                $where[] = " idcompraestadotipo = '" . $param['idCompraEstadoTipo'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuario = new CompraEstado();
        $arreglo = $objetoUsuario->listar($whereClause);
        return $arreglo;
    }
}
