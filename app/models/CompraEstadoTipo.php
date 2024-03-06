<?php

use Illuminate\Database\Eloquent\Model;

class CompraEstadoTipo extends Model
{
    protected $table = 'compraestadotipo';
    protected $fillable = [
        'cetdescripcion',
        'cetdetalle',
    ];
    protected $primaryKey = 'idcompraestadotipo';
    public $timestampos = false;

    public function __construct()
    {
        $this->idcompraestadotipo = "";
        $this->cetdescripcion = "";
        $this->cetdetalle = "";
    }
    public function crear_e_insertarEnTabla($idcompraestadotipo, $cetDescripcion, $cetDetalle)
    {
        $resp = false;
        $compraEstado = new  CompraEstadoTipo();
        $compraEstado->idcompraestadotipo = $idcompraestadotipo;
        $compraEstado->cetdescripcion = $cetDescripcion;
        $compraEstado->cetdetalle = $cetDetalle;
        if ($compraEstado->save()) {
            $resp = true;
        }
        return $resp;
    }
    public function eliminar_CompraEstadoTipo()
    {
        $resp = false;
        $aEliminar = $this->idcompraestadotipo;
        CompraEstadoTipo::destroy($aEliminar);
        //if (empty(CompraEstadoTipo::find($aEliminar))) {
        //    $resp = true;
        //}
        $resp = true;
        return $resp;
    }
    public static function listar($param)
    {
        $param = CompraEstadoTipo::query();
        $arreglo = $param->get();
        return $arreglo;
    }
    public function modificar()
    {
        $resp = false;
        $this->update([
            'idcompraestadotipo' => $this->idcompraestadotipo,
            'cetdescripcion' => $this->cetdescripcion,
            'cetdetalle' => $this->cetdetalle,
        ]);
        $this->save();
        $resp = true;
        return $resp;
    }
    public function setear($idcompraestadotipo, $cetDescripcion, $cetDetalle)
    {
        $this->update([
            'idcompraestadotipo' => $idcompraestadotipo,
            'cetdescripcion' => $cetDescripcion,
            'cetdetalle' => $cetDetalle,
        ]);
    }
}
