<?php

namespace App\Models;

use Session;
use DB;

class Users
{
    private $rol;
    private $jurisdiccion;
    private $municipio;
    private $nombre;
    private $apellido_p;
    private $apellido_m;
    private $correo;
    private $usuario;
    private $contrasenia;
    private $id;


    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    public function getJurisdiccion()
    {
        return $this->jurisdiccion;
    }

    public function setJurisdiccion($jurisdiccion)
    {
        $this->jurisdiccion = $jurisdiccion;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

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

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function all(){
        $sql = "call DA_spSIVADB_get_Usuarios('1','0')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }

    public function save(){
        $sql  = "call DA_spSIVADB_ABC_Usuarios('1','".$this->getRol()."','".$this->getJurisdiccion()."','".$this->getMunicipio()."','".$this->getNombre()."','".$this->getApellido_p()."','".$this->getApellido_m()."','".$this->getCorreo()."','".$this->getUsuario()."','".$this->getContrasenia()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function find(){
        $sql = "call DA_spSIVADB_get_Usuarios('2','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }

    public function update(){
        $sql  = "call DA_spSIVADB_ABC_Usuarios('2','".$this->getRol()."','".$this->getJurisdiccion()."','".$this->getMunicipio()."','".$this->getNombre()."','".$this->getApellido_p()."','".$this->getApellido_m()."','".$this->getCorreo()."','".$this->getUsuario()."','".$this->getContrasenia()."','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function delete(){
        $sql  = "call DA_spSIVADB_ABC_Usuarios('3','0','0','0','null','null','null','null','null','null','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
}
