<?php

namespace App\Http\Controllers\Modifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Municipalities;
use App\Models\Modifications;
USE App\Models\ResidualChlorine;

class ResidualChlorineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $muni = new Municipalities();
        $result = $muni->all();

        $parameters = array('municipalities'=>$result);
        if($request->has('intevals-dates')){

            $this->validate($request,['intevals-dates' => ['required','string'], 'municipio'=>['required','integer'], 'localidad' => ['required','integer']]);
            $rango =  explode('-',$request->input('intevals-dates'));
            $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
            $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

            $notifications = new Modifications();
            $notifications->setLocalidad($request->input('localidad'));
            $notifications->setFec_inicio($fecha_inicio);
            $notifications->setFec_final($fecha_final);

            $registers = $notifications->get_residual_chlorine();

            $parameters =array('municipalities'=>$result,'registers'=>$registers);

        }

        return view('components.modifications.residual_chlorine.index',$parameters);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                    case 1:    return back()->with('success','Notificación eliminada exitosamente.');
                        break;
                }
            }
        }
    }
}
