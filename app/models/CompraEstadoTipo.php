<?php
class CompraEstadoTipo
{
    private $idCompraEstadoTipo;
    private $cetDescripcion;
    private $cetDetalle;
    private $mensajeOperacion;

    public function __construct()
    {
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
}
