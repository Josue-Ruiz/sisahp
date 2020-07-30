<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maps;

class MapsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function get_map($id)
    {
        return view('components.maps.index',['id'=>$id]);
    }

    public function get_location(Request $request)
    {
        if($request->ajax()){
            $loc = new Maps();
            $loc->setId($request->input('id'));
            $result = $loc->get_location();
            return response()->json($result,200);
        }else{
            abort(500);
        }
    }

    public function get_points_georeferenced(Request $request)
    {
        if($request->ajax()){

            if($request->get('id')){

                $cant =  $request->get('cant');

                if($cant == 1)
                {
                    $loc = new Maps();
                    $loc->setId($request->get('id_notif'));
                    $evidences = $loc->get_evidences();

                    $analysis =  $loc->get_results_lab();

                    $results =  array('evidencia_uno'=>null,'evidencia_dos'=>null,'evidencia_tres'=>null,'caja'=>null);

                    isset($evidences[0])  ? $results['evidencia_uno'] = 'obtener-evidencia/'.$evidences[0]->ubicacion : $results['evidencia_uno'] = '/../images/no_image.png';
                    isset($evidences[1])  ? $results['evidencia_dos'] = 'obtener-evidencia/'.$evidences[1]->ubicacion : $results['evidencia_dos'] = '/../images/no_image.png';
                    isset($evidences[2])  ? $results['evidencia_tres'] = 'obtener-evidencia/'.$evidences[2]->ubicacion : $results['evidencia_tres'] = '/../images/no_image.png';


                    $temp = '<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">'.$request->get('municipio').'</div> <div id="destinoGaleria"><div class="slideshow-container" style=" height: 230px; background-image: url('.$results['evidencia_uno'].'); background-size: 100% 100%"><div class="mySlides fade"><div class="numbertext">1 / 3</div><img src="'.$results['evidencia_uno'].'" style="width:100%"><div class="text">Caption Text</div></div><div class="mySlides fade"><div class="numbertext">2 / 3</div><img src="'.$results['evidencia_dos'].'" style="width:100%"><div class="text">Caption Two</div></div><div class="mySlides fade"><div class="numbertext">3 / 3</div><a href="index.html"><img src="'.$results['evidencia_tres'].'" style="width:100%"></a><div class="text">Caption Three</div></div> <a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a></div><br></div></div> <div class="listing-content fl-wrap"><div style="text-align:center"><span id="dot1" onclick="currentSlide(1)" class="dot"></span> <span id="dot2" onclick="currentSlide(2)" class="dot"></span><span id="dot3" onclick="currentSlide(3)" class="dot"></span><div class="listing-title fl-wrap"><h4><a href="#">'.$request->get('localidad').'</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>'.$request->get('direccion').'</span><span class="map-popup-location-phone"><i class="fa fa-calendar"></i>'.$request->get('fecha').'</span> <span class="map-popup-location-phone"><i class="fa fa-pencil"></i>'.$request->get('valor').'</span>';

                    foreach($analysis as $item)
                    {
                        $temp.= '<span class="map-popup-location-phone samples"><i class="fa fa-file-text-o"></i>Col. Totales: '.$item->coliformes_totales.'</span> <span class="map-popup-location-phone "><i class="fa fa-file-text-o"></i>Col. Fecales: '.$item->coliformes_fecales.'</span>';
                    }

                    $temp.='</div></div></div></div>';

                    $results['caja'] = $temp;

                    return response()->json($results,200);

                }else{

                    $rango =  explode('-',$request->input('intevals-dates'));
                    $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
                    $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

                    $loc = new Maps();
                    $loc->setId($request->get('id'));
                    $loc->setFec_inicio($fecha_inicio);
                    $loc->setFec_final($fecha_final);
                    $loc->setCant($cant);
                    $result = $loc->get_points();


                    $loc->setId($request->get('id_notif'));
                    $evidences = $loc->get_evidences();

                    $results =  array('evidencia_uno'=>null,'evidencia_dos'=>null,'evidencia_tres'=>null,'caja'=>null);

                    isset($evidences[0])  ? $results['evidencia_uno'] = 'obtener-evidencia/'.$evidences[0]->ubicacion : $results['evidencia_uno'] = '/../images/no_image.png';
                    isset($evidences[1])  ? $results['evidencia_dos'] = 'obtener-evidencia/'.$evidences[1]->ubicacion : $results['evidencia_dos'] = '/../images/no_image.png';
                    isset($evidences[2])  ? $results['evidencia_tres'] = 'obtener-evidencia/'.$evidences[2]->ubicacion : $results['evidencia_tres'] = '/../images/no_image.png';

                    $temp = '<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">'.$request->get('municipio').'</div> <div id="destinoGaleria"><div class="slideshow-container" style=" height: 230px; background-image: url('.$results['evidencia_uno'].'); background-size: 100% 100%"><div class="mySlides fade"><div class="numbertext">1 / 3</div><img src="'.$results['evidencia_uno'].'" style="width:100%"><div class="text">Caption Text</div></div><div class="mySlides fade"><div class="numbertext">2 / 3</div><img src="'.$results['evidencia_dos'].'" style="width:100%"><div class="text">Caption Two</div></div><div class="mySlides fade"><div class="numbertext">3 / 3</div><a href="index.html"><img src="'.$results['evidencia_tres'].'" style="width:100%"></a><div class="text">Caption Three</div></div> <a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a></div><br></div></div> <div class="listing-content fl-wrap"><div style="text-align:center"><span id="dot1" onclick="currentSlide(1)" class="dot"></span> <span id="dot2" onclick="currentSlide(2)" class="dot"></span><span id="dot3" onclick="currentSlide(3)" class="dot"></span><div class="listing-title fl-wrap"><h4><a href="#">'.$request->get('localidad').'</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>'.$request->get('direccion').'</span> <span class="map-popup-location-phone"><i class="fa fa-tint"></i>'.$cant. ' Monitoreos</span>';

                    foreach($result as $item)
                    {
                        $loc->setId($item->id);
                        $analysis =  $loc->get_results_lab();

                        $temp.= '<span class="map-popup-location-phone samples"><i class="fa fa-calendar"></i>'.$item->fecha.'</span> <span class="map-popup-location-phone "><i class="fa fa-pencil"></i>Valor: '.$item->valor.'</span>';

                        foreach($analysis as $items)
                        {
                            $temp.= '<span class="map-popup-location-phone"><i class="fa fa-file-text-o"></i>Col. Totales: '.$items->coliformes_totales.'</span> <span class="map-popup-location-phone"><i class="fa fa-file-text-o"></i>Col. Fecales: '.$items->coliformes_fecales.'</span>';
                        }

                    }

                    $temp.='</div></div></div></div>';

                    $results['caja'] = $temp;
                    return response()->json($results,200);



                }

            }else{

                $rango =  explode('-',$request->input('intevals-dates'));
                $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
                $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

                if($request->get('municipio')){
                    $loc = new Maps();
                    $loc->setFec_inicio($fecha_inicio);
                    $loc->setFec_final($fecha_final);
                    $loc->setId($request->get('municipio'));
                    $result = $loc->get_points_georeferenced_munic();

                    $points = array();

                    foreach($result as $key=>$item){


                        $found_key = $key > 0 ? array_search($item->id_calle, array_column($points, 'id')) : FALSE;


                        if($found_key !== FALSE){

                            $points[$found_key]['cant']+=1;
                            $points[$found_key]['icono']='/../images/markers/azul.png';

                        }else{

                            $temp=array(
                                'cant'=>1,
                                'id'=>$item->id_calle,
                                'id_notif'=>$item->id,
                                'latitud'=> (float) $item->latitud,
                                'longitud'=>(float) $item->longitud,
                                'fecha'=>$item->fecha,
                                'municipio'=>$item->municipio,
                                'direccion'=>$item->calle,
                                'localidad'=>$item->localidad,
                                'icono'=>$item->icono,
                                'valor'=>$item->valor
                            );

                            array_push($points, $temp);
                        }

                    }


                    return response()->json($points,200);

                }

            }

        }else{
            abort(500);
        }
    }

    public function get_points_georeferenced_vibrio(Request $request)
    {
        if($request->ajax()){

            $rango =  explode('-',$request->input('intevals-dates'));
            $fecha_inicio = date('Y-m-d', strtotime(trim($rango[0])));
            $fecha_final  = date('Y-m-d', strtotime(trim($rango[1])));

            $loc = new Maps();
            $loc->setId($request->get('jurisdiccion'));
            $loc->setFec_inicio($fecha_inicio);
            $loc->setFec_final($fecha_final);
            $result = $loc->get_points_georeferenced_vibrio();


            $points = array();

            foreach($result as $key=>$item){

                $found_key =  $key > 0 ? array_search($item->id_localidad, array_column($points, 'id_localidad')) : FALSE;
                $cant = array_count_values(array_column($result, 'id_localidad'))[$item->id_localidad];

                if($found_key !== FALSE){

                    $points[$found_key]['cant']+=1;
                    $points[$found_key]['icono']='/../images/markers/lila.png';
                    $points[$found_key]['caja'].='<span class="map-popup-location-info"><i class="fa fa-map-marker samples"></i>Dirección: '.$item->lugar.'</span> <span class="map-popup-location-info"><i class="fa fa-calendar"></i>Fecha: '.$item->fecha.'</span><span class="map-popup-location-phone"><i class="fa fa-file-text-o"></i>Resultado: '.$item->resultado.'</span>' ;

                }else{

                    $temp=array(
                        'cant'=>1,
                        'id'=>$item->id,
                        'id_localidad'=>$item->id_localidad,
                        'latitud'=> (float) $item->latitud,
                        'longitud'=>(float) $item->longitud,
                        'fecha'=>$item->fecha,
                        'lugar'=>$item->lugar,
                        'resultado'=>$item->resultado,
                        'icono'=>$item->icono,
                        'caja' => '<div class="map-popup-wrap"><div class="map-popup"><div class="listing-content fl-wrap"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">'.$item->municipio.'</div><div style="text-align:center; margin-top:78px;"><div class="listing-title fl-wrap"><h4><a href="#">'.$item->localidad.'</a></h4>  <span class="map-popup-location-info"><i class="fa fa-tint"></i>'.$cant.' Monitoreo(s)</span>  <span class="map-popup-location-info"><i class="fa fa-map-marker samples"></i>Dirección: '.$item->lugar.'</span><span class="map-popup-location-info"><i class="fa fa-calendar"></i>Fecha: '.$item->fecha.'</span><span class="map-popup-location-phone"><i class="fa fa-file-text-o"></i>Resultado: '.$item->resultado.'</span>'
                    );

                    array_push($points, $temp);
                }


            }

            return response()->json($points,200);

        }else{
            abort(500);
        }

    }




}
