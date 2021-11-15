<?php
include_once 'conector/BaseDatos.php';
class usuariorol
{
    private $objUsuario;
    private $objRol;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->objUsuario = null;
        $this->objRol = null;
    }

    //OBSERVADORES
    public function getObjUsuario()
    {
        return $this->objUsuario;
    }

    public function getObjRol()
    {
        return $this->objRol;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    //MODIFICADORES
    public function setObjUsuario($objUsuario)
    {
        $this->objUsuario = $objUsuario;
    }

    public function setObjRol($objRol)
    {
        $this->objRol = $objRol;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($usuario, $rol)
    {
        $this->setObjUsuario($usuario);
        $this->setObjRol($rol);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idUsuario = $this->getObjUsuario()->getIdusuario();
        $idRol = $this->getObjRol()->getIdrol();
        $sql = "SELECT * FROM usuariorol WHERE idusuario= " . $idUsuario . " AND idrol= " . $idRol;

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $objRol = null;
                    $objUsuario = null;
                    $row = $base->Registro();

                    if ($row['idrol'] != null) {
                        $objRol = new rol();
                        $objRol->setIdrol($row['idrol']);
                        $objRol->cargar();
                    }

                    if ($row['idusuario'] != null) {

                        $objUsuario = new usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $this->setear($objUsuario, $objRol);
                }
            }
        } else {
            $this->setMensajeOperacion("UsuarioRol->cargar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objUsuario = $this->getObjUsuario();
        $objRol = $this->getObjRol();
        $idUsuario = $objUsuario->getIdusuario();
        $idRol = $objRol->getIdrol();
        $sql = "INSERT INTO usuariorol(idusuario,idrol)  VALUES(" . $idUsuario . "," . $idRol . ")";
        echo $sql;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsRolacion->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsRolacion->insertar: " . $base->getError());
        }

        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idUsuario = $this->getObjUsuario()->getIdusuario();
        $idRol = $this->getObjRol()->getIdrol();
        $sql = " UPDATE usuariorol SET ";
        $sql .= " idrol = " . $idRol;
        $sql .= " WHERE idusuario =" . $idUsuario;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("UsRolacion->modificar 1: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("UsRolacion->modificar 2: " . $base->getError());
        }

        return $resp;
    }


    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario=" . $this->getObjUsuario()->getIdusuario() . " and idrol= " . $this->getObjRol()->getIdrol();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("UsRolacion->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("UsRolacion->eliminar: " . $base->getError());
        }

        return $resp;
    }



    public static function listar($condicion = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol ";
        if ($condicion != "") {
            $sql .= 'WHERE ' . $condicion;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objUsRol = new usuariorol();
                    $abmUs = new abmusuario();
                    $arrayUs = $abmUs->buscar(['idusuario' => $row['idusuario']]);
                    $abmRol = new abmrol();
                    $objRol = $abmRol->buscar(['idrol' => $row['idrol']]);
                    $objUsRol->setear($arrayUs[0], $objRol);
                    array_push($arreglo, $objUsRol);
                }
            }
        } else {
            $this->setMensajeOperacion("UsRol->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
