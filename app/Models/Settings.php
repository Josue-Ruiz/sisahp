<?php

namespace App\Models;

use Session;
use DB;


class Settings 
{
    private $nombre;
    private $apellido_p;
    private $apellido_m;
    private $correo;
    private $usuario;
    private $contra_actual;
    private $contrasenia;
    private $imagen;
    private $id;



    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido_p()
    {
        return $this->apellido_p;
    }

    public function setApellido_p($apellido_p)
    {
        $this->apellido_p = $apellido_p;
        
    }

    public function getApellido_m()
    {
        return $this->apellido_m;
    }

    public function setApellido_m($apellido_m)
    {
        $this->apellido_m = $apellido_m;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    
    public function getContra_actual()
    {
        return $this->contra_actual;
    }

    public function setContra_actual($contra_actual)
    {
        $this->contra_actual = $contra_actual;
    }

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    

    public function update_datas(){
        $sql  = "call DA_spSIVADB_Configuracion('1','".$this->getNombre()."','".$this->getApellido_p()."','".$this->getApellido_m()."','".$this->getCorreo()."','".$this->getUsuario()."','null','".$this->getContrasenia()."','null','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function update_password(){
        $sql  = "call DA_spSIVADB_Configuracion('2','null','null','null','null','null','".$this->getContra_actual()."','".$this->getContrasenia()."','null','0','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function update_profile(){
        $sql  = "call DA_spSIVADB_Configuracion('3','null','null','null','null','null','null','null','".$this->getImagen()."','0','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
}
