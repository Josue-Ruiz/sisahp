

<body>

<section>

    <div class="container">
        <div class="details clearfix">
            <div class="client left">
                <p>DIRECCIÓN DE PROTECCIÓN CONTRA RIESGOS SANITARIOS</p>
                <p class="asunt">FEDERATIVA: <span class="sub-asunt">CHIAPAS (007) </span>  </p>
                <p class="asunt">REPORTE: <span class="sub-asunt">MENSUAL MUNICIPAL</span>  </p>
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
                    <th class="qty">Municipio</th>
                    <th class="qty">Población Total</th>
                    <th class="qty">Total</th>
                    <th class="qty">Dentro de Norma </th>
                    <th class="qty">% Eficiencia de Cloración </th>
                    <th class="qty">Total de muestras para analisis Bactereológico</th>
                    <th class="qty">Debajo de Norma</th>
                    <th class="qty">Dentro y Arriba de Norma</th>
                    <th class="qty">% Dentro y Arriba de Norma</th>
                    <th class="qty">Muestras con ausencia de Coliformes</th>
                    <th class="qty">% Positividad a Coliformes</th>
                    <th class="qty">D. Programadas</th>
                    <th class="qty">% C. Vigilancia</th>



                </tr>
            </thead>
            <tbody>
                @foreach($registers as $item)
                    <tr>
                        <td class="desc">{{$item->municipio}}</td>
                        <td class="desc">{{$item->pob_total}}</td>
                        <td class="total">{{$item->total}}</td>
                        <td class="total">{{$item->total_dent}}</td>
                        <td class="total">{{ round(($item->total_dent *100) / $item->total) }}%</td>
                        <td class="total">{{$item->total_muestras}}</td>
                        <td class="total">{{$item->total_deb}}</td>
                        <td class="total">{{$item->total_dent + $item->total_med}}</td>
                        <td class="total">{{round((($item->total_dent + $item->total_med) *100 )/$item->total_monitoreos)}}%</td>
                        <td class="total">{{$item->total_ausencia}}</td>
                        <td class="total">{{round(($item->total_ausencia * 100)/$item->total_muestras)}}%</td>
                        <td class="total">{{$item->determ_programadas}}</td>
                        <td class="total">{{ number_format(((($item->total_dent *100) / $item->total)) / (($item->total/$item->determ_programadas)),2) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</section>
</body>
