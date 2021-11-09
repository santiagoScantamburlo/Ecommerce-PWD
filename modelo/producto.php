<?php

class Producto
{
    private $idproducto;
    private $proprecio;
    private $prodescuento;
    private $pronombre;
    private $prodetalle;
    private $procantventas;
    private $procantstock;
    private $prodeshabilitado;
    private $mensajeOperacion;


    public function __construct()
    {

        $this->idproducto = "";
        $this->proprecio = "";
        $this->prodescuento = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantventas = "";
        $this->procantstock = "";
        $this->prodeshabilitado = "";
        $this->mensajeOperacion = "";
    }

    // Getters
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function getProprecio()
    {
        return $this->proprecio;
    }

    public function getProdescuento()
    {
        return $this->prodescuento;
    }

    public function getPronombre()
    {
        return $this->pronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }

    public function getProcantventas()
    {
        return $this->procantventas;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }

    public function getProdeshabilitado()
    {
        return $this->prodeshabilitado;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    // Setters
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function setProprecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function setProdescuento($prodescuento)
    {
        $this->prodescuento = $prodescuento;
    }

    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }

    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }

    public function setProcantventas($procantventas)
    {
        $this->procantventas = $procantventas;
    }

    public function setProstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function setProDeshabilitado($prodeshabilitado)
    {
        $this->$prodeshabilitado = $prodeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($idproducto, $proprecio, $prodescuento, $pronombre, $prodetalle, $procantventas, $procantstock, $prodeshabilitado)
    {
        $this->setIdproducto($idproducto);
        $this->setProprecio($proprecio);
        $this->setProdescuento($prodescuento);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantventas($procantventas);
        $this->setProstock($procantstock);
        $this->setProDeshabilitado($prodeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdproducto();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['procantventas'], $row['procantstock'], $row['prodeshabilitado']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO producto (idproducto, proprecio, prodescuento, pronombre, prodetalle, procanventas, procantstock, prodeshabilitado) VALUES ('" . $this->getIdproducto() . "'," . $this->getProprecio() . "," . $this->getProdescuento() . ",'" . $this->getPronombre() . "','" . $this->getProdetalle() . "'," . $this->getProcantventas() . "," . $this->getProcantstock() . ", '0000-00-00 00:00:00')";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdproducto($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET idproducto='" . $this->getIdproducto() . "', proprecio=" . $this->getProprecio() . ", prodescuento=" . $this->getProdescuento() . ", pronombre='" . $this->getPronombre() . "', prodetalle='" . $this->getProdetalle() . "', procantventas=" . $this->getProcantventas() . ", procantstock=" . $this->getProcantstock() . ", prodeshabilitado='0000-00-00 00:00:00' WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    // print_r($row);
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['proingreso'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['procantventas'], $row['procantstock'], $row['prodeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $arreglo;
    }

    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET prodeshabilitado= '" . $param . "' WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->estado: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->estado: " . $base->getError());
        }
        return $resp;
    }
}
