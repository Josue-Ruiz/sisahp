<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Models\ReportMunicipalMonthly;
use App\Http\Controllers\Controller;

class MunicipalMonthlyController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        return view('components.reports.municipal_monthly.index');
    }


    public function create(Request $request)
    {
        $rango =  explode('-',$request->input('intervals-dates'));
        $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
        $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

        $report = new ReportMunicipalMonthly();
        $report->setFec_inicio($fecha_inicio);
        $report->setFec_final($fecha_final);

        $info = array('fec_inicio'=>$fecha_inicio,'fec_final'=>$fecha_final);
        $result = $report->generate_report();

        $view = view('components.reports.municipal_monthly.body',['registers'=>$result,'info'=>$info]);
        $header = view('components.reports.municipal_monthly.header');
        $footer = view('components.reports.municipal_monthly.footer');
        $stylesheet = file_get_contents('css/report.css');
        $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 35,'margin_bottom'=>38, 'orientation' => 'L']);
        $pdf->SetTitle('SIVA | Determinación de cloro residual');
        $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->setHTMLHeader($header);
        $pdf->setHTMLFooter($footer);
        $pdf->WriteHTML($view);

        $pdf->Output('dola.pdf','I');
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
