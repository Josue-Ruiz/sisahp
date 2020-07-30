<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CalendarFormRequest;
use App\Models\Calendar;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
           $eventos = new Calendar(0);
           $result = $eventos->all();
           return json_encode( $result);
        }else{
            return view('components.calendar.index');
        }

    }


    public function create()
    {
        //
    }

    public function store(CalendarFormRequest $request)
    {
        $evento = new Calendar();
        $evento->setAsunto($request->get('asunto'));
        $evento->setFec_inicio($request->get('fec_inicio'));
        $evento->setFec_final($request->get('fec_final'));
        $evento->setUsuins($request->get('x-csrf-s'));
        $result = $evento->save();
        return $result;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(CalendarFormRequest $request, $id)
    {
        $evento = new Calendar();
        $evento->setAsunto($request->get('asunto'));
        $evento->setFec_inicio($request->get('fec_inicio'));
        $evento->setFec_final($request->get('fec_final'));
        $evento->setUsuins($request->get('x-csrf-s'));
        $evento->setId($id);
        $result = $evento->update();
        return $result;
    }

    public function destroy(Request $request,$id)
    {
        $evento = new Calendar();
        $evento->setUsuins($request->get('x-csrf-s'));
        $evento->setId($id);
        $result = $evento->delete();
        return $result;
    }
}
