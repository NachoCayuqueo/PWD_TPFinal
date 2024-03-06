<?php

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{

    protected $table = 'usuariorol';
    protected $fillable = [
        'idusuario',
        'idrol'
    ];


    public function __construct()
    {
        $this->objUsuario = new Usuario();
        $this->objRol = new Rol();
    }
    public function setear($objetoUsuario, $objetoRol)
    {
        $this->objUsuario = $objetoUsuario;
        $this->objRol = $objetoRol;
    }
    public function rol()
    {
        return $this->belongsTo('rol', 'idrol');
    }
    public function usuario()
    {
        return $this->belongsTo('usuario', 'idusuario');
    }

    // public function crear_e_insertarEnTabla()
    // {
    //     $resp = false;
    //     $usuarioRol = new UsuarioRol();
    //     $usuarioRol->idusuario = ($this->usuario())->idusuario;
    //     $usuarioRol->idrol = ($this->rol())->idrol;
    //     $usuarioRol->save();
    //     $resp = true;
    //     return $resp;
    // }
    public function listar()
    {
        $usuariosRol = UsuarioRol::get()->toArray();
        return $usuariosRol;
    }
}


// private $objetoRol;
//     private $objetoUsuario;
//     private $mensajeOperacion;
