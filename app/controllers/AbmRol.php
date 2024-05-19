<?php
class AbmRol
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idRol', $param)  &&
            array_key_exists('roDescripcion', $param)
        ) {
            $obj = new Rol();
            $obj->setear(
                $param['idRol'],
                $param['roDescripcion']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idRol'])) {
            $obj = new Rol();
            $obj->setear($param['idRol'], null);
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
        if (isset($param['idRol']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idRol'] = null;

        $objetoUsuario = $this->cargarObjeto($param);
        if ($objetoUsuario != null and $objetoUsuario->insertar()) {
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
            $objetoUsuario = $this->cargarObjeto($param);
            if ($objetoUsuario != null and $objetoUsuario->modificar()) {
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
            if (isset($param['idRol']))
                $where[] = " idRol = '" . $param['idRol'] . "'";
            if (isset($param['roDescripcion']))
                $where[] = " rodescripcion = '" . $param['roDescripcion'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new Rol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }

    public function actualizarRol($idRol, $nombreRol)
    {
        $modificacionExitosa = false;
        $rol = $this->buscar(['idRol' => $idRol]);
        //* verificar si el rol existe
        if (!empty($rol)) {
            $params = [
                "idRol" => $idRol,
                "roDescripcion" => $nombreRol,
            ];
            $modificacionExitosa = $this->modificacion($params);

            if ($modificacionExitosa) {
                //* actualizo el nombre en el menu
                $objetoMenuRol = new AbmMenuRol();
                $menuRol = $objetoMenuRol->buscar(['idRol' => $idRol]);
                if (!empty($menuRol)) {
                    $objetoMenu = new AbmMenu();
                    $menuRol = $menuRol[0];
                    $idMenu = $menuRol->getObjetoMenu()->getIdMenu();
                    $modificacionExitosa = $objetoMenu->actualizarDatosMenu($idMenu, $nombreRol);
                } else {
                    $modificacionExitosa = false;
                }
            }
        }
        return $modificacionExitosa;
    }
}
