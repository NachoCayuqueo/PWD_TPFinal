<?php
class Producto extends DataBase
{
    private $idProducto;
    private $proCantStock;
    private $proPrecio;
    private $proTipo;
    private $proDescripcion;
    private $proMasInfo;
    private $proImagen;
    private $proNombre;
    private $esProPopular;
    private $esProNuevo;
    private $mensajeOperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idProducto = "";
        $this->proCantStock = "";
        $this->proPrecio = "";
        $this->proTipo = "";
        $this->proDescripcion = null;
        $this->proNombre = "";
        $this->esProPopular = false;
        $this->esProNuevo = false;
        $this->mensajeOperacion = "";
    }

    /**
     * Get the value of idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Get the value of proCantStock
     */
    public function getProCantStock()
    {
        return $this->proCantStock;
    }
    /**
     * Get the value of proPrecio
     */
    public function getProPrecio()
    {
        return $this->proPrecio;
    }
    /**
     * Get the value of proTipo
     */
    public function getProTipo()
    {
        return $this->proTipo;
    }
    /**
     * Get the value of proDescripcion
     */
    public function getProDescripcion()
    {
        return $this->proDescripcion;
    }
    /**
     * Get the value of proMasInfo
     */
    public function getProMasInfo()
    {
        return $this->proMasInfo;
    }
    /**
     * Get the value of proImagen
     */
    public function getProImagen()
    {
        return $this->proImagen;
    }
    /**
     * Get the value of proNombre
     */
    public function getProNombre()
    {
        return $this->proNombre;
    }
    /**
     * Get the value of esProPopular
     */
    public function getEsProPopular()
    {
        return $this->esProPopular;
    }
    /**
     * Get the value of esProNuevo
     */
    public function getEsProNuevo()
    {
        return $this->esProNuevo;
    }
    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of idProducto
     *
     * @return  self
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Set the value of proCantStock
     *
     * @return  self
     */
    public function setProCantStock($proCantStock)
    {
        $this->proCantStock = $proCantStock;

        return $this;
    }
    /**
     * Set the value of proPrecio
     *
     * @return  self
     */
    public function setProPrecio($proPrecio)
    {
        $this->proPrecio = $proPrecio;

        return $this;
    }
    /**
     * Set the value of proTipo
     *
     * @return  self
     */
    public function setProTipo($proTipo)
    {
        $this->proTipo = $proTipo;

        return $this;
    }
    /**
     * Set the value of proDescripcion
     *
     * @return  self
     */
    public function setProDescripcion($proDescripcion)
    {
        $this->proDescripcion = $proDescripcion;

        return $this;
    }
    /**
     * Set the value of proMasInfo
     *
     * @return  self
     */
    public function setProMasInfo($proMasInfo)
    {
        $this->proMasInfo = $proMasInfo;

        return $this;
    }
    /**
     * Set the value of proImagen
     *
     * @return  self
     */
    public function setProImagen($proImagen)
    {
        $this->proImagen = $proImagen;

        return $this;
    }
    /**
     * Set the value of proNombre
     *
     * @return  self
     */
    public function setProNombre($proNombre)
    {
        $this->proNombre = $proNombre;

        return $this;
    }
    /**
     * Set the value of esProPopular
     *
     * @return  self
     */
    public function setEsProPopular($esProPopular)
    {
        $this->esProPopular = $esProPopular;

        return $this;
    }
    /**
     * Set the value of esProNuevo
     *
     * @return  self
     */
    public function setEsProNuevo($esProNuevo)
    {
        $this->esProNuevo = $esProNuevo;

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

    public function setear($id, $nombre, $descripcion, $masInfo, $imagen, $precio, $tipo, $stock, $esPopular, $esNuevo)
    {
        $this->setIdProducto($id);
        $this->setProNombre($nombre);
        $this->setProDescripcion($descripcion);
        $this->setProMasInfo($masInfo);
        $this->setProImagen($imagen);
        $this->setProPrecio($precio);
        $this->setProTipo($tipo);
        $this->setProCantStock($stock);
        $this->setEsProPopular($esPopular);
        $this->setEsProNuevo($esNuevo);
    }

    public function cargar()
    {
        $resp = false;
        $query = "SELECT * FROM producto WHERE idproducto = " . $this->getIdProducto();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($query);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodescripcion'], $row['promasinfo'], $row['proimagen'], $row['proprecio'], $row['protipo'], $row['procantstock'], $row['esprodestacado'], $row['espronuevo']);
                }
            }
        } else {
            $this->setMensajeoperacion("ERROR::Producto->cargar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $query = "INSERT INTO producto(pronombre, prodescripcion,promasinfo,proimagen,procantstock,proprecio,esprodestacado,espronuevo,protipo)  
              VALUES('"
            . $this->getProNombre() . "', '"
            . $this->getProDescripcion() . "', '"
            . $this->getProMasInfo() . "', '"
            . $this->getProImagen() . "', '"
            . $this->getProCantStock() . "', '"
            . $this->getProPrecio() . "', '"
            . $this->getEsProPopular() . "', '"
            . $this->getEsProNuevo() . "', '"
            . $this->getProTipo() . "'
        );";
        if ($this->Iniciar()) {
            if ($id = $this->Ejecutar($query)) {
                $this->setIdProducto($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ERROR::Producto->insertar ejecutar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("ERROR::Producto->insertar iniciar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;

        $query = "UPDATE producto SET 
            pronombre='" . $this->getProNombre() . "', 
            prodescripcion='" . $this->getProDescripcion() . "', 
            promasinfo='" . $this->getProMasInfo() . "', 
            proimagen='" . $this->getProImagen() . "', 
            procantstock='" . $this->getProCantStock() . "', 
            proprecio='" . $this->getProPrecio() . "', 
            esprodestacado='" . $this->getEsProPopular() . "', 
            espronuevo='" . $this->getEsProNuevo() . "', 
            protipo='" . $this->getProTipo() . "'" .
            " WHERE idproducto=" . $this->getIdProducto();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Producto => modificar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Producto => modificar insertar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;

        $query = "DELETE FROM producto WHERE idproducto=" . $this->getIdProducto();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($query)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("ERROR::Producto => eliminar ejecutar: " . $this->getError());
            }
        } else {
            $this->setMensajeoperacion("ERROR::Producto => eliminar insertar: " . $this->getError());
        }

        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();

        $query = "SELECT * FROM producto ";
        if ($parametro != "") {
            $query .= 'WHERE ' . $parametro;
        }
        // if ($this->Iniciar()) {
        $res = $this->Ejecutar($query);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodescripcion'], $row['promasinfo'], $row['proimagen'], $row['proprecio'], $row['protipo'], $row['procantstock'], $row['esprodestacado'], $row['espronuevo']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("ERROR::Producto => listar: " . $this->getError());
        }
        //}
        return $arreglo;
    }
}
