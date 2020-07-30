<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Streets_x_Location;
use App\Models\Locations;
use App\Http\Requests\StreetsFormRequests;


class Streets_x_LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {

        if($request->ajax()){
            $calle = new Streets_x_Location();
            $calle->setLocalidad($request->get('localidad'));
            $result = $calle->find();
            return json_encode($result);
        }else{


            if($request->input('localidad') != 0 && $request->input('municipio')){

                $location = $request->input('localidad');
                $municipalitie = $request->input('municipio');
                $calle = new Streets_x_Location();
                $calle->setLocalidad($location);
                $result = $calle->find();

                return view('components.streets_x_location.index',['registers'=>$result,'location'=>$location,'municipalitie'=>$municipalitie]);
            }


        }

    }

    public function create(Request $request)
    {
        if($request->input('localidad') && $request->input('municipio')){
            $location = $request->input('localidad');
            $municipalitie= $request->input('municipio');
            return view('components.streets_x_location.create',['location'=>$location,'municipalitie'=>$municipalitie]);
        }

    }


    public function store(StreetsFormRequests $request)
    {
        $calle = new Streets_x_Location();
        $calle->setLocalidad($request->input('localidad'));
        $calle->setNombre($request->input('nombre'));
        $calle->setLatitud($request->input('latitud'));
        $calle->setLongitud($request->input('longitud'));

        $result = $calle->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['nombre'=>'Calle existente. Eligir otra.'])->withInput();
                        break;
                    case 1:   return  redirect()->route('calles-localidad.index',['municipio'=>$request->input('municipio'),'localidad' => $request->input('localidad')])->with('success','Calle agregada exitosamente.');;
                        break;
                }
            }
        }

    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $locations = new Locations();
        $locations->setId($id);
        $result_l = $locations->find_by_id();

        $calle = new Streets_x_Location();
        $calle->setId($id);
        $result = $calle->find_by_id();

        return view('components.streets_x_location.edit',['item'=>$result[0],'municipalitie'=>$result_l[0]->id_municipio]);
    }


    public function update(StreetsFormRequests $request, $id)
    {

        $calle = new Streets_x_Location();
        $calle->setLocalidad($request->input('localidad'));
        $calle->setNombre($request->input('nombre'));
        $calle->setLatitud($request->input('latitud'));
        $calle->setLongitud($request->input('longitud'));
        $calle->setId($id);

        $result = $calle->update();

        $locations = new Locations();
        $locations->setId($request->input('localidad'));
        $result_l = $locations->find_by_id();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['nombre'=>'Calle existente. Eligir otra.'])->withInput();
                        break;
                    case 1:   return  redirect()->route('calles-localidad.index',['municipio'=>$result_l[0]->id_municipio,'localidad' => $request->input('localidad')])->with('success','Calle actualizada exitosamente.');;
                        break;
                }
            }
        }
    }


    public function destroy($id)
    {
        $calle = new Streets_x_Location();
        $calle->setId($id);
        $location = $calle->find_by_id();
        $result = $calle->delete();

        $locations = new Locations();
        $locations->setId($location[0]->id_localidad);
        $result_l = $locations->find_by_id();



        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case 1:
                                return  redirect()->route('calles-localidad.index',['municipio'=>$result_l[0]->id_municipio,'localidad' => $location[0]->id_localidad])->with('success','Calle eliminada exitosamente.');;
                        break;
                }
            }
        }
    }
}
