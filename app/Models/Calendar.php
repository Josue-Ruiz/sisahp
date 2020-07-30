<?php

namespace App\Models;

use Session;
use DB;

class Calendar 
{
    private $id;
    private $asunto;
    private $fec_inicio;
    private $fec_final;
    private $usuins;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

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
    public function getUsuins()
    {
        return $this->usuins;
    }

    public function setUsuins($usuins)
    {
        $this->usuins = $usuins;
        return $this;
    }

    public function setFec_final($fec_final)
    {
        $this->fec_final = $fec_final;
    }

    public function all(){
        $sql = "call DA_spSIVADB_get_Calendario('1','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function save(){
        $sql = "call DA_spSIVADB_ABC_Calendario('1','".$this->getAsunto()."','".$this->getFec_inicio()."','".$this->getFec_final()."','".$this->getUsuins()."','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function update(){
        $sql = "call DA_spSIVADB_ABC_Calendario('2','".$this->getAsunto()."','".$this->getFec_inicio()."','".$this->getFec_final()."','".$this->getUsuins()."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Calendario('3','null','2019-01-01','2019-01-01','".$this->getUsuins()."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }
}
