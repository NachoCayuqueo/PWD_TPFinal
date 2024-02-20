<?php
class Producto
{
    private $idProducto;
    private $proCantStock;
    private $proDetalle;
    private $proNombre;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idProducto = "";
        $this->proCantStock = "";
        $this->proDetalle = "";
        $this->proNombre = "";
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
     * Get the value of proDetalle
     */
    public function getProDetalle()
    {
        return $this->proDetalle;
    }

    /**
     * Get the value of proNombre
     */
    public function getProNombre()
    {
        return $this->proNombre;
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
     * Set the value of proDetalle
     *
     * @return  self
     */
    public function setProDetalle($proDetalle)
    {
        $this->proDetalle = $proDetalle;

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
     * Set the value of mensajeOperacion
     *
     * @return  self
     */
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;

        return $this;
    }
}
