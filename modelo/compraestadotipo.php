<?php

class compraestadotipo
{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idcompraestadotipo = "";
        $this->cetdescripcion = "";
        $this->cetdetalle = "";
        $this->mensajeoperacion = "";
    }
    
    // Getters
    public function getIdcompraestadotipo()
    {
        return $this->idcompraestadotipo;
    }
    
    public function getCetdescripcion()
    {
        return $this->cetdescripcion;
    }
    
    public function getCetdetalle()
    {
        return $this->cetdetalle;
    }
    
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    
    // Setters
    public function setIdcompraestadotipo($idcompraestadotipo)
    {
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function setCetdescripcion($cetdescripcion)
    {
        $this->cetdescripcion = $cetdescripcion;
    }

    public function setCetdetalle($cetdetalle)
    {
        $this->cetdetalle = $cetdetalle;
    }

    public function setMensajeOperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }

    // Metodos
    public function setear($idcompraestadotipo, $cetdescripcion, $cetdetalle)
    {
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstadoTipo->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraestadotipo (cetdescripcion, cetdetalle) VALUES ('" . $this->getCetdescripcion() . "','" . $this->getCetdetalle() . "');";
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdcompraestadotipo($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstadoTipo->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstadoTipo->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraestadotipo SET idcompraestadotipo='" . $this->getIdcompraestadotipo() . "', cetdescripcion='" . $this->getCetdescripcion() . "', cetdetalle='" . $this->getCetdetalle() . "' WHERE idcompraestadotipo='" . $this->getIdcompraestadotipo() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraEstadoTipo->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstadoTipo->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraestadotipo WHERE idcompraestadotipo=" . $this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("CompraEstadoTipo->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraEstadoTipo->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestadotipo ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new compraestadotipo();
                    $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("CompraEstadoTipo->listar: " . $base->getError());
        }
        return $arreglo;
    }
}