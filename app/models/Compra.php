<?php

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';
    public $timestamps = false;
    protected $fillable = [
        'idcompra',
        'cofecha',
        'idusuario',
    ];
    protected $primaryKey = 'idcompra';



    public function __construct()
    {
        $this->cofecha = '';
        $this->idCompra = '';
        $this->objetoUsuario = '';
    }

    public function setear($idCompra, $cofecha, $idUsuario)
    {
        $this->update([
            'idcompra' => $idCompra,
            'cofecha' => $cofecha,
            'idusuario' => $idUsuario
        ]);
    }
    public function crear_e_insertarEnTabla($idCompra, $idUsuario, $cofecha)
    {
        $resp = false;
        $compra = new Compra();
        $compra->setear($idCompra, $idUsuario, $cofecha);
        $compra->save();
        $resp = true;
        return  $resp;
    }
    public function modificar()
    {
        $resp = false;
        $this->update([
            'idcompra' =>   $this->idCompra,
            'cofecha' =>    $this->cofecha,
            'idusuario' =>  $this->idUsuario
        ]);
        $this->save();
        $resp = true;
        return $resp;
    }
    public static function listar($param)
    {
        $param = Compra::query();
        $arreglo = $param->get();
        return $arreglo;
    }
    public function eliminar_producto()
    {
        $resp = false;
        $compraAEliminar = $this->idCompra;
        Compra::destroy($compraAEliminar);
        $resp = true;
        return $resp;
    }
}
