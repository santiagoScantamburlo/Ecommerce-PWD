<?php
include_once 'conector/BaseDatos.php';
class usuario
{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->usId = "";
        $this->usNombre = "";
        $this->usPass = "";
        $this->usMail = "";
        $this->usDeshabilitado = "";
        $this->mensajeOperacion = "";
    }

    //OBSERVADORES
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function getUsnombre()
    {
        return $this->usnombre;
    }

    public function getUspass()
    {
        return $this->uspass;
    }

    public function getUsmail()
    {
        return $this->usmail;
    }

    public function getUsdeshabilitado()
    {
        return $this->usdeshabilitado;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    //MODIFICADORES
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function setUsnombre($usnombre)
    {
        $this->usnombre = $usnombre;
    }

    public function setUspass($uspass)
    {
        $this->uspass = $uspass;
    }

    public function setUsmail($usmail)
    {
        $this->usmail = $usmail;
    }

    public function setUsdeshabilitado($usdeshabilitado)
    {
        $this->usdeshabilitado = $usdeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($idusuario, $usnombre, $uspass, $usmail, $usdeshabilitado)
    {
        $this->setIdusuario($idusuario);
        $this->setUsnombre($usnombre);
        $this->setUspass($uspass);
        $this->setUsmail($usmail);
        $this->setUsdeshabilitado($usdeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE idusuario=" . $this->getIdusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    print_r($row);
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                }
            }
        } else {
            $this->setMensajeOperacion("Usuario->cargar: " . $base->getError());
        }
        echo $resp;
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario (usnombre, uspass, usmail, usdeshabilitado) VALUES ('" . $this->getUsnombre() . "','" . $this->getUspass() . "','" . $this->getUsmail() . "','0000-00-00 00:00:00');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdusuario($elid);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Usuario->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usnombre= '" . $this->getUsnombre() . "', uspass= '" . $this->getUspass() . "', usmail= '" . $this->getUsmail() . "', usdeshabilitado= '" . $this->getUsdeshabilitado() . "' WHERE idusuario=" . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usdeshabilitado='" . $param . "' WHERE idusuario=" . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->estado: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->estado: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE idusuario=" . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Usuario->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function seleccionar($condicion = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario ";
        if ($condicion != "") {
            $sql .= 'WHERE ' . $condicion;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new usuario();
                    $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Usuario->seleccionar: " . $base->getError());
        }
        return $arreglo;
    }
}
