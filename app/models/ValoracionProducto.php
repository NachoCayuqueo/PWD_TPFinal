<?php

class ValoracionProducto extends DataBase
{
    private $idValoracionProducto;
    private $ranking;
    private $descripcion;
    private $fechaCreacion;
    private $objetoUsuario;
    private $objetoProducto;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idValoracionProducto = "";
        $this->ranking = "";
        $this->descripcion = "";
        $this->fechaCreacion = date('Y-m-d H:i:s'); //TODO: ver esta parte
        $this->objetoUsuario = new Usuario();
        $this->objetoProducto = new Producto();
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of idValoracionProducto
     */
    public function getIdValoracionProducto()
    {
        return $this->idValoracionProducto;
    }

    /**
     * Get the value of ranking
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * Get the value of fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    /**
     * Get the value of objetoUsuario
     */
    public function getObjetoUsuario()
    {
        return $this->objetoUsuario;
    }
    /**
     * Get the value of objetoProducto
     */
    public function getObjetoProducto()
    {
        return $this->objetoProducto;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idValoracionProducto
     *
     * @return  self
     */
    public function setIdValoracionProducto($idValoracionProducto)
    {
        $this->idValoracionProducto = $idValoracionProducto;

        return $this;
    }

    /**
     * Set the value of ranking
     *
     * @return  self
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }
    /**
     * Set the value of objetoUsuario
     *
     * @return  self
     */
    public function setObjetoUsuario($objetoUsuario)
    {
        $this->objetoUsuario = $objetoUsuario;

        return $this;
    }
    /**
     * Set the value of objetoProducto
     *
     * @return  self
     */
    public function setObjetoProducto($objetoProducto)
    {
        $this->objetoProducto = $objetoProducto;

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

    public function setear($id, $ranking, $descripcion, $fechaCreacion, $objUsuario, $objProducto)
    {
        $this->setIdValoracionProducto($id);
        $this->setRanking($ranking);
        $this->setDescripcion($descripcion);
        $this->setFechaCreacion($fechaCreacion);
        $this->setObjetoUsuario($objUsuario);
        $this->setObjetoProducto($objProducto);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM valoracionproducto WHERE idproducto = " . $this->getIdValoracionProducto();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $objetoProducto = new Producto();
                    $objetoProducto->setIdProducto($row['idproducto']);
                    $objetoProducto->cargar();

                    $objetoPersona = new Usuario();
                    $objetoPersona->setIdUsuario($row['idusuario']);
                    $objetoPersona->cargar();

                    $this->setear($row['idvaloracion'], $row['ranking'], $row['descripcion'], $row['fechacreacion'], $objetoPersona, $objetoProducto);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Valoracion Producto->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $idProducto = $this->getObjetoProducto()->getIdProducto();
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();
        $query = "INSERT INTO valoracionproducto(idusuario,idproducto, ranking, descripcion,fecha_creacion)  
              VALUES('"
            . $idUsuario . "', '"
            . $idProducto . "', '"
            . $this->getRanking() . "', '"
            . $this->getDescripcion() . "', '"
            . $this->getFechaCreacion() . "'
        );";

        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdValoracionProducto($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Valoracion Producto->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Valoracion Producto->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }
    //TODO: ver idProducto
    public function modificar()
    {
        $resp = false;
        $idUsuario = $this->getObjetoUsuario()->getIdUsuario();
        $idProducto = $this->getObjetoProducto()->getIdProducto();

        $query = "UPDATE valoracionproducto SET 
            idusuario='" . $idUsuario . "', 
            idproducto='" . $idProducto . "', 
            ranking='" . $this->getRanking() . "',
            descrpcion='" . $this->getDescripcion() . "',  
            fecha_creacion='" . $this->getFechaCreacion() . "'" .
            " WHERE idvaloracion=" . $this->getIdValoracionProducto();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Valoracion Producto => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Valoracion Producto => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM valoracionproducto WHERE idvaloracion=" . $this->getIdValoracionProducto();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Valoracion Producto => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Valoracion Producto => eliminar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM valoracionproducto ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }

        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {

                    $objetoProducto = new Producto();
                    $objetoProducto->setIdProducto($row['idproducto']);
                    $objetoProducto->cargar();

                    $objetoUsuario = new Usuario();
                    $objetoUsuario->setIdUsuario($row['idusuario']);
                    $objetoUsuario->cargar();

                    $obj = new ValoracionProducto();
                    $obj->setear($row['idvaloracion'], $row['ranking'], $row['descripcion'], $row['fecha_creacion'], $objetoUsuario, $objetoProducto);

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Valoracion Producto => listar: " . $this->getError());
        }

        return $arreglo;
    }
}
