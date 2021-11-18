<?php
include_once 'conector/BaseDatos.php';
class menu
{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idmenu = "";
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = "";
        $this->medeshabilitado = "";
        $this->mensajeOperacion = "";
    }

    //OBSERVADORES
    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function getMenombre()
    {
        return $this->menombre;
    }

    public function getMedescripcion()
    {
        return $this->medescripcion;
    }

    public function getIdpadre()
    {
        return $this->idpadre;
    }

    public function getMedeshabilitado()
    {
        return $this->medeshabilitado;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    //MODIFICADORES
    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
    }

    public function seMenombre($menombre)
    {
        $this->menombre = $menombre;
    }

    public function setMedescripcion($medescripcion)
    {
        $this->medescripcion = $medescripcion;
    }

    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;
    }

    public function setMedeshabilitado($medeshabilitado)
    {
        $this->medeshabilitado = $medeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado)
    {
        $this->setIdmenu($idmenu);
        $this->seMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    // print_r($row);
                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                }
            }
        } else {
            $this->setMensajeOperacion("Menu->cargar: " . $base->getError());
        }
        echo $resp;
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menu (menombre, medescripcion, idpadre, medeshabilitado) VALUES ('" . $this->getMenombre() . "','" . $this->getMedescripcion() . "'," . $this->getIdpadre() . ",'0000-00-00 00:00:00');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdmenu($elid);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menu->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menu->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menu SET menombre= '" . $this->getMenombre() . "', medescripcion= '" . $this->getMedescripcion() . "', idpadre= " . $this->getIdpadre() . ", medeshabilitado= '" . $this->getMedeshabilitado() . "' WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menu SET medeshabilitado='" . $param . "' WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->estado: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->estado: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menu WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menu->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menu->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    // print_r($row);
                    $obj = new menu();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Menu->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
