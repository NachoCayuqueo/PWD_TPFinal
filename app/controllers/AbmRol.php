<?php
class AbmRol
{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = [];
        if ($param !== NULL) {
            if (isset($param['idRol']))
                $where[] = " idRol = '" . $param['idRol'] . "'";
            if (isset($param['roDescripcion']))
                $where[] = " rodescripcion = '" . $param['roDescripcion'] . "'";
        }
        $whereClause = implode(" AND ", $where);
        $objetoUsuarioRol = new Rol();
        $arreglo = $objetoUsuarioRol->listar($whereClause);
        return $arreglo;
    }
}
