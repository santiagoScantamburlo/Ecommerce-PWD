<?php
include_once '../configuracion.php';

class control_usuario
{
    public function login($datos)
    {
        $retorno = ['messageErr' => "?messageErr=", 'messageOk' => "?messageOk="];
        $sesion = new session();
        $abmUsuario = new abmusuario();
        $lista = $abmUsuario->buscar($datos);

        if (count($lista) > 0) {
            if ($lista[0]->getUsdeshabilitado() == '0000-00-00 00:00:00') {
                $sesion->iniciar($datos['usnombre'], $datos['uspass']);
                list($inicioSesion, $error) = $sesion->validar();
                if (!$inicioSesion) {
                    $sesion->cerrarSession();
                    $retorno['messageErr'] . urlencode("Error en el inicio de sesión");
                } else {
                    $retorno['messageOk'] .= urlencode("Sesión iniciada");
                }
            } else {
                $retorno['messageErr'] .= urlencode("Usuario deshabilitado");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Usuario y/o contraseña incorrectos");
        }
        return $retorno;
    }
}
