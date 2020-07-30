<?php

namespace App\Models;

use DB;

class Maps{

    private $fec_inicio;
    private $fec_final;
    private $cant;
    private $id;

    public function getFec_inicio()
    {
        return $this->fec_inicio;
    }

    public function setFec_inicio($fec_inicio)
    {
        $this->fec_inicio = $fec_inicio;
    }
    public function getFec_final()
    {
        return $this->fec_final;
    }
    public function setFec_final($fec_final)
    {
        $this->fec_final = $fec_final;
    }

    public function getCant()
    {
        return $this->cant;
    }

    public function setCant($cant)
    {
        $this->cant = $cant;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function get_location()
    {
        $sql = "call DA_spSIVADB_get_Localidades('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
    public function get_points_georeferenced()
    {
        $sql = "call DA_spSIVADB_get_Puntos_Georeferenciados('1','0','".$this->getFec_inicio()."','".$this->getFec_final()."','0','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_points_georeferenced_munic()
    {
        $sql = "call DA_spSIVADB_get_Puntos_Georeferenciados('4','".$this->getId()."','".$this->getFec_inicio()."','".$this->getFec_final()."','0','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_point()
    {
        $sql = "call DA_spSIVADB_get_Puntos_Georeferenciados('2','0','1997-06-20','1997-06-20','0','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function get_points()
    {
        $sql = "call DA_spSIVADB_get_Puntos_Georeferenciados('5','0','".$this->getFec_inicio()."','".$this->getFec_final()."','".$this->getCant()."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_evidences()
    {
        $sql = "call DA_spSIVADB_get_Puntos_Georeferenciados('3','0','1997-06-20','1997-06-20',0,'".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function get_points_georeferenced_vibrio()
    {
        $sql = "call DA_spSIVADB_get_Muestreo_VibrioCholerae('2','".$this->getFec_inicio()."','".$this->getFec_final()."', '".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_results_lab()
    {
        $sql = "call DA_spSIVADB_get_Analis_Muest_Bactereologicas('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;

    }



}
