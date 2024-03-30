<?php
class MenuRol extends DataBase
{
    private $objetoMenu;
    private $objetoRol;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->objetoMenu = new Menu();
        $this->objetoRol = new Rol();
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of objetoMenu
     */
    public function getObjetoMenu()
    {
        return $this->objetoMenu;
    }

    /**
     * Get the value of objetoRol
     */
    public function getObjetoRol()
    {
        return $this->objetoRol;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of objetoMenu
     *
     * @return  self
     */
    public function setObjetoMenu($objetoMenu)
    {
        $this->objetoMenu = $objetoMenu;

        return $this;
    }

    /**
     * Set the value of objetoRol
     *
     * @return  self
     */
    public function setObjetoRol($objetoRol)
    {
        $this->objetoRol = $objetoRol;

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

    public function setear($objMenu, $objRol)
    {
        $this->setObjetoMenu($objMenu);
        $this->setObjetoRol($objRol);
    }

    public function cargar()
    {
        $idMenu = $this->getObjetoMenu()->getIdMenu();
        $idRol = $this->getObjetoRol()->getIdRol();
        $resp = false;
        $sql = "SELECT * FROM menurol WHERE idmenu = " . $idMenu . " AND idrol= " . $idRol . ";";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();

                    $objetoMenu = new Menu();
                    $objetoMenu->setIdMenu($row['idmenu']);
                    $objetoMenu->cargar();

                    $objetoRol = new Rol();
                    $objetoRol->setIdRol($row['idrol']);
                    $objetoRol->cargar();

                    $this->setear($objetoMenu, $objetoRol);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::MenuRol => cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idMenu = $this->getObjetoMenu()->getIdMenu();
        $idRol = $this->getObjetoRol()->getIdRol();

        $sql = "INSERT INTO menurol(idmenu,idrol)  VALUES(" . $idMenu . "," . $idRol . ");";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Menu Rol => insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Menu Rol => insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        return false;
    }

    public function eliminar()
    {
        $resp = false;
        $idMenu = $this->getObjetoMenu()->getIdMenu();
        $idRol = $this->getObjetoRol()->getIdRol();

        $sql = "DELETE FROM menurol WHERE idmenu=" . $idMenu . " AND idrol =" . $idRol . ";";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ERROR::Menu Rol => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Menu Rol => eliminar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM menurol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $objetoMenu = null;
                        $objetoRol = null;

                        $idMenu = $row['idmenu'];

                        if ($idMenu) {
                            $objetoMenu = new Menu();
                            $objetoMenu->setIdMenu($idMenu);
                            $objetoMenu->cargar();
                        }

                        $idRol = $row['idrol'];

                        if ($idRol) {
                            $objetoRol = new Rol();
                            $objetoRol->setIdRol($idRol);
                            $objetoRol->cargar();
                        }

                        $objetoMenuRol = new MenuRol();
                        $objetoMenuRol->setear($objetoMenu, $objetoRol);
                        array_push($arreglo, $objetoMenuRol);
                    }
                }
            } else {
                $this->setmensajeoperacion("ERROR:: Menu Rol => listar: " . $this->getError());
            }
        }

        return $arreglo;
    }
}
