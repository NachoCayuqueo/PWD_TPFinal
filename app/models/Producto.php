<?php

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = [
        'pronombre',
        'proprecio',
        'prodetalle',
        'procantstrock',
        'espopular',
        'espronuevo',
    ];
    protected $primaryKey = 'idproducto';
    public $timestamps = false;


    public function __construct()
    {
        $this->idproducto = "";
        $this->procantstock = "";
        $this->prodetalle = null;
        $this->pronombre = "";
        $this->espopular = false;
        $this->espronuevo = false;
    }

    public function crear_e_insertarEnTabla(
        $pronomnbre,
        $proprecio,
        $prodetalle,
        $procantstock,
        $espopular,
        $espronuevo
    ) {
        $resp = false;

        $producto = new producto();
        $producto->pronomnbre = $pronomnbre;
        $producto->proprecio = $proprecio;
        $producto->prodetalle = $prodetalle;
        $producto->procantstock = $procantstock;
        $producto->espopular =    $espopular;
        $producto->espronuevo =   $espronuevo;

        $producto->save();
        $resp = true;
        return $resp;
    }
    public function eliminar_producto()
    {
        $resp = false;
        $idAEliminar = $this->idProducto;
        Producto::destroy($idAEliminar);
        $resp = true;
        return $resp;
    }
    public static function listar($param)
    {
        $param = Producto::query();
        $arreglo = $param->get();
        return $arreglo;
    }
    public function modificar()
    {
        $resp = false;
        $this->update([
            'idproducto' => $this->idproducto,
            'pronombre' => $this->usnombre,
            'proprecio' => $this->uspass,
            'prodetalle' => $this->usmail,
            'procantstock' => $this->procantstock,
            'espopular' => $this->espopular,
            'espronuevo' => $this->espronuevo,
        ]);
        $this->save();
        $resp = true;
        return $resp;
    }
    public function setear(
        $idproducto,
        $usnombre,
        $uspass,
        $usmail,
        $procantstock,
        $espopular,
        $espronuevo,
    ) {
        $this->update([
            'idproducto' => $idproducto,
            'pronombre' => $usnombre,
            'proprecio' => $uspass,
            'prodetalle' => $usmail,
            'procantstock' => $procantstock,
            'espopular' => $espopular,
            'espronuevo' => $espronuevo,
        ]);
    }
}
