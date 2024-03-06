<?php
class AbmProducto
{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */

    public function buscar($param)
    {
        $query = Producto::query();

        if ($param !== null) {
            if (isset($param['idproducto'])) {
                $query->where('idproducto', '=', $param['idproducto']);
            }
            if (isset($param['pronombre'])) {
                $query->where('pronombre', '=', $param['pronombre']);
            }
            if (isset($param['prodetalle'])) {
                $query->where('prodetalle', '=', $param['prodetalle']);
            }
            if (isset($param['procantstock'])) {
                $query->where('procantstock', '=', $param['procantstock']);
            }
        }

        $arreglo = Producto::listar($query);

        return $arreglo;
    }
}
