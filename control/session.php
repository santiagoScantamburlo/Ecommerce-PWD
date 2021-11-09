<?php

class session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setAtributo($nombreAtributo, $valor)
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($nombreAtributo)) {
            $_SESSION[$nombreAtributo] = $valor;
        }
    }

    public function getAtributo($nombreAtributo)
    {
        $atributo = null;
        if (session_status() === PHP_SESSION_ACTIVE && is_string($nombreAtributo) && isset($_SESSION[$nombreAtributo])) {
            $atributo = $_SESSION[$nombreAtributo];
        }

        return $atributo;
    }

    public function borrarAtributo($nombreAtributo)
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($nombreAtributo) && isset($_SESSION[$nombreAtributo])) {
            unset($_SESSION[$nombreAtributo]);
        }
    }

    public function iniciarSession($datos)
    {
        $this->session_started;
        $this->setAtributo("usuario", $datos["usuario"]);
        $this->setAtributo("login", $datos["login"]);
        $this->setAtributo("rol", $datos["rol"]);
        $this->setAtributo("idusuario", $datos["idusuario"]);

        $resp = true;

        return $resp;

        /*	OPCIÓN PARA RECUPERAR $ID DE SESSION
		LA DEJO PARA TENERLA
		$id= session_id();
		$this-> setSession_id ($id);
		return $id;
		}
		public function setSession_id ($id){
			$_SESSION["key"]= $id;
		}*/
    }


    public function esAdministrador()
    {
        $resp = false;
        $roles = $_SESSION["rol"];
        foreach ($roles as $rol) {
            if ($rol == "admin") {
                $resp = true;
            }
        }
        return $resp;
    }

    public function activa()
    {
        $resp = true;
        session_status();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $resp = false;
        }
        return $resp;
    }

    public function validar()
    {
        $resp = false;
        if (isset($_SESSION["login"])) {
            $pag = $_SERVER["REQUEST_URI"];

            if ($pag == "/tpfinal/vista/listarUsuario.php" || $pag == "/tpfinal/vista/listarRoles.php" || $pag == "/tpfinal/vista/actualizarlogin.php" || $pag == "/tpfinal/vista/eliminarUsuario.php") {
                if ($this->esAdministrador() != true) {
                    header("location: http://localhost/tpfinal/vista/home/index.php");
                }
            }
            $resp = true;
        }
        return $resp;
    }

    public function cerrarSession()
    {
        session_destroy();
    }

    /*public function mostrarValorVariables()
    {
        print_object($_SESSION);
    }*/
}