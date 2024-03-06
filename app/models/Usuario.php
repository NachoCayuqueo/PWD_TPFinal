<?php



use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = [
        'idusuario',
        'usnombre',
        'uspass',
        'usmail',
        'usActive',
    ];
    protected $primaryKey =  'idusuario';
    public $timestamps = false; //lo desactivo sino tengo q poner los timestamp
    //protected $primaryKey = 'idusuario';

    public function crear_e_insertarEnTabla($usNombre, $usPass, $usMail)
    {
        $resp = false;
        $usDeshabilitado = $this->usdeshabilitado;
        if ($usDeshabilitado === null) {
            $usuario = new Usuario();
            $usuario->usnombre = $usNombre;
            $usuario->uspass = $usPass;
            $usuario->usmail = $usMail;
            $usuario->usdeshabilitado = $usDeshabilitado;
        } else {
            $usuario = new Usuario();
            $usuario->usnombre = $usNombre;
            $usuario->uspass = $usPass;
            $usuario->usmail = $usMail;
        }
        $usuario->save();
        $resp = true;
        return $resp;
    }

    public function eliminar_usuario()
    {
        $resp = false;
        $idAEliminar = $this->idusuario;
        Usuario::destroy($idAEliminar);
        $resp = true;
        return $resp;
    }
    public function deshabilitar()
    {
        $resp = false;
        $newDate = date('Y-m-d H:i:s');
        $this->update([
            'udDeshabilitado' => $newDate
        ]);
        $resp = true;
        return $resp;
    }
    public static function listar()
    {
        $usuarios = Usuario::get()->toArray();
        return $usuarios;
    }
    public function modificar()
    {
        $resp = false;
        $usDeshabilitado = $this->getUsDeshabilitado();

        if ($usDeshabilitado !== 'null') {
            $this->update([
                'usnombre' => $this->usnombre,
                'uspass' => $this->uspass,
                'usmail' => $this->usmail,
                'usdeshabilitado' => $usDeshabilitado
            ]);
            $this->save();
        } else {
            $this->update([
                'usnombre' => $this->usnombre,
                'uspass' => $this->uspass,
                'usmail' => $this->usmail,
                'usdeshabilitado' => $usDeshabilitado
            ]);
            $this->save();
        }
        return $resp;
    }
}
