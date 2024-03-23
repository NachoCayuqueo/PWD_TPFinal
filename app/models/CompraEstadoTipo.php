<?php
class CompraEstadoTipo extends DataBase
{
    private $idCompraEstadoTipo;
    private $cetDescripcion;
    private $cetDetalle;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idCompraEstadoTipo = "";
        $this->cetDescripcion = "";
        $this->cetDetalle = "";
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of idCompraEstadoTipo
     */
    public function getIdCompraEstadoTipo()
    {
        return $this->idCompraEstadoTipo;
    }

    /**
     * Get the value of cetDescripcion
     */
    public function getCetDescripcion()
    {
        return $this->cetDescripcion;
    }

    /**
     * Get the value of cetDetalle
     */
    public function getCetDetalle()
    {
        return $this->cetDetalle;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idCompraEstadoTipo
     *
     * @return  self
     */
    public function setIdCompraEstadoTipo($idCompraEstadoTipo)
    {
        $this->idCompraEstadoTipo = $idCompraEstadoTipo;

        return $this;
    }

    /**
     * Set the value of cetDescripcion
     *
     * @return  self
     */
    public function setCetDescripcion($cetDescripcion)
    {
        $this->cetDescripcion = $cetDescripcion;

        return $this;
    }

    /**
     * Set the value of cetDetalle
     *
     * @return  self
     */
    public function setCetDetalle($cetDetalle)
    {
        $this->cetDetalle = $cetDetalle;

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

    public function setear($id, $descripcion, $detalle)
    {
        $this->setIdCompraEstadoTipo($id);
        $this->setCetDescripcion($descripcion);
        $this->setCetDetalle($detalle);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdCompraEstadoTipo();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado Tipo->cargar: " . $this->getError());
        }
        return $resp;
    }
    //TODO: revisar este codigo
    public function insertar()
    {
        $resp = false;
        $query = "INSERT INTO compraestadotipo(idcompraestadotipo,cetdescripcion,cetdetalle)  
              VALUES('"
            . $this->getIdCompraEstadoTipo() . "', '"
            . $this->getCetDescripcion() . "', '"
            . $this->getCetDetalle() . "'
        );";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdCompraEstadoTipo($id); //esta parte no seria necesaria
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Compra Estado Tipo->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Estado Tipo->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;

        $query = "UPDATE valoracionproducto SET 
            cetdescripcion='" . $this->getCetDescripcion() . "',
            cetdetalle='" . $this->getCetDetalle() . "'" .
            " WHERE idcompraestadotipo=" . $this->getIdCompraEstadoTipo();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Estado Tipo => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado Tipo => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM compraestadotipo WHERE idcompraestadotipo=" . $this->getIdCompraEstadoTipo();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Compra Estado Tipo => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Compra Estado Tipo => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM compraestadotipo ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }
        // if ($this->Iniciar()) {
        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $obj = new CompraEstadoTipo();
                    $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Compra Estado Tipo => listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }
}
