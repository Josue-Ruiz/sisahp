<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurisdictions;
use App\Models\Municipalities;
use App\Models\Munic_x_Judid;


class Munici_x_JurisdController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $jurisdiction = $request->get('jurisdiccion');
            $municipalities = new Munic_x_Judid();
            $municipalities->setId($jurisdiction);
            $result = $municipalities->find();

            return json_encode($result);
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request,['municipios'=> ['required']]);

        $juridiccion = $request->input('juridiccion');
        $valores_municipios = "";
        $cantidad = count($request->input('municipios'));

        for($i=0;$i<$cantidad;$i++)
        {
            if($i == $cantidad-1){
                $valores_municipios.=  $request->input('municipios')[$i];
            }else{
                $valores_municipios.=  $request->input('municipios')[$i] .'|';
            }
        }

        $munic_x_jurid = new Munic_x_Judid();
        $munic_x_jurid->setMunicipios($valores_municipios);
        $munic_x_jurid->setJuridiccion($juridiccion);
        $result = $munic_x_jurid->save();

        if(!empty($result)){
            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['clave'=>'Clave de Municipio en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('jurisdicciones.index')->with('success','Municipio asignado exitosamente.');
                        break;
                }
            }
        }
    }


    public function show($id)
    {
        $munic= new Municipalities();
        $result1 = $munic->all();

        $jurid = new Jurisdictions();
        $jurid->setId($id);
        $result = $jurid->find();

        return view('components.munici_x_jurisd.create',['municipalities'=>$result1,'item'=>$result[0]]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
