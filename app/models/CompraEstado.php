<?php

use Illuminate\Database\Eloquent\Model;

class CompraEstado extends Model
{
    private $idCompraEstado;
    private $cefechaini;
    private $cefechaifin;
    private $objetoCompra;
    private $objetoCompraEstadoTipo;
    private $mensajeOperacion;


    protected $table = 'compraestado';
    protected $filliable = [
        'idcompra',
        'idcompraestadotipo',
        'cefechaini',
        'cefechafin',
    ];
    protected $primaryKey = 'idcompraestado';


    public function __construct()
    {
        $this->idCompraEstado = '';
        $this->cefechaini = '';
        $this->cefechaifin = '';
        $this->objetoCompra = '';
        $this->objetoCompraEstadoTipo = '';
        $this->mensajeOperacion = '';
    }
    public function setear(
        $idCompraEstado,
        $cefechaini,
        $cefechaifin,
        $objetoCompra,
        $objetoCompraEstadoTipo,
        $mensajeOperacion
    ) {
        $this->update([
            'idcompraestado' => $idCompraEstado,
            'idcompra' => $objetoCompra->getId(),
            'idcompraestadotipo' => $objetoCompraEstadoTipo->getId(),
            'cefechaini' => $cefechaini,
            'cefechafin' => $cefechaifin,
            'mensajeOdoperacion' => $mensajeOperacion
        ]);
    }

    public function eliminar_compraEstado()
    {
        $resp = false;
        $compraAEliminar = $this->idCompraEstado;
        CompraEstado::destroy($compraAEliminar);
        $resp = true;
        return $resp;
    }

    public static function listar($param)
    {
        $param = CompraEstado::query();
        $arreglo = $param->get();
        return $arreglo;
    }

    // public function modificar()
    // {
    //     $resp = false;
    //     $this->update([
    //         $this->update([
    //             'idcompraestado' => $this->idCompraEstado,
    //             'idcompra' => $objetoCompra->getId(),
    //             'idcompraestadotipo' => $objetoCompraEstadoTipo->getId(),
    //             'cefechaini' => $this->cefechaini,
    //             'cefechafin' => $this->cefechaifin,
    //             'mensajeOdoperacion' => $this->$mensajeOperacion
    //         ]);
    //     ]);
    // }
}
