<?php

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $fillable = [
        'rodescripcion',
    ];
    protected $primaryKey = 'idrol';
    public $timestamps = false;

    public function __construct()
    {
        $this->idrol = "";
        $this->rodescripcion = "";
    }
    public function crear_e_insertarEnTabla($descripcion, $idrol)
    {
        $resp = false;
        $rol = new Rol();
        $rol->rodescripcion = $descripcion;
        $rol->idrol = $idrol;
        if ($rol->save()) {
            $resp = true;
        }
        return $resp;
    }
    public function eliminar_rol()
    {
        $resp = false;
        $rolAEliminar = $this->idrol;
        Rol::destroy($rolAEliminar);
        $resp = true;
        return $resp;
    }
    public static function listar($param)
    {
        $param = Rol::query();
        $arreglo = $param->get();
        return $arreglo;
    }
    public function modificar()
    {
        $resp = false;
        $this->update([
            'idrol' => $this->idrol,
            'rodescripcion' => $this->rodescripcion,
        ]);
        $this->save();
        $resp = true;
        return $resp;
    }
    public function setear($idrol, $rolDescripcion)
    {
        $this->update([
            "idrol" => $idrol,
            "rodescripcion" => $rolDescripcion,
        ]);
    }
}
