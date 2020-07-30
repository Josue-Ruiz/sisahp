<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReportEpidWeek;

class EpidemilogicalWeekController extends Controller
{

    public function index()
    {
        $weeks = new ReportEpidWeek();
        $result = $weeks->find_weeks();
        return view('components.reports.epid_week.index',['weeks'=>$result]);
    }

    public function create(Request $request)
    {
        if($request->input('semana')){

            $weeks = new ReportEpidWeek();
            $weeks->setId($request->input('semana'));
            $result = $weeks->generate_report();

            $info = $weeks->get_info();

            $view = view('components.reports.epid_week.body',['registers'=>$result, 'info'=>$info[0]]);
            $header = view('components.reports.epid_week.header');
            $footer = view('components.reports.epid_week.footer');
            $stylesheet = file_get_contents('css/report.css');
            $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 35,'margin_bottom'=>38, 'orientation' => 'L']);
            $pdf->SetTitle('SIVA | Semana Epidemiológica');
            $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf->setHTMLHeader($header);
            $pdf->setHTMLFooter($footer);
            $pdf->WriteHTML($view);

            $pdf->Output('dola.pdf','I');



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
