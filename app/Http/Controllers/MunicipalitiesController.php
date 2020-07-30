<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MunicipalitiesFormRequest;
use App\Models\Entities;
use App\Models\Municipalities;
class MunicipalitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        $munic = new Municipalities();
        $result = $munic->all();

        if($request->ajax())
        {
            return json_encode($result);
        }

        return view('components.municipalities.index',['registers'=>$result]);
    }


    public function create()
    {
        $entities =  new Entities();
        $result = $entities->all();
        return view('components.municipalities.create',['entities'=>$result]);
    }

    public function store(MunicipalitiesFormRequest $request)
    {
       $munic = new Municipalities();
       $munic->setClave($request->input('clave'));
       $munic->setEntidad($request->input('entidad'));
       $munic->setNombre($request->input('nombre'));
       $munic->setPobTotal($request->input('pob_total'));
       $munic->setPobAgua($request->input('pob_agua'));
       $munic->setPresidente($request->input('presidente'));
       $munic->setDelegado($request->input('delegado'));

       $result = $munic->save();

       if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['clave'=>'Clave de Municipio en uso. Elige otro.'])->withInput();
                        break;
                    case -2:   return back()->withErrors(['nombre'=>'Nombre del Municipio en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('municipios.index')->with('success','Municipio agregado exitosamente.');
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
        $munic = new Municipalities();
        $munic->setId($id);
        $result = $munic->find();

        $entities = new Entities();
        $result2 = $entities->all();

        return view('components.municipalities.edit',['entities'=>$result2,'item'=>$result[0]]);
    }


    public function update(MunicipalitiesFormRequest $request, $id)
    {
       $munic = new Municipalities();
       $munic->setClave($request->input('clave'));
       $munic->setEntidad($request->input('entidad'));
       $munic->setNombre($request->input('nombre'));
       $munic->setPobTotal($request->input('pob_total'));
       $munic->setPobAgua($request->input('pob_agua'));
       $munic->setPresidente($request->input('presidente'));
       $munic->setDelegado($request->input('delegado'));
       $munic->setId($id);

       $result = $munic->update();

       if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['clave'=>'Clave de Municipio en uso. Elige otro.'])->withInput();
                        break;
                    case -2:   return back()->withErrors(['nombre'=>'Nombre del Municipio en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('municipios.index')->with('success','Municipio actualizado exitosamente.');
                        break;
                }
            }
        }
    }


    public function destroy($id)
    {
       $munic = new Municipalities();
       $munic->setId($id);

       $result = $munic->delete();

       if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case 1:    return redirect()->route('municipios.index')->with('success','Municipio eliminado exitosamente.');
                        break;
                }
            }
        }
    }
}
