<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Models\ReportBactSample;
use App\Http\Controllers\Controller;


class BacteriologicalSampleController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        return view('components.reports.bact_sample.index');
    }

    public function create(Request $request)
    {
        $rango =  explode('-',$request->input('intevals-dates'));
        $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
        $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));


        $reports = new ReportBactSample();
        $reports->setFec_inicio($fecha_inicio);
        $reports->setFec_final($fecha_final);

        $result = $reports->generate_report();

        $info =  array('fec_inicio'=>$fecha_inicio,'fec_final'=>$fecha_final);

        $view = view('components.reports.bact_sample.body',['registers'=>$result, 'info'=>$info]);
        $header = view('components.reports.bact_sample.header');
        $footer = view('components.reports.bact_sample.footer');
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
