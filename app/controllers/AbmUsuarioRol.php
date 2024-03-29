<?php
class AbmUsuarioRol
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            isset($param['rolActivo']) &&
            isset($param['idUsuario']) &&
            isset($param['idRol'])
        ) {
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idUsuario']);

            $objetoRol = new Rol();
            $objetoRol->setIdRol($param['idRol']);

            $obj = new UsuarioRol();
            $obj->setear($param['rolActivo'], $objUsuario, $objetoRol);
        }

        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return UsuarioRol
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (
            isset($param['rolActivo']) &&
            isset($param['idUsuario']) &&
            isset($param['idRol'])
        ) {

            $objUsuario = new Usuario();
            $objUsuario->setear($param['idUsuario'], null, null, null, null, null);

            $objetoRol = new Rol();
            $objetoRol->setear($param['idRol'], null);

            $obj = new UsuarioRol();
            $obj->setear($param['rolActivo'], $objUsuario, $objetoRol);
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
        if (
            isset($param['idUsuario']) &&
            isset($param['idRol'])
        )
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $objUsuarioRol = $this->cargarObjeto($param);
        if (($objUsuarioRol != null) && ($objUsuarioRol->insertar())) {
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
            $objetoUsuario = $this->cargarObjetoConClave($param);
            if ($objetoUsuario != null and $objetoUsuario->eliminar()) {
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
            if (isset($param['rolActivo']))
                $where[] = " rolactivo = '" . $param['rolActivo'] . "'";
            if (isset($param['idUsuario']))
                $where[] = " idusuario = '" . $param['idUsuario'] . "'";
            if (isset($param['idRol']))
                $where[] = " idrol = '" . $param['idRol'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new UsuarioRol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }

    //parametro $idUsuario
    //se desactiva el rol actual y se activa el nuevo rol
    public function cambiarDeRol($idUsuario, $idRol)
    {
        $modificacionExitosa = false;
        $param = [
            'idUsuario' => $idUsuario,
            'rolActivo' => '1'
        ];
        $usuarioRol = $this->buscar($param);
        if (!empty($usuarioRol)) {
            $rol = $usuarioRol[0]->getObjetoRol();
            $paramDesactivar = [
                'idUsuario' => $idUsuario,
                'idRol' => $rol->getIdRol(),
                'rolActivo' => '0'
            ];
            $modificacionExitosa = $this->modificacion($paramDesactivar);
            if ($modificacionExitosa) {
                $modificarParams = [
                    "idUsuario" => $idUsuario,
                    "idRol" => $idRol,
                    "rolActivo" => '1'
                ];
                $modificacionExitosa = $this->modificacion($modificarParams);
            }
        }
        return $modificacionExitosa;
    }
}
