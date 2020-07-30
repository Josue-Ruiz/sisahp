

<body>

<section>

    <div class="container">
        <div class="details clearfix">
            <div class="client left">
                <p>DIRECCIÓN DE PROTECCIÓN CONTRA RIESGOS SANITARIOS</p>
                <p class="asunt">FEDERATIVA: <span class="sub-asunt">CHIAPAS (007) </span>  </p>
                <p class="asunt">REPORTE: <span class="sub-asunt">MONITOREOS A NIVEL JURISDICCIONAL</span>  </p>
                <p class="asunt">PERIODO: <span class="sub-asunt">NOVIEMBRE 2019</span>  </p>

            </div>
            <div class="data right">

                <div class="date">
                <p class="asunt">FECHA DE INICIO: <span class="sub-asunt">{{$info['fec_inicio']}} </span>  </p>
                <p class="asunt">FECHA DE TERMINACIÓN: <span class="sub-asunt">{{$info['fec_final']}} </span>  </p>

                </div>
            </div>
        </div>

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="qty">Jurisdicción</th>
                    <th class="qty">Municipio</th>
                    <th class="qty">Población Total</th>
                    <th class="qty">Total</th>
                    <th class="qty">Dentro de Norma </th>
                    <th class="qty">Debajo de Norma</th>
                    <th class="qty">Dentro y Arriba de Norma</th>
                    <th class="qty">%</th>
                    <th class="qty">M. con presencia de Col.</th>
                    <th class="qty">M. con ausencia de Col.</th>
                    <th class="qty">D. Programadas</th>
                    <th class="qty">% E. de Cloración</th>
                    <th class="qty">F. Riesgo</th>
                    <th class="qty">C. Vigilancia</th>
                    <th class="qty">P. Agua entubada</th>
                    <th class="qty">% P. sin riesgo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registers as $item)
                    <tr>
                        <td class="desc">{{$item->jurisdiccion}}</td>
                        <td class="desc">{{$item->municipio}}</td>
                        <td class="desc">{{$item->pob_total}}</td>
                        <td class="total">{{$item->total}}</td>
                        <td class="total">{{$item->total_dent}}</td>
                        <td class="total">{{$item->total_deb}}</td>
                        <td class="total">{{$item->total_dent + $item->total_med}}</td>
                        <td class="total">{{round((($item->total_dent + $item->total_med) *100 )/$item->total_monitoreos)}}%</td>
                        <td class="total">{{$item->total_ausencia}}</td>
                        <td class="total">{{$item->total_presencia}}</td>
                        <td class="total">{{$item->determ_programadas}}</td>
                        <td class="total">{{number_format((($item->total_dent *100) / $item->total),2) }}</td>
                        <td class="total">{{number_format(($item->total/$item->determ_programadas),2)  }}</td>
                        <td class="total">{{number_format(((($item->total_dent *100) / $item->total)) / (($item->total/$item->determ_programadas)),2) }}</td>
                        <td class="total">{{$item->pob_agua }}</td>
                        <td class="total">{{ number_format((((($item->total_dent *100) / $item->total) / (($item->total/$item->determ_programadas)) * $item->pob_agua) /$item->pob_total),2) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</section>
</body>
