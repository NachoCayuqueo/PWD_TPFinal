<?php
class Menu extends DataBase
{
    private $idMenu;
    private $objetoPadre;
    private $meDescripcion;
    private $meDeshabilitado;
    private $meNombre;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idMenu = "";
        $this->objetoPadre = null;
        $this->meDescripcion = "";
        $this->meDeshabilitado = "";
        $this->meNombre = "";
        $this->mensajeOperacion = "";
    }


    /**
     * Get the value of idMenu
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * Get the value of objetoPadre
     */
    public function getObjetoPadre()
    {
        return $this->objetoPadre;
    }

    /**
     * Get the value of meDescripcion
     */
    public function getMeDescripcion()
    {
        return $this->meDescripcion;
    }

    /**
     * Get the value of meDeshabilitado
     */
    public function getMeDeshabilitado()
    {
        return $this->meDeshabilitado;
    }

    /**
     * Get the value of meNombre
     */
    public function getMeNombre()
    {
        return $this->meNombre;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idMenu
     *
     * @return  self
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;

        return $this;
    }

    /**
     * Set the value of objetoPadre
     *
     * @return  self
     */
    public function setObjetoPadre($objetoPadre)
    {
        $this->objetoPadre = $objetoPadre;

        return $this;
    }

    /**
     * Set the value of meDescripcion
     *
     * @return  self
     */
    public function setMeDescripcion($meDescripcion)
    {
        $this->meDescripcion = $meDescripcion;

        return $this;
    }

    /**
     * Set the value of meDeshabilitado
     *
     * @return  self
     */
    public function setMeDeshabilitado($meDeshabilitado)
    {
        $this->meDeshabilitado = $meDeshabilitado;

        return $this;
    }

    /**
     * Set the value of meNombre
     *
     * @return  self
     */
    public function setMeNombre($meNombre)
    {
        $this->meNombre = $meNombre;

        return $this;
    }

    /**
     * Set the value of mensajeOperacion
     *
     * @return  self
     */
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;

        return $this;
    }

    public function setear($id, $nombre, $descripcion, $fechaDeshabilitado, $objetoPadre)
    {
        $this->setIdMenu($id);
        $this->setMeNombre($nombre);
        $this->setMeDescripcion($descripcion);
        $this->setMeDeshabilitado($fechaDeshabilitado);
        $this->setObjetoPadre($objetoPadre);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM menu WHERE idmenu = " . $this->getIdMenu();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();

                    $objetoMenu = null;
                    if ($row['idPadre'] !== null) {
                        $objetoMenu = new Menu();
                        $objetoMenu->setIdMenu($row['idpadre']);
                        $objetoMenu->cargar();
                    }

                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['medeshabilitado'], $objetoMenu);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Menu->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idPadre = $this->getObjetoPadre()->getIdMenu();

        $idPadreStr = $idPadre === null ? '' : ', idpadre';
        $idPadreVal = $idPadre === null ? '' : ', ' . $idPadre;

        $fechaDeshabilitado = $this->getMeDeshabilitado();
        $fechaDeshabilitadoStr =  ', medeshabilitado';
        $fechaDeshabilitadoVal = $fechaDeshabilitado === null ? ', NULL' : ", '" . $fechaDeshabilitado . "'";

        $sql = "INSERT INTO menu (menombre, medescripcion" . $idPadreStr . $fechaDeshabilitadoStr . ") VALUES ('"
            . $this->getMeNombre() . "', '"
            . $this->getMeDescripcion() . "'"
            . $idPadreVal
            . $fechaDeshabilitadoVal . ");";

        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($sql)) {
                $this->setIdMenu($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Menu => insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Menu => insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $idPadre = $this->getObjetoPadre()->getIdMenu();
        $query = "UPDATE menu SET 
        menombre='" . $this->getMeNombre() . "', 
        medescripcion='" . $this->getMeDescripcion() . "', ";

        if ($idPadre !== null) {
            $query .= "idpadre='" . $idPadre . "', ";
        } else {
            $query .= "idpadre=NULL, ";
        }

        $meDeshabilitado = $this->getMeDeshabilitado();
        if ($meDeshabilitado !== null) {
            $query .= "medeshabilitado='" . $meDeshabilitado . "'";
        } else {
            $query .= "medeshabilitado=NULL";
        }

        $query .= " WHERE idmenu=" . $this->getIdMenu();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Menu => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Menu => modificar iniciar: " . $this->getError());
        }

        return $resp;
    }

    // public function modificar_idpadre()
    // {
    //     $resp = false;
    //     $idPadre = $this->getObjetoPadre()->getIdMenu();
    //     $query = "UPDATE menu SET  
    //     idpadre=" . $idPadre . " WHERE idmenu=" . $this->getIdMenu();

    //     if ($this->Iniciar()) {
    //         if ($this->Ejecutar($query)) {
    //             $resp = true;
    //         } else {
    //             $this->setMensajeoperacion("ERROR::Menu => modificar_idpadre ejecutar: " . $this->getError());
    //         }
    //     } else {
    //         $this->setMensajeoperacion("ERROR::Menu => modificar_idpadre iniciar: " . $this->getError());
    //     }
    //     return $resp;
    // }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM menu WHERE idmenu=" . $this->getIdMenu();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Menu => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Menu => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM menu ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }
        // if ($this->Iniciar()) {
        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {

                    $objetoMenu = null;
                    $idPadre = $row['idpadre'];
                    if (!is_null($idPadre)) {
                        $objetoMenu = new Menu();
                        $objetoMenu->setIdMenu($row['idpadre']);
                        $objetoMenu->cargar();
                    }

                    $obj = new Menu();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['medeshabilitado'], $objetoMenu);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Menu => listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }

    public function habilitar()
    {
        $resp = false;
        $query = "UPDATE menu SET  
                    medeshabilitado=NULL WHERE idmenu=" . $this->getIdMenu();


        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Menu => habilitar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Menu => habilitar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function deshabilitar()
    {
        $resp = false;
        $newDate = date('Y-m-d H:i:s');
        $query = "UPDATE menu SET  
                    medeshabilitado='" . $newDate . "' WHERE idmenu=" . $this->getIdMenu();


        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Menu => deshabilitar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Menu => deshabilitar iniciar: " . $this->getError());
        }
        return $resp;
    }
}
