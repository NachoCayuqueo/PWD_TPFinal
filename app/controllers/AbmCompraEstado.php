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
                $param['ceFechaFin'],
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
            $obj = new CompraEstado();
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
        $objetoCompraEstado = new CompraEstado();
        $arreglo = $objetoCompraEstado->listar($whereClause);
        return $arreglo;
    }

    public function obtenerEstadoActual($idCompra)
    {
        $estado = 0;
        $listaCompraEstado = $this->buscar(['idCompra' => $idCompra]);
        if (!empty($listaCompraEstado)) {
            foreach ($listaCompraEstado as $compraEstado) {
                $estado = $compraEstado->getObjetoCompraEstadoTipo()->getIdCompraEstadoTipo();
                $fechaFin = $compraEstado->getCefechaifin();
            }
        }
        return ['estadoActual' => $estado, 'fechaFin' => $fechaFin];
    }

    /**
     * Cambia el estado de una compra a un nuevo estado especificado.
     *
     * @param int $idCompra El ID de la compra a la que se cambiará el estado.
     * @param int $estadoNuevo El nuevo estado al que se cambiará la compra.
     * @return bool Indica si la modificación del estado de la compra fue exitosa o no.
     */
    public function cambiarEstadoCompra($idCompra, $estadoNuevo)
    {
        $modificacionExitosa = false;
        $datosEstadoActual = $this->obtenerEstadoActual($idCompra);
        $paramBusqueda = [
            'idCompraEstadoTipo' => $datosEstadoActual['estadoActual'],
            'idCompra' => $idCompra
        ];
        $compraEstado = $this->buscar($paramBusqueda);

        if (!empty($compraEstado)) {
            $newDate = date('Y-m-d H:i:s');
            //* cerrar compra con estado actual
            $param = [
                'idCompraEstado' => $compraEstado[0]->getIdCompraEstado(),
                'ceFechaIni' => $compraEstado[0]->getCefechaini(),
                'ceFechaFin' => $newDate,
                'idCompra' =>  $idCompra,
                'idCompraEstadoTipo' => $datosEstadoActual['estadoActual'],
            ];
            $modificacionExitosa = $this->modificacion($param);
            if ($modificacionExitosa) {
                //* crear compra con estado nuevo
                $param = [
                    'ceFechaIni' => $newDate,
                    'ceFechaFin' => $estadoNuevo === 5 ? $newDate : null,
                    'idCompra' =>  $idCompra,
                    'idCompraEstadoTipo' => $estadoNuevo,
                ];
                $modificacionExitosa = $this->alta($param);
            }
        }
        return $modificacionExitosa;
    }
}
