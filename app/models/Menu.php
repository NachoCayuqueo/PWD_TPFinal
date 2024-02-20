<?php
class Menu
{
    private $idMenu;
    private $objetoPadre; //TODO: ver esto
    private $meDescripcion;
    private $meDeshabilitado;
    private $meNombre;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idMenu = "";
        $this->objetoPadre = "";
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
}
