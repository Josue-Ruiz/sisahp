<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Requests\AnalysisFormRequests;
use App\Models\ReportDeterChlorine;
use App\Http\Controllers\Controller;

class ChlorineDeterminationController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        return view('components.reports.chlorine_determ.index');
    }


    public function create(Request $request)
    {
        if($request->input('intevals-dates')){

            $rango =  explode('-',$request->input('intevals-dates'));
            $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
            $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

            $reports = new ReportDeterChlorine();
            $reports->setFec_inicio($fecha_inicio);
            $reports->setFec_final($fecha_final);
            $result = $reports->generate_report();

            $info = array('fec_inicio'=>$fecha_inicio,'fec_final'=>$fecha_final);

            $view = view('components.reports.chlorine_determ.body',['registers'=>$result, 'info'=>$info]);
            $header = view('components.reports.chlorine_determ.header');
            $footer = view('components.reports.chlorine_determ.footer');
            $stylesheet = file_get_contents('css/report.css');
            $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 35,'margin_bottom'=>38, 'orientation' => 'L']);
            $pdf->SetTitle('SIVA | Determinación de cloro residual');
            $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf->setHTMLHeader($header);
            $pdf->setHTMLFooter($footer);
            $pdf->WriteHTML($view);

            $pdf->Output('dola.pdf','I');


        }else{
            $analysis = new ReportDeterChlorine();
            $result = $analysis->find_analysis();

            return view('components.reports.chlorine_determ.create',['registers'=>$result]);
        }



    }


    public function store(AnalysisFormRequests $request)
    {
        if($request->ajax()){
            $analysis = new ReportDeterChlorine();
            $analysis->setFecales($request->get('fecales'));
            $analysis->setTotales($request->get('totales'));
            $analysis->setUsuario($request->get('usuario'));
            $analysis->setId($request->get('id'));
            $result = $analysis->update_analysis();
            return $result;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(AnalysisFormRequests $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
