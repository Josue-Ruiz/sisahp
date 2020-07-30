<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocationsFormRequest;
use App\Models\Municipalities;
use App\Models\Locations;


class LocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $municipalitie = $request->get('municipio');
            $locations = new Locations();
            $locations->setId($municipalitie);
            $result = $locations->find();

            return json_encode($result);
        }else{
            $municipalitie = 0;
            $result_l = array();
            $muni = new Municipalities();
            $result = $muni->all();

            if($request->input('municipio') != 0){
                $municipalitie = $request->input('municipio');

                $locations = new Locations();
                $locations->setId($municipalitie);
                $result_l = $locations->find();
            }

            return view('components.locations.index',['municipalities'=>$result,'municipio'=>$municipalitie,'locations'=>$result_l]);
        }


    }


    public function create()
    {
        $muni = new Municipalities();
        $result = $muni->all();

        return view('components.locations.create',['municipalities'=>$result]);
    }

    public function store(LocationsFormRequest $request)
    {
        $location = new Locations();
        $location->setNombre($request->input('nombre'));
        $location->setMunicipio($request->input('municipio'));
        $location->setClave($request->input('clave'));
        $location->setPob_total($request->input('pob_total'));
        $location->setLatitud($request->input('latitud'));
        $location->setLongitud($request->input('longitud'));

        $result = $location->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de la Localidad en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('localidades.index')->with('success','Localidad agregada exitosamente.');
                        break;
                }
            }
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $locations = new Locations();
        $locations->setId($id);
        $result = $locations->find_by_id();

        $muni = new Municipalities();
        $result_m = $muni->all();


        return view('components.locations.edit',['municipalities'=>$result_m,'item'=>$result[0]]);
    }


    public function update(LocationsFormRequest $request, $id)
    {
        $location = new Locations();
        $location->setNombre($request->input('nombre'));
        $location->setMunicipio($request->input('municipio'));
        $location->setClave($request->input('clave'));
        $location->setPob_total($request->input('pob_total'));
        $location->setLatitud($request->input('latitud'));
        $location->setLongitud($request->input('longitud'));
        $location->setId($id);

        $result = $location->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de la Localidad en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('localidades.index',['municipio'=>$request->input('municipio')])->with('success','Localidad actualizada exitosamente.');
                        break;
                }
            }
        }
    }


    public function destroy($id)
    {
        $location = new Locations();
        $location->setId($id);
        $result = $location->delete();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de la Localidad en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('localidades.index')->with('success','Localidad eliminada exitosamente.');
                        break;
                }
            }
        }
    }
}
