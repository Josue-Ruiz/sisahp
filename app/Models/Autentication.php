<?php

namespace App\Models;

use DB;

class Autentication
{

    private $correo;
    private $usuario;
    private $password;
    private $token;
    private $tipo;
    private $rol;


    private function getUsuario()
    {
        return $this->usuario;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    private function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $this->password = $password;

    }

    private function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        return $this->tipo = $tipo;
    }

    private function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        return $this->correo = $correo;
    }

    private function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        return $this->token = $token;
    }

    private function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        return $this->rol = $rol;
    }

    public function auth()
    {
        $tipo = filter_var($this->usuario,FILTER_VALIDATE_EMAIL) ? 1 : 2;
        $sql = "call DA_spSIVADB_Autenticacion('1','".$tipo."','".$this->getUsuario()."','".$this->getPassword()."','null')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }

    public function verify_email()
    {
        $sql = "call DA_spSIVADB_Autenticacion('2','0','".$this->getCorreo()."','null','".$this->getToken()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }

    public function update_password()
    {
        $sql = "call DA_spSIVADB_Autenticacion('3','0','null','".$this->getPassword()."','".$this->getToken()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function get_modules()
    {
        $sql = "call DA_spSIVADB_get_Modulos('1','".$this->getRol()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
}
