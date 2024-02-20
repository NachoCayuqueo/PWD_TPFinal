<?php
class Compra
{
    private $cofecha;
    private $idCompra;
    private $objetoUsuario;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->cofecha = '';
        $this->idCompra = '';
        $this->objetoUsuario = '';
        $this->mensajeOperacion = '';
    }

    /**
     * Get the value of cofecha
     */
    public function getCofecha()
    {
        return $this->cofecha;
    }

    /**
     * Get the value of idCompra
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Get the value of objetoUsuario
     */
    public function getObjetoUsuario()
    {
        return $this->objetoUsuario;
    }

    /**
     * Get the value of mensajeOperacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * Set the value of cofecha
     *
     * @return  self
     */
    public function setCofecha($cofecha)
    {
        $this->cofecha = $cofecha;

        return $this;
    }

    /**
     * Set the value of idCompra
     *
     * @return  self
     */
    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;

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
