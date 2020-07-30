<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResidualChlorineFormRequest;
use App\Models\Municipalities;
use App\Models\ResidualChlorine;
use App\Models\Locations;
use App\Models\Streets_x_Location;




class ResidualChlorineController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        $notification = new ResidualChlorine();
        $result = $notification->all();

        return view('components.residual_chlorine.index',['registers'=>$result]);
    }


    public function create()
    {
        $munic = new Municipalities();
        $result = $munic->all();
        return view('components.residual_chlorine.create',['municipalities'=>$result]);
    }


    public function store(ResidualChlorineFormRequest $request)
    {
        if($request->ajax()){
            $fecha =  $request->get('fecha');
            $format =  date('Y-m-d H:i:s', strtotime($fecha));

            $notification = new ResidualChlorine();
            $notification->setMunicipio($request->get('municipio'));
            $notification->setLocalidad($request->get('localidad'));
            $notification->setCalle($request->get('calle'));
            $notification->setFecha($format);
            $notification->setValor($request->get('valor'));
            $notification->setSin_servicio($request->get('ss'));
            $notification->setCausas($request->get('causas'));
            $notification->setAcciones($request->get('acciones'));
            $notification->setMuestras($request->get('analisis'));

            $result = $notification->save();
            return $result;
        }else{
            $fecha =  $request->input('fecha');
            $format =  date('Y-m-d H:i:s', strtotime($fecha));

            $notification = new ResidualChlorine();
            $notification->setMunicipio($request->input('municipio'));
            $notification->setLocalidad($request->input('localidad'));
            $notification->setCalle($request->input('calle'));
            $notification->setFecha($format);
            $notification->setValor($request->input('valor'));
            $notification->setSin_servicio($request->input('ss'));
            $notification->setCausas($request->input('causas'));
            $notification->setAcciones($request->input('acciones'));
            $notification->setMuestras($request->input('analisis'));

            $result = $notification->save();

            if (!empty($result)) {

                if(isset($result[0]->Result)){
                    switch($result[0]->Result){
                        case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                            break;
                        case 1:    return redirect()->route('cloro-residual.index')->with('success','Notificación registrada exitosamente.');
                            break;
                    }
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
        $notification = new ResidualChlorine();
        $notification->setId($id);
        $result = $notification->find();


        $munic = new Municipalities();
        $result_m = $munic->all();

        $locations = new Locations();
        $locations->setId($result[0]->id_municipio);
        $result_l = $locations->find();

        $calle = new Streets_x_Location();
        $calle->setLocalidad($result[0]->id_localidad);
        $result_s = $calle->find();

        return view('components.residual_chlorine.edit',['municipalities'=>$result_m,'locations'=>$result_l,'streets'=>$result_s,'item'=>$result[0]]);
    }


    public function update(ResidualChlorineFormRequest $request, $id)
    {
        $fecha =  $request->input('fecha');
        $format =  date('Y-m-d H:i:s', strtotime($fecha));

        $notification = new ResidualChlorine();
        $notification->setMunicipio($request->input('municipio'));
        $notification->setLocalidad($request->input('localidad'));
        $notification->setCalle($request->input('calle'));
        $notification->setFecha($format);
        $notification->setValor($request->input('valor'));
        $notification->setSin_servicio($request->input('ss'));
        $notification->setCausas($request->input('causas'));
        $notification->setAcciones($request->input('acciones'));
        $notification->setMuestras($request->input('analisis'));
        $notification->setId($id);

        $result = $notification->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case 1:    return redirect()->route('cloro-residual.index')->with('success','Notificación actualizada exitosamente.');
                        break;
                }
            }
        }
    }

    public function destroy($id)
    {
        $notification = new ResidualChlorine();
        $notification->setId($id);
        $result = $notification->delete();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case 1:    return redirect()->route('cloro-residual.index')->with('success','Notificación eliminada exitosamente.');
                        break;
                }
            }
        }
    }
}
