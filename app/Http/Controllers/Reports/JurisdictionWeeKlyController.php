<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Models\ReportJurisdictionWeeKly;
use App\Http\Controllers\Controller;

class JurisdictionWeeKlyController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        $reports = new ReportJurisdictionWeeKly();
        $jurisdictions = $reports->find_jurisdictions();

        return view('components.reports.jurisdiction_weekly.index',\compact('jurisdictions'));
    }


    public function create(Request $request)
    {
        if($request->input('intevals-dates') && $request->input('jurisdicciones')){

            $rango =  explode('-',$request->input('intevals-dates'));
            $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
            $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

            $reports = new ReportJurisdictionWeeKly();
            $reports->setFec_inicio($fecha_inicio);
            $reports->setFec_final($fecha_final);
            $reports->setJurisdiccion($request->input('jurisdicciones')[0]);

            $info = array('fec_inicio'=>$fecha_inicio,'fec_final'=>$fecha_final);
            $result = $reports->generate_report();

            $view = view('components.reports.jurisdiction_weekly.body',['registers'=>$result,'info'=>$info]);
            $header = view('components.reports.jurisdiction_weekly.header');
            $footer = view('components.reports.jurisdiction_weekly.footer');
            $stylesheet = file_get_contents('css/report.css');
            $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 35,'margin_bottom'=>38, 'orientation' => 'L']);
            $pdf->SetTitle('SIVA | Determinación de cloro residual');
            $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf->setHTMLHeader($header);
            $pdf->setHTMLFooter($footer);
            $pdf->WriteHTML($view);

            $pdf->Output('hola.pdf','I');
        }else{
            \abort(500);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
