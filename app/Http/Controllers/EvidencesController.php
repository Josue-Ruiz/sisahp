<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Evidences;
use Storage;
use Image;
use File;
class EvidencesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }
    public function index(Request $request)
    {

        if($request->input('notificacion')){
            $evidences = new Evidences();
            $evidences->setId($request->input('notificacion'));
            $result = $evidences->find();

            return view('components.evidences.index',['id'=>$request->input('notificacion'),'evidences'=>$result]);
        }else{
            \abort(500);
        }

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $image = $request->input('evidencia');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $file_name = $request->input('id').'_'.time().'_'.Str::random(5).'.png';
        Storage::disk('evidences')->put($file_name,base64_decode($image));

        $evidences = new Evidences();
        $evidences->setIdNotificacion($request->input('id'));
        $evidences->setUbicacion($file_name);
        $result = $evidences->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case 1:    return back()->with('success','Evidencia agregada exitosamente.');
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
        $evidences = new Evidences();
        $evidences->setId($id);
        $result = $evidences->find_by_id();

        return view('components.evidences.edit',['item'=>$result[0]]);
    }

    public function update(Request $request, $id)
    {
        $image = $request->input('evidencia');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $file_name = $request->input('notificacion').'_'.time().'_'.Str::random(5).'.png';
        Storage::disk('evidences')->put($file_name,base64_decode($image));

        $evidences = new Evidences();
        $evidences->setId($id);
        $evidences->setUbicacion($file_name);
        $result = $evidences->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case 1:    return redirect()->route('evidencias.index',['notificacion'=>$request->input('notificacion')])->with('success','Evidencia modificada exitosamente.');
                        break;
                }
            }
        }
    }

    public function destroy($id)
    {

        $evidences = new Evidences();
        $evidences->setId($id);
        $result = $evidences->delete();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case 1:    return back()->with('success','Evidencia eliminada exitosamente.');
                        break;
                }
            }
        }
    }

    public function get_img_evidence($name){
        $img = Storage::disk('evidences')->get($name);
        return $img;
    }

}
