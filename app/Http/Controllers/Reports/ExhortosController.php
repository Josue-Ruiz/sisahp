<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReportExhortos;
use Storage;
use File;
use Image;
use Session;

class ExhortosController extends Controller
{

    public function index()
    {
        $jurisdictions = array((object) [ 'id'=>Session::get('identity')->jurisdiccion,'nombre' => Session::get('identity')->nombre_jurisdiccion]);


        if(strtolower(Session::get('identity')->rol) == 'administrador')
        {
            $reports = new ReportExhortos();
            $jurisdictions = $reports->find_jurisdictions();
        }

        return view('components.reports.exhortos.index',\compact('jurisdictions'));
    }

    public function create(Request $request)
    {
        if($request->input('intevals-dates') && $request->input('jurisdicciones')){

            $fecha =  explode('/',$request->input('intevals-dates'));
            $mes = trim($fecha[0]);
            $anio  = trim($fecha[1]);

            $jurisdiccion  = (strtolower(Session::get('identity')->rol) == 'administrador') ? $request->input('jurisdicciones') : Session::get('identity')->jurisdiccion;

            $reports = new ReportExhortos();
            $reports->setMes($mes);
            $reports->setAnio($anio);
            $reports->setJurisdiccion($jurisdiccion);

            $result = $reports->generate_report();

            $asunto = "";
            Storage::disk('paragraph')->exists('exhortos.txt') ? $asunto = Storage::disk('paragraph')->get('exhortos.txt') : $asunto = "";

            $view = view('components.reports.exhortos.body',['registers'=>$result,'asunto'=>$asunto]);
            $header = view('components.reports.exhortos.header');
            $footer = view('components.reports.exhortos.footer');
            $stylesheet = file_get_contents('css/report_exhorto.css');
            $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 35,'margin_bottom'=>19]);
            $pdf->SetTitle('SIVA | Exhortos');
            $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf->setHTMLHeader($header);
            $pdf->setHTMLFooter($footer);
            $pdf->WriteHTML($view);

            $pdf->Output('hola.pdf','I');

        }else{
            return  back();
        }
    }

    public function store(Request $request)
    {
        $image = $request->input('logo');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $file_name = $request->input('id') == 1 ?  'secretariasalud.png' : 'secretariasaludchiapas.png';
        $storagepath = public_path();
        file_put_contents($storagepath.'/images/report/'.$file_name, base64_decode($image));

        return  redirect()->route('exhortos-eficiencia-cloracion.show','logotipos')->with('success','Logotipo guardado exitosamente.');
    }

    public function show($id)
    {
        switch($id)
        {
            case 'asunto':
                $asunto = "";
                Storage::disk('paragraph')->exists('exhortos.txt') ? $asunto = Storage::disk('paragraph')->get('exhortos.txt') : $asunto = "";
                return view('components.exhortos.edit',['asunto'=>$asunto]);
            break;
            case 'logotipos':
                    return view('components.exhortos.logos');
                break;
            default: \abort(500);
        }


    }

    public function edit($id)
    {
        return view('components.exhortos.edit_logo',['id'=>$id]);
    }

    public function update(Request $request, $id)
    {

        $contenido =  $request->get('descripcion');
        Storage::disk('paragraph')->put('exhortos.txt',$contenido);
        return redirect()->route('exhortos-eficiencia-cloracion.show','asunto')->with('success','Asunto del reporte modificado exitosamente.');

    }


    public function destroy($id)
    {
        //
    }

    public function get_img_logo($name){
        $img = Storage::disk('logos')->get($name);
        return $img;
    }


}
