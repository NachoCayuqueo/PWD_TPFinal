<?php
class Rol extends DataBase
{
    private $idRol;
    private $roDescripcion;
    private $roFechaEliminacion;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();

        $this->idRol = "";
        $this->roDescripcion = "";
        $this->roFechaEliminacion = null;
        $this->mensajeOperacion = "";
    }


    /**
     * Get the value of idRol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Get the value of roDescripcion
     */
    public function getRoDescripcion()
    {
        return $this->roDescripcion;
    }
    /**
     * Get the value of roFechaEliminacion
     */
    public function getRoFechaEliminacion()
    {
        return $this->roFechaEliminacion;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idRol
     *
     * @return  self
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Set the value of roDescripcion
     *
     * @return  self
     */
    public function setRoDescripcion($roDescripcion)
    {
        $this->roDescripcion = $roDescripcion;

        return $this;
    }

    /**
     * Set the value of roFechaEliminacion
     *
     * @return  self
     */
    public function setRoFechaEliminacion($roFechaEliminacion)
    {
        $this->roFechaEliminacion = $roFechaEliminacion;

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

    public function setear($idrol, $rodescripcion, $roFechaEliminacion)
    {
        $this->setIdRol($idrol);
        $this->setRoDescripcion($rodescripcion);
        $this->setRoFechaEliminacion($roFechaEliminacion);
    }

    public function cargar()
    {
        $resp = false;
        $sql = "SELECT * FROM rol WHERE idrol = " . $this->getIdRol();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion'], $row['rofechaeliminacion']);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $roDescripcion = $this->getRoDescripcion();
        $roFechaEliminacion = $this->getRoFechaEliminacion();

        if ($roFechaEliminacion === null) {
            $sql = "INSERT INTO rol(rodescripcion) VALUES('"
                . $roDescripcion . "');";
        } else {
            $sql = "INSERT INTO rol(rodescripcion, rofechaeliminacion) VALUES('"
                . $roDescripcion . "', '"
                . $roFechaEliminacion . "');";
        }

        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($sql)) {
                $this->setIdRol($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => insertar iniciar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => insertar ejecutar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $sql = "UPDATE rol SET rodescripcion='" . $this->getRoDescripcion() . "' " .
            " WHERE idrol=" . $this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => modificar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $sql = "DELETE FROM rol WHERE idrol=" . $this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ERROR::Rol => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Rol => eliminar ejecutar: " . $this->getError());
        }
        return $resp;
    }

    public function deshabilitar()
    {

        $resp = false;
        $newDate = date('Y-m-d H:i:s');
        $query = "UPDATE rol SET 
                    rofechaeliminacion='" . $newDate . "' 
                    WHERE idrol=" . $this->getIdRol();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Rol => deshabilitar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Rol => deshabilitar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM rol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $objetoRol = new Rol();
                        $objetoRol->setear($row['idrol'], $row['rodescripcion'], $row['rofechaeliminacion']);
                        array_push($arreglo, $objetoRol);
                    }
                }
            } else {
                $this->setmensajeoperacion("ERROR::Rol => listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
