<?php
include_once 'conector/BaseDatos.php';

class rol
{
    private $idrol;
    private $rodescripcion;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idrol = "";
        $this->rodescripcion = "";
        $this->mensajeOperacion = "";
    }
    
    // Getters
    public function getIdrol()
    {
        return $this->idrol;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
    public function getRodescripcion()
    {
        return $this->rodescripcion;
    }
    
    // Setters
    public function setIdrol($idrol)
    {
        $this->idrol = $idrol;
    }
    public function setRodescripcion($rodescripcion)
    {
        $this->rodescripcion = $rodescripcion;
    }
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($idrol, $rodescripcion)
    {
        $this->setIdrol($idrol);
        $this->setRodescripcion($rodescripcion);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM 'rol' WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear(
                        $row['idrol'],
                        $row['rodescripcion'],
                    );
                }
            }
        } else {
            $this->setMensajeOperacion("Tabla->listar: " . $base->getError());
        }
        
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET rodescripcion = '{$this->getRodescripcion()}' WHERE idrol = '" . $this->getIdrol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->modificar: " . $base->getError());
        }
        
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM 'rol' WHERE idrol = '" . $this->getIdrol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Rol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->eliminar: " . $base->getError());
        }
        
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objRol = new rol();
                    $objRol->setear(
                        $row['idrol'],
                        $row['rodescripcion'],
                    );
                    array_push($arreglo, $objRol);
                }
            }
        } else {
            $this->setMensajeOperacion("Tabla->listar: " . $base->getError());
        }
        
        return $arreglo;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol (rodescripcion) VALUES('" . $this->getRodescripcion() . "')";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdrol($elid);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->insertar: " . $base->getError());
        }
        
        return $resp;
    }
}