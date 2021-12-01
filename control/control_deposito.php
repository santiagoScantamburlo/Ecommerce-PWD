<?php
include_once '../../configuracion.php';

class control_deposito
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


    public function verificarDeposito($descripcionPagina, $nombrePagina)
    {
        $valido = false;
        $sesion = new session();

        if (!$sesion->activa()) {
            header('Location: ../login/login.php?message=' . urlencode("Sesion no iniciada"));
            exit;
        }

        $roles = $sesion->getRoles();
        $rolTemporal = 0;
        if (count($roles) > 1) {
            $rolTemporal = $roles[1];
        }

        $abmUsuarioRol = new abmusuariorol();
        $listaUsRol = $abmUsuarioRol->buscar(['idusuario' => $sesion->getIdusuario()]);
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['menombre' => $nombrePagina]);
        if (count($listaMenu) > 0 && count($listaUsRol) > 0) {
            $objUsRol = $listaUsRol[0];
            $objMenu = $listaMenu[0];

            if ($objMenu->getIdpadre() == $objUsRol->getObjRol()->getIdrol() || $objMenu->getIdpadre() == $rolTemporal) {
                $valido = true;
            }
        }
        return $valido;
    }


    public function cancelarCompra($datos, $listaCE)
    {
        $abmCompraEstado = new abmcompraestado();
        $retorno = $this->getRetorno();
        $datos['cefechaini'] = $listaCE[0]->getCefechaini();
        $datos['idcompraestadotipo'] = 4;
        $datos['cefechafin'] = date('Y-m-d H:i:s');
        $exito = $abmCompraEstado->modificacion($datos);
        if ($exito) {
            $retorno['messageOk'] .= urlencode("Compra cancelada");
        } else {
            $retorno['messageErr'] .= urlencode("Error en la cancelacion");
        }
        return $retorno;
    }


    public function deshabilitarProducto($datos)
    {
        $retorno = $this->getRetorno();
        $abmProducto = new abmproducto();

        $lista = $abmProducto->buscar($datos);

        if (isset($lista[0])) {
            $exito = $abmProducto->deshabilitarProd($datos);
            if ($exito) {
                if ($lista[0]->getProdeshabilitado() == '0000-00-00 00:00:00') {
                    $retorno['messageOk'] .= urlencode("Producto deshabilitado correctamente");
                } else {
                    $retorno['messageOk'] .= urlencode("Producto habilitado correctamente");
                }
            } else {
                $retorno['messageErr'] .= urlencode("Error en la deshabilitación");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Producto no encontrado en la base de datos");
        }
        return $retorno;
    }


    public function modificarProducto($datos)
    {
        $retorno = $this->getRetorno();
        $datosBusqueda['idproducto'] = $datos['idproducto'];

        $abmProducto = new abmproducto();

        $lista = $abmProducto->buscar($datosBusqueda);

        if (isset($lista)) {
            $exito = $abmProducto->modificacion($datos);
            if ($exito) {
                $retorno['messageOk'] .= urlencode("Producto modificado");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la modificación");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Producto no encontrado en la base de datos");
        }
        return $retorno;
    }

    public function nuevoProducto($imagen, $datos)
    {
        $retorno = $this->getRetorno();
        $abmProducto = new abmproducto();

        $datosBusqueda['idproducto'] = $datos['idproducto'];
        $listaProductos = $abmProducto->buscar($datosBusqueda);

        if (count($listaProductos) > 0) {
            $retorno['messageErr'] .= urlencode("El ID ingresado ya existe");
        } else {
            $datos['procantventas'] = 0;
            $exito = $abmProducto->alta($datos);

            if ($exito) {
                $control_carga_imagen = new control_imagen();
                $control_carga_imagen->cargarImagen($imagen, $datos['idproducto']);
                $retorno['messageOk'] .= urlencode("Producto cargado correctamente");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la carga del producto");
            }
        }
        return $retorno;
    }
}
