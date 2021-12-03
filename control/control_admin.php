<?php
include_once '../../configuracion.php';

class control_admin
{
    private $retorno;

    public function __construct()
    {
        $this->retorno = ['messageErr' => "?messageErr=", 'messageOk' => "?messageOk="];
    }

    public function getRetorno()
    {
        return $this->retorno;
    }

    public function verificarAdmin($pagina)
    {
        $valido = true;
        $sesion = new session();
        if (!$sesion->activa()) {
            header('Location: ../login/login.php?message=' . urlencode("Sesion no iniciada"));
            exit;
        }

        $abmUsuarioRol = new abmusuariorol();
        $listaUsRol = $abmUsuarioRol->buscar(['idusuario' => $sesion->getIdusuario()]);
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['medescripcion' => $pagina]);
        $objUsRol = $listaUsRol[0];
        $objMenu = $listaMenu[0];

        if ($objMenu->getIdpadre() != $objUsRol->getObjRol()->getIdrol()) {
            $valido = false;
        }
        return $valido;
    }

    public function cambioRol($datos, $sesion)
    {
        $retorno = [];
        $roles = $sesion->getRoles();
        $rolesSesion = array($roles[0]);
        switch ($datos['rol']) {
            case md5(1):
                if ($rolesSesion[0] != 1) {
                    $rolesSesion[1] = 1;
                    $sesion->setRoles($rolesSesion);
                } else {
                    $rolesSesion = array($roles[0]);
                    $sesion->setRoles($rolesSesion);
                }
                break;
            case md5(2):
                if ($rolesSesion[0] != 2) {
                    $rolesSesion[1] = 2;
                    $sesion->setRoles($rolesSesion);
                } else {
                    $rolesSesion = array($roles[0]);
                    $sesion->setRoles($rolesSesion);
                }
                break;
            case md5(3):
                if ($rolesSesion[0] != 3) {
                    $rolesSesion[1] = 3;
                    $sesion->setRoles($rolesSesion);
                } else {
                    $rolesSesion = array($roles[0]);
                    $sesion->setRoles($rolesSesion);
                }
                break;
        }
        $retorno = $this->getRetorno();
        $retorno['messageOk'] .= urlencode("Rol modificado");
        return $retorno;
    }

    public function configuracion($datos)
    {
        $abmUsuario = new abmusuario();
        $retorno = $this->getRetorno();
        $exitoModificacionUsuario = $abmUsuario->modificacion($datos);
        $abmUsuarioRol = new abmusuariorol();
        $exitoModificacionUsuarioRol = $abmUsuarioRol->modificacion($datos);
        if ($exitoModificacionUsuario || $exitoModificacionUsuarioRol) {
            $retorno['messageOk'] .= urlencode("Usuario modificado correctamente");
        } else {
            $retorno['messageErr'] .= urlencode("Error en la modificación");
        }
        return $retorno;
    }

    public function deshabilitarMenu($datos)
    {
        $retorno = $this->getRetorno();
        $abmMenu = new abmmenu();

        $arrayBusqueda = ["idmenu" => $datos['idmenu']];

        $listaMenu = $abmMenu->buscar($arrayBusqueda);

        $menuDeshabilitado = $abmMenu->deshabilitarMenu($arrayBusqueda);

        if ($menuDeshabilitado) {
            if ($listaMenu[0]->getMedeshabilitado() == '0000-00-00 00:00:00') {
                $retorno['messageOk'] .= urlencode("Menú deshabilitado exitosamente");
            } else {
                $retorno['messageOk'] .= urlencode("Menú habilitado exitosamente");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Error al deshabilitar el menu");
        }
        return $retorno;
    }

    public function eliminarUsuario($datos)
    {
        $retorno = $this->getRetorno();
        $sesion = new session();
        $abmUsuario = new abmusuario();
        $lista = $abmUsuario->buscar($datos);
        $idUsuario = $sesion->getIdusuario();

        if (isset($lista)) {
            if ($lista[0]->getIdusuario() == $idUsuario) {
                $retorno['messageErr'] .= urlencode("No se puede eliminar a si mismo");
            } else {
                $exito = $abmUsuario->baja($datos);
                if ($exito) {
                    $retorno['messageOk'] .= urlencode("Usuario eliminado");
                } else {
                    $retorno['messageErr'] .= urlencode("Error en la eliminación");
                }
            }
        } else {
            $retorno['messageErr'] .= urlencode("Usuario no encontrado en la base de datos");
        }
        return $retorno;
    }

    public function modificarMenu($datos)
    {
        $retorno = $this->getRetorno();
        $abmMenu = new abmmenu();

        $modificado = $abmMenu->modificacion($datos);

        if ($modificado) {
            $retorno['messageOk'] .= urlencode("Menu modificado");
        } else {
            $retorno['messageErr'] .= urlencode("Error al modificar menu");
        }
        return $retorno;
    }


    public function deshabilitarUsuario($datos, $idUsuario)
    {
        $retorno = ['exito' => "", 'error' => "", 'fecha' => ""];
        $abmUsuario = new abmusuario();

        $lista = $abmUsuario->buscar($datos);

        if (isset($lista[0])) {
            if ($lista[0]->getIdusuario() == $idUsuario) { //Verifico que el usuario a deshabilitar sea diferente al usuario de la sesion actual
                $retorno['error'] = "ERROR";
            } else {
                $exito = $abmUsuario->deshabilitarUsuario($datos);
                ($exito) ? $retorno['exito'] = "EXITO" : $retorno['error'] = "ERROR";
                $lista = $abmUsuario->buscar($datos);
                $fecha = $lista[0]->getUsdeshabilitado();
                $retorno['fecha'] = $fecha;
            }
        } else {
            $retorno['error'] = "ERROR";
        }
        return $retorno;
    }


    public function modificarUsuario($datos)
    {
        $retorno = $this->getRetorno();
        $datosBusqueda['idusuario'] = $datos['idusuario'];

        $abmUsuario = new abmUsuario();

        $lista = $abmUsuario->buscar($datosBusqueda);

        if (count($lista) > 0) {
            $exitoModificacionUsuario = $abmUsuario->modificacion($datos);
            $abmUsuarioRol = new abmusuariorol();
            $exitoModificacionUsuarioRol = $abmUsuarioRol->modificacion($datos);
            if ($exitoModificacionUsuario || $exitoModificacionUsuarioRol) {
                $retorno['messageOk'] .= urlencode("Usuario modificado correctamente");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la modificación");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Usuario no encontrado en la base de datos");
        }
        return $retorno;
    }

    public function nuevoMenu($datos)
    {
        $retorno = $this->getRetorno();
        $abmMenu = new abmmenu();
        $datosBusqueda['menombre'] = $datos['menombre'];

        $lista = $abmMenu->buscar($datosBusqueda);

        if (count($lista) == 0) {
            $exito = false;
            $datosBusqueda = $datos;
            $exitoAltaMenu = $abmMenu->alta($datosBusqueda);
            if ($exitoAltaMenu) {
                $lista = $abmMenu->buscar($datosBusqueda);
                $datos['idmenu'] = $lista[0]->getIdmenu();
                $abmMenuRol = new abmmenurol();
                $datos['idrol'] = $datos['idpadre'];
                $exito = $abmMenuRol->alta($datos);
            }
            if ($exito) {
                $retorno['messageOk'] .= urlencode("Menu cargado correctamente");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la carga");
            }
        } else {
            $retorno['messageErr'] .= urlencode("El nombre de menu ya existe");
        }
        return $retorno;
    }


    public function nuevoUsuario($datos)
    {
        $retorno = $this->getRetorno();
        $abmUsuario = new abmusuario();
        $datosBusqueda['usnombre'] = $datos['usnombre'];

        $lista = $abmUsuario->buscar($datosBusqueda);

        if (count($lista) == 0) {
            $exito = false;
            $exitoAltaUsuario = $abmUsuario->alta($datos);
            if ($exitoAltaUsuario) {
                $lista = $abmUsuario->buscar($datos);
                $datos['idusuario'] = $lista[0]->getIdusuario();
                $abmUsuarioRol = new abmusuariorol();
                $exito = $abmUsuarioRol->alta($datos);
            }
            if ($exito) {
                $retorno['messageOk'] .= urlencode("Usuario cargado correctamente");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la carga");
            }
        } else {
            $retorno['messageErr'] .= urlencode("El nombre de usuario ya existe");
        }
        return $retorno;
    }
}
