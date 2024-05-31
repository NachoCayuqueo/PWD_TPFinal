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


    // $param: idUsuario, idRolesAsignados
    public function crearUsuarioRol($param)
    {
        $idUsuario = $param['idUsuario'];
        $idRolesAsignados = $param['idRolesAsignados'];
        $rolActivoEstablecido = false;
        foreach ($idRolesAsignados as $idRol) {
            $param = [
                'idUsuario' => $idUsuario,
                'idRol' => $idRol,
                'rolActivo' => $rolActivoEstablecido ? 0 : 1,
            ];
            $altaExitosa = $this->alta($param);
            if ($altaExitosa && !$rolActivoEstablecido) {
                $rolActivoEstablecido = true;
            }
            if ($altaExitosa) {
                $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
            } else {
                $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar  dar de alta al usuario-rol');
                break;
            }
        }
        return $response;
    }

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

    public function obtenerRolActivo($idUsuario)
    {
        $rol = null;
        $param = [
            'idUsuario' => $idUsuario,
            'rolActivo' => '1'
        ];
        $usuarioRol = $this->buscar($param);
        if (!empty($usuarioRol)) {
            $rol = $usuarioRol[0]->getObjetoRol();
        }
        return $rol;
    }

    /**
     * Modificar el estado de un rol para un usuario.
     *
     * Esta función permite activar o desactivar un rol para un usuario específico.
     * Si el rol se activa, la función también verifica si el usuario ya tiene un rol activo
     * y lo desactiva antes de activar el nuevo rol. Si el rol se desactiva, la función
     * procede a eliminar el rol del usuario.
     *
     * @param array $param Parámetros necesarios para la modificación del rol del usuario.
     *   - idUsuario: int El ID del usuario al que se le modificará el rol.
     *   - idRol: int El ID del rol que se modificará.
     *   - rolActivo: bool Indica si el rol debe ser activado (true) o desactivado (false).
     *   - nombreRol: string El nombre del rol que se modificará (para mensajes descriptivos).
     *
     * @return array $response Respuesta con el resultado de la operación.
     *   - title: string El título del resultado ('EXITO' o 'ERROR').
     *   - message: string Mensaje descriptivo del resultado de la operación.
     */
    public function modificarRolUsuario($param)
    {
        $response = [];
        $esRolActivo = $param['rolActivo'];
        $idUsuario = $param['idUsuario'];
        $idRol = $param['idRol'];
        $nombreRol = $param['nombreRol'];

        $params = [
            "idUsuario" => $idUsuario,
            "idRol" => $idRol,
        ];

        $rolActivo = $this->obtenerRolActivo($idUsuario);

        if ($esRolActivo) {
            //* verificar rol actual
            if ($rolActivo) {
                $params["rolActivo"] = 0;
            } else {
                $params["rolActivo"] = 1;
            }
            //* dar alta en UsuarioRol
            $altaExitosa = $this->alta($params);
            if ($altaExitosa)
                $response = array('title' => 'EXITO', 'message' => 'Se activo el rol: '  . strtoupper($nombreRol));
            else
                $response = array('title' => 'ERROR', 'message' => 'ERROR al activar el rol: ' . strtoupper($nombreRol));
        } else {
            //* verificar si rol activo se da de baja
            if ($rolActivo->getIdRol() == $idRol) {
                $paramBuscarRol = [
                    "idUsuario" => $idUsuario,
                    "rolActivo" => 0
                ];

                $usuarioRol = $this->buscar($paramBuscarRol);
                $rol = $usuarioRol[0]->getObjetoRol();
                $paramModificar = [
                    "idUsuario" => $idUsuario,
                    "idRol" => $rol->getIdRol(),
                    "rolActivo" => 1
                ];
                $modificacionExitosa = $this->modificacion($paramModificar);
            }
            // if ($modificacionExitosa) {
            //     $response = array('title' => 'EXITO', 'message' => 'nuevo rol activado');
            // } else {
            //     $response = array('title' => 'ERROR', 'message' =>  $idUsuario);
            // }
            //* eliminar en UsuarioRol
            $params["rolActivo"] = 0;
            $bajaExitosa = $this->baja($params);
            if ($bajaExitosa)
                $response = array('title' => 'EXITO', 'message' => 'Se dio de baja el rol: ' . strtoupper($nombreRol));
            else
                $response = array('title' => 'ERROR', 'message' => 'ERROR al dar de baja el rol: ' . strtoupper($nombreRol));
        }
        return $response;
    }
}
