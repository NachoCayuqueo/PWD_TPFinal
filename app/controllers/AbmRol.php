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
            array_key_exists('idRol', $param) &&
            array_key_exists('roDescripcion', $param)
        ) {
            // Asignar valor por defecto a roFechaEliminacion si no está presente
            $roFechaEliminacion = isset($param['roFechaEliminacion']) ? $param['roFechaEliminacion'] : null;

            $obj = new Rol();
            $obj->setear(
                $param['idRol'],
                $param['roDescripcion'],
                $roFechaEliminacion
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
            $obj->setear($param['idRol'], null, null);
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
        // viewStructure($param);
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
        //viewStructure($param);
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            // echo "aca llega bien"
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
            if (isset($param['roFechaEliminacion']))
                $where[] = " rofechaeliminacion = '" . $param['roFechaEliminacion'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new Rol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }

    public function toArray($listaRol)
    {
        $arregloRoles = [];
        foreach ($listaRol as $rol) {
            $arrayRol = [
                'idRol' => $rol->getIdRol(),
                'rolDescripcion' => $rol->getRoDescripcion(),
                'fechaEliminacion' => $rol->getRoFechaEliminacion()
            ];
            $arregloRoles[] = $arrayRol;
        }
        return $arregloRoles;
    }


    public function deshabilitar($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $objetoRol = $this->cargarObjetoConClave($param);

            if ($objetoRol != null and $objetoRol->deshabilitar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function actualizarRol($idRol, $nombreRol)
    {
        //echo ("idRol: " . +$idRol);
        $modificacionExitosa = false;
        $rol = $this->buscar(['idRol' => $idRol]);
        //* verificar si el rol existe
        if (!empty($rol)) {
            $params = [
                "idRol" => $idRol,
                "roDescripcion" => $nombreRol,
            ];
            $modificacionExitosa = $this->modificacion($params);
            //! aca sale siempre en falso
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

    public function nuevoRol($nombre)
    {
        $response = [];
        //* busco todos los roles para verificar que no exista
        $listaRoles = $this->buscar(null);
        $existeRol = false;
        if (!empty($listaRoles)) {
            foreach ($listaRoles as $rol) {
                $descripcionRol = $rol->getRoDescripcion();
                if (strtolower($nombre) === strtolower($descripcionRol)) {
                    //si se encuentra un rol con ese mismo nombre, enviamos mensaje de error 
                    $response = array('title' => 'ERROR', 'message' => 'El rol que intenta cargar ya existe');
                    $existeRol = true;
                    break;
                }
            }
        }
        if (!$existeRol) {
            //* si no existe creo el nuevo rol
            $param = [
                'roDescripcion' => $nombre,
                'roFechaEliminacion' => NULL
            ];
            $altaExitosa = $this->alta($param);

            if ($altaExitosa) {
                //* agregro el rol en la tabla menu
                $objetoMenu = new AbmMenu();
                $paramMenu = [
                    'meNombre' => $nombre,
                    'meDescripcion' => 'menu padre del usuario ' . $nombre,
                    'meDeshabilitado' => NULL,
                    'idPadre' => NULL
                ];
                $altaExitosa = $objetoMenu->alta($paramMenu);

                if ($altaExitosa) {
                    //* recuperar idRol
                    $rol = $this->buscar(['roDescripcion' => $nombre]);
                    $idRol = $rol[0]->getIdRol();
                    //* recuperar idMenu
                    $menu = $objetoMenu->buscar(['meNombre' => $nombre]);
                    $idMenu = $menu[0]->getIdMenu();

                    //* actualizo menurol
                    $objetoMenuRol = new AbmMenuRol();
                    $paramMenuRol = [
                        'idMenu' => $idMenu,
                        'idRol' => $idRol
                    ];
                    $altaExitosa = $objetoMenuRol->alta($paramMenuRol);
                    if ($altaExitosa) {
                        $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
                    } else {
                        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar crear un nuevo rol');
                    }
                }
            } else
                $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar crear un nuevo rol');
        } else
            $response = array('title' => 'ERROR', 'message' => 'El rol que intenta ingresar ya existe');


        return $response;
    }

    public function eliminarRol($idRol)
    {
        $response = [];

        $objetoUsuarioRol = new AbmUsuarioRol();
        $param = ['idRol' => $idRol];
        $listaUsuarioRol = $objetoUsuarioRol->buscar($param);
        if (empty($listaUsuarioRol)) {
            //* menu-rol 
            $objetoMenuRol = new AbmMenuRol();
            $menuRol = $objetoMenuRol->buscar($param);
            $idMenu = $menuRol[0]->getObjetoMenu()->getIdMenu();

            //* eliminar menu -> se agrega fecha deshabilitado
            $objetoMenu = new AbmMenu();
            $bajaExitosa = $objetoMenu->deshabilitar(['idMenu' => $idMenu]);

            if ($bajaExitosa) {
                //* eliminar rol
                $bajaExitosa = $this->deshabilitar($param);
                if ($bajaExitosa)
                    $response = array('title' => 'EXITO', 'message' => 'Se elimino el rol');
                else
                    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el rol con id: ' . $idRol);
            } else {
                $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el rol con id: ' . $idRol);
            }
        } else {
            $response = array('title' => 'ERROR', 'message' => 'Existen usuarios  asignados a este Rol');
        }
        return $response;
    }
}
