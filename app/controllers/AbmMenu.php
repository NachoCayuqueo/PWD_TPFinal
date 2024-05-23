<?php
class AbmMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idMenu', $param)  &&
            array_key_exists('meNombre', $param) &&
            array_key_exists('meDescripcion', $param) &&
            array_key_exists('meDeshabilitado', $param) &&
            array_key_exists('idPadre', $param)
        ) {
            $objetoMenu = new Menu();
            $objetoMenu->setIdMenu($param['idPadre']);
            $obj = new Menu();
            $obj->setear(
                $param['idMenu'],
                $param['meNombre'],
                $param['meDescripcion'],
                $param['meDeshabilitado'],
                $objetoMenu
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idMenu'])) {
            $obj = new Menu();
            $obj->setear($param['idMenu'], null, null, null, null);
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
        if (isset($param['idMenu']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idMenu'] = null;

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
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idMenu']))
                $where[] = " idmenu = '" . $param['idMenu'] . "'";
            if (isset($param['meNombre']))
                $where[] = " menombre = '" . $param['meNombre'] . "'";
            if (isset($param['meDescripcion']))
                $where[] = " medescripcion = '" . $param['meDescripcion'] . "'";
            if (isset($param['meDeshabilitado']))
                $where[] = " medeshabilitado = '" . $param['meDeshabilitado'] . "'";
            if (isset($param['idPadre']))
                $where[] = " idpadre = '" . $param['idPadre'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoMenu = new Menu();
        $arreglo = $objetoMenu->listar($whereClause);
        return $arreglo;
    }

    public function habilitar($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $menuObject = $this->cargarObjetoConClave($param);
            if ($menuObject != null and $menuObject->habilitar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function deshabilitar($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $menuObject = $this->cargarObjetoConClave($param);
            if ($menuObject != null and $menuObject->deshabilitar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function obtenerNombresMenu($idMenu)
    {
        $arregloNombresMenu = [];
        $arregloHijosMenu = $this->obtenerHijosMenu($idMenu);
        // viewStructure($arregloHijosMenu);
        $arregloNombresMenu = $this->obtenerNombres($arregloHijosMenu);

        return $arregloNombresMenu;
    }

    private function obtenerNombres($array)
    {
        $nombres = [];

        foreach ($array as $hijo) {
            //* Se agrega el nombre del hijo
            if (empty($hijo['subHijos'])) {
                $nombres[] = [
                    'nombre' => $hijo['nombreHijo'],
                    'href' => $hijo['descripcionHijo']
                ];
            }

            //* Se verifica si el hijo tiene subHijos
            if (!empty($hijo['subHijos'])) {
                foreach ($hijo['subHijos'] as $subHijo) {
                    if (isset($subHijo['nombre'])) {
                        $nombres[] = [
                            'nombre' => $subHijo['nombre'],
                            'href' => $subHijo['descripcion']
                        ];
                    }
                }
            }
        }

        return $nombres;
    }

    /**
     * Arma dinámicamente el menú de navegación basado en el rol del usuario o en un menú predeterminado.
     * Si el usuario está autenticado, se genera el menú según el rol proporcionado.
     * Si el usuario no está autenticado, se muestra un menú predeterminado para el usuario invitado.
     *
     * @param int|null $idRol El ID del rol del usuario autenticado. Si es null, se asume que el usuario no está autenticado.
     * @return void
     */
    public function armarMenu($idRol)
    {
        if (!is_null($idRol)) {
            $objetoMenuRol = new AbmMenuRol();
            $param = ['idRol' => $idRol];
            $menuRol = $objetoMenuRol->buscar($param);
            if (!empty($menuRol)) {
                $menu = $menuRol[0]->getObjetoMenu();
                $idMenu = $menu->getIdMenu();
                $nombreMenu = $menu->getMeNombre();
            }
        } else {
            //* usuario no logueado, se arma menu con menu  por defecto (menu cliente).
            $menu = $this->buscar(['idMenu' => 3]);
            $idMenu = $menu[0]->getIdMenu();
            $nombreMenu = $menu[0]->getMeNombre();
        }
        $arregloMenu = $this->obtenerMenuCompleto($idMenu, $nombreMenu);
        $this->crearMenuHTML($arregloMenu);
    }

    /**
     * Obtiene el menú completo con sus hijos y subhijos.
     *
     * @param int $idMenu - El ID del menú padre.
     * @param string $nombreMenu - El nombre del menú padre.
     * @return array - Arreglo con el menú completo.
     */
    private function obtenerMenuCompleto($idMenu, $nombreMenu)
    {
        return [
            'idPadre' => $idMenu,
            'nombrePadre' => $nombreMenu,
            'hijos' => $this->obtenerHijosMenu($idMenu)
        ];
    }

    /**
     * Obtiene los hijos de un menú.
     *
     * @param int $idMenu - El ID del menú padre.
     * @return array - Arreglo con los hijos del menú.
     */
    private function obtenerHijosMenu($idMenu)
    {
        $arregloHijos = [];
        $objetoMenu = new AbmMenu();
        $paramMenu = ['idPadre' => $idMenu];
        $misMenus = $objetoMenu->buscar($paramMenu);
        if (!empty($misMenus)) {
            foreach ($misMenus as $menu) {
                $id = $menu->getIdMenu();
                $nombre = $menu->getMeNombre();
                $descripcion = $menu->getMeDescripcion();
                $fecha = $menu->getMeDeshabilitado();
                // if (is_null($fecha)) {
                $arregloHijos[] = [
                    'idHijo' => $id,
                    'nombreHijo' => $nombre,
                    'descripcionHijo' => $descripcion,
                    'fechaDeshabilitado' => $fecha,
                    'subHijos' => $this->obtenerSubHijosMenu($id)
                ];
                // }
            }
        }
        return $arregloHijos;
    }

    /**
     * Obtiene los subhijos de un menú.
     *
     * @param int $idMenu - El ID del menú.
     * @return array - Arreglo con los subhijos del menú.
     */
    private function obtenerSubHijosMenu($idMenu)
    {
        $arregloSubHijos = [];
        $objetoMenu = new AbmMenu();
        $hijos = $objetoMenu->buscar(['idPadre' => $idMenu]);
        if (!empty($hijos)) {
            foreach ($hijos as $hijo) {
                // if (is_null($hijo->getMeDeshabilitado())) {
                $arregloSubHijos[] = [
                    'id' => $hijo->getIdMenu(),
                    'nombre' => $hijo->getMeNombre(),
                    'descripcion' => $hijo->getMeDescripcion(),
                    'fechaDeshabilitado' => $hijo->getMeDeshabilitado()
                ];
                // }
            }
        }
        return $arregloSubHijos;
    }

    private function crearMenuHTML($arregloMenu)
    {
        // Obtiene los datos del menú
        $datosMenu = $arregloMenu['hijos'];
        // Inicia la estructura del navbar
        echo '
    <nav class="navbar navbar-expand-lg navbar-menu-color item-navbar">
        <div class="container-fluid">
            <div class="navbar-title collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
    ';

        // Recorre cada hijo del menú
        foreach ($datosMenu as $hijo) {
            $nombre = $hijo['nombreHijo'];
            $descripcionHijo = $hijo['descripcionHijo'];
            $subHijos = $hijo['subHijos'];
            $fechaDeshabilitado = $hijo['fechaDeshabilitado'];
            if (is_null($fechaDeshabilitado)) {
                // Verifica si el hijo tiene subhijos
                if (!empty($subHijos)) {
                    // Si tiene subhijos, genera un elemento de menú desplegable
                    echo '
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color: #f5f7f8;">' . $nombre . '</a>
                <ul class="dropdown-menu">
            ';

                    // Recorre cada subhijo
                    foreach ($subHijos as $subhijo) {
                        $nombreInterno = $subhijo['nombre'];
                        $descripcion = $subhijo['descripcion'];
                        $fechaDeshabilitado = $subhijo['fechaDeshabilitado'];
                        if (is_null($fechaDeshabilitado)) {
                            // Genera un elemento de menú para cada subhijo
                            echo '
                <li><a class="dropdown-item" href="' . $GLOBALS['VISTAS'] . "/" . $descripcion . '">' . $nombreInterno . '</a></li>
                ';
                        }
                    }

                    // Cierra el menú desplegable
                    echo '
                </ul>
            </li>
            ';
                } else {
                    // Si no tiene subhijos, genera un elemento de menú normal
                    echo '
            <li class="nav-item">
            ';
                    if ($nombre !== "Carrito") {
                        echo '
                    <a class="nav-link" href="' . $GLOBALS['VISTAS'] . "/" . $descripcionHijo . '" style="color: #f5f7f8;">' . $nombre . '</a>
                    ';
                    } else {
                        echo '
                    <a id="carritoLink" class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="color: #f5f7f8;">Carrito</a>
                    ';
                    }
                    echo '</li>';
                }
            }
        }

        // Cierra la estructura del navbar
        echo '
                </ul>
            </div>
        </div>
    </nav>
    ';
    }

    //genera un array con los datos del menu y sus hijos
    public function recuperarDatosMenu()
    {
        $arregloMenu = [];
        $menus = $this->buscar(null);

        foreach ($menus as $menu) {
            $objetoPadre = $menu->getObjetoPadre();

            if (is_null($objetoPadre)) {
                $hijos = $this->obtenerHijosMenu($menu->getIdMenu());

                $arregloMenu[] = [
                    'id' => $menu->getIdMenu(),
                    'nombre' => $menu->getMeNombre(),
                    'hijos' => $hijos
                ];
            }
        }
        return $arregloMenu;
    }

    public function activarItemMenu($idMenu)
    {
        $respuesta = false;
        $paramBuscar = ['idMenu' => $idMenu];
        $menu = $this->buscar($paramBuscar);
        if (!empty($menu)) {
            $dataMenu = $menu[0];
            $idPadre = $dataMenu->getObjetoPadre()->getIdMenu();
            $respuesta = $this->habilitar(['idMenu' => $idMenu]);
        }
        return $respuesta;
    }

    /**
     * Función para cambiar un elemento del menú de un rol a otro.
     *
     * @param array $param Un arreglo con los parámetros necesarios:
     *   - idMenu: ID del menú.
     *   - nombreItem: Nombre del ítem.
     *   - idRolSeleccionado: ID del rol seleccionado.
     *   - deshabilitarSwitch: Indicador de si el switch está deshabilitado.
     *   - subItems: Subelementos del menú.
     * @return bool
     */
    public function cambiarItemDelMenu($param)
    {
        $idMenu = $param['idMenu'];
        $nombreItem = $param['nombreItem'];
        $idRolSeleccionado = $param['idRolSeleccionado'];
        $switchActivado = $param['deshabilitarSwitch'];
        $switchActivado = $switchActivado === 'null' ? false : true;
        $subItems = $param['subItems'];
        $respuesta = false;

        if (!empty($subItems)) {
            $respuesta = $this->moverSubItems($switchActivado, $subItems, $idMenu, $nombreItem, $idRolSeleccionado);
        } else {
            $respuesta = $this->moverItem($idMenu, $nombreItem, $idRolSeleccionado);
        }
        return $respuesta;
    }

    /**
     * Función para deshabilitar un elemento del menú
     *
     * @param array $param Un arreglo con los parámetros necesarios:
     *   - idMenu: ID del menú.
     *   - nombreItem: Nombre del ítem.
     *   - idRolSeleccionado: ID del rol seleccionado.
     *   - deshabilitarSwitch: Indicador de si el switch está deshabilitado.
     *   - subItems: Subelementos del menú.
     * @return bool
     */
    public function deshabilitarItemDelMenu($param)
    {
        $idMenu = $param['idMenu'];
        $nombreItem = $param['nombreItem'];
        $idRolSeleccionado = $param['idRolSeleccionado'];
        $switchActivado = $param['deshabilitarSwitch'];
        $switchActivado = $switchActivado === 'null' ? false : true;
        $subItems = $param['subItems'];

        if (!empty($subItems)) {
            $respuesta = $this->deshabilitarSubItems($switchActivado, $subItems, $idMenu, $nombreItem, $idRolSeleccionado);
        } else {
            $respuesta = $this->deshabilitarItem($idMenu);
        }
        return $respuesta;
    }

    private function moverSubItems($moverSelector, $subItems, $idMenu, $nombreItem, $idRol)
    {
        $cambiosExitosos = false;
        if (!$moverSelector) {
            //* se recorre cada subitem del selector
            $cambiosExitosos = $this->procesarSubItems($subItems, $idRol);

            if ($cambiosExitosos)
                //* se actualiza el nombre del selector y se mantiene el id del rol
                $cambiosExitosos = $this->actualizarNombreSelector($idMenu, $nombreItem);
            else {
                $cambiosExitosos = $this->moverTodoSelector($idMenu, $nombreItem, $idRol);
            }
        } else {
            //* mover todo el selector
            $cambiosExitosos = $this->moverTodoSelector($idMenu, $nombreItem, $idRol);
        }
        return $cambiosExitosos;
    }

    private function deshabilitarSubItems($deshabilitarSelector, $subItems, $idMenu, $nombreItem, $idRol)
    {
        if (!$deshabilitarSelector) {
            $bajaExitosa = $this->procesarDeshabilitarSubItems($subItems);
        } else {
            $bajaExitosa = $this->deshabilitarItem($idMenu);
        }
        return $bajaExitosa;
    }

    private function procesarDeshabilitarSubItems($subItems)
    {
        foreach ($subItems as $item) {
            $idSubMenu = $item['id'];
            $paramIdMenu = ['idMenu' => $idSubMenu];
            $menu = $this->buscar($paramIdMenu);
            if (!empty($menu)) {
                $menuItem = $menu[0];
                $cambiarItem = $item['cambiarItem'];
                $cambiarItemBool = filter_var($cambiarItem, FILTER_VALIDATE_BOOLEAN);
                if ($cambiarItemBool) {
                    return $this->deshabilitarItem($menuItem->getIdMenu());
                }
            }
        }
        return false;
    }

    private function procesarSubItems($subItems, $idRol)
    {
        foreach ($subItems as $item) {
            $idSubMenu = $item['id'];
            $paramIdMenu = ['idMenu' => $idSubMenu];
            $menu = $this->buscar($paramIdMenu);
            if (!empty($menu)) {
                $menuItem = $menu[0];
                $cambiarItem = $item['cambiarItem'];
                $cambiarItemBool = filter_var($cambiarItem, FILTER_VALIDATE_BOOLEAN);
                if ($cambiarItemBool) {
                    $nombreSubItem = $item['nombre'];
                    return $this->modificarMenu($menuItem->getIdMenu(), $nombreSubItem, $menuItem->getMeDescripcion(), $menuItem->getMeDeshabilitado(), $idRol);
                }
            }
        }
        return false;
    }

    private function actualizarNombreSelector($idMenu, $nombreItem)
    {
        $menu = $this->buscar(['idMenu' => $idMenu]);
        if (!empty($menu)) {
            $menuItem = $menu[0];
            $idPadre = $menuItem->getObjetoPadre()->getIdMenu();
            $nombre = $menuItem->getMeNombre();
            if ($nombre === $nombreItem) return true;
            return $this->modificarMenu($menuItem->getIdMenu(), $nombreItem, $menuItem->getMeDescripcion(), $menuItem->getMeDeshabilitado(), $idPadre);
        }
    }

    private function moverTodoSelector($idMenu, $nombreItem, $idRol)
    {
        $objetoRol = new AbmRol();
        $rol = $objetoRol->buscar(['idRol' => $idRol]);
        $nombreNuevoRol = $rol[0]->getRoDescripcion();
        $nuevaDescripcion = "menu selector del usuario " . $nombreNuevoRol;
        return $this->moverItem($idMenu, $nombreItem, $idRol, $nuevaDescripcion);
    }

    private function moverItem($idMenu, $nombreItem, $idRol, $descripcion = "")
    {
        $menu = $this->buscar(['idMenu' => $idMenu]);

        if (!empty($menu)) {
            $menuItem = $menu[0];
            if ($descripcion === "") {
                $descripcion = $menuItem->getMeDescripcion();
            }
            return $this->modificarMenu($menuItem->getIdMenu(), $nombreItem, $descripcion, $menuItem->getMeDeshabilitado(), $idRol);
        }
    }

    private function deshabilitarItem($idMenu)
    {
        $menu = $this->buscar(['idMenu' => $idMenu]);

        if (!empty($menu)) {
            $menuItem = $menu[0];
            return $this->deshabilitarMenu($menuItem->getIdMenu());
        }
    }

    private function modificarMenu($id, $nombre, $descripcion, $fecha, $idPadre)
    {
        $paramModificacion = [
            'idMenu' => $id,
            'meNombre' => $nombre,
            'meDescripcion' => $descripcion,
            'meDeshabilitado' => $fecha,
            'idPadre' => $idPadre,
        ];
        return $this->modificacion($paramModificacion);
    }

    private function deshabilitarMenu($idMenu)
    {
        $paramBaja = [
            'idMenu' => $idMenu,
        ];
        return $this->deshabilitar($paramBaja);
    }

    public function actualizarDatosMenu($idMenu, $nombre)
    {
        $menu = $this->buscar(['idMenu' => $idMenu]);
        $idPadre = null;
        if (!empty($menu)) {
            $menu = $menu[0];
            $id = $menu->getIdMenu();
            $descripcion = $menu->getMeDescripcion();
            $fechaDeshabilitado = $menu->getMeDeshabilitado();
            $objetoPadre = $menu->getObjetoPadre();

            if ($objetoPadre) {
                $idPadre = $objetoPadre->getIdMenu();
            }

            return $this->modificarMenu($id, $nombre, $descripcion, $fechaDeshabilitado, $idPadre);
        }
        return false;
    }
}
