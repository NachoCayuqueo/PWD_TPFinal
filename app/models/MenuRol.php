<?php
class MenuRol
{
    private $objetoMenu;
    private $objetoRol;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->objetoMenu = "";
        $this->objetoRol = "";
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
}
