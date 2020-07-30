<?php

namespace App\Models;

use Session;
use DB;


class Jurisdictions
{
    private $nombre;
    private $id;


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function all()
    {
        $sql = "call DA_spSIVADB_get_Jurisdicciones('1','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function save()
    {
        $sql = "call DA_spSIVADB_ABC_Jurisdicciones('1','".$this->getNombre()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function find()
    {
        $sql = "call DA_spSIVADB_get_Jurisdicciones('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
    public function update()
    {
        $sql = "call DA_spSIVADB_ABC_Jurisdicciones('2','".$this->getNombre()."','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function delete()
    {
        $sql = "call DA_spSIVADB_ABC_Jurisdicciones('3','null','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
}
