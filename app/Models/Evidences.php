<?php

namespace App\Models;

use Session;
use DB;

class Evidences 
{
    private $id;
    private $id_notificacion;
    private $ubicacion;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getIdNotificacion(){
        return $this->id_notificacion;
    }
    public function setIdNotificacion($id_notificacion){
        $this->id_notificacion = $id_notificacion;
    }
    public function getUbicacion(){
        return $this->ubicacion;
    }
    public function setUbicacion($ubicacion){
        $this->ubicacion = $ubicacion;
    }

    public function all(){
        $sql = "call DA_spSIVADB_get_Evidencias('1','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function find(){
        $sql = "call DA_spSIVADB_get_Evidencias('1','".$this->getId()."')";
        $result = DB::select($sql,array(1,10));
        return $result; 
    }
    public function find_by_id(){
        $sql = "call DA_spSIVADB_get_Evidencias('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,10));
        return $result; 
    }
    public function save(){
        $sql = "call DA_spSIVADB_ABC_Evidencias('1','".$this->getIdNotificacion()."','".$this->getUbicacion()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
    public function update(){
        $sql = "call DA_spSIVADB_ABC_Evidencias('2','0','".$this->getUbicacion()."','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Evidencias('3','0','null','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
}
