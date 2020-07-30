

<body>

<section>

    <div class="container">
        <div class="details clearfix">
            <div class="client left">
                <p>DIRECCIÓN DE PROTECCIÓN CONTRA RIESGOS SANITARIOS</p>
                <p class="asunt">FEDERATIVA: <span class="sub-asunt">CHIAPAS (007) </span>  </p>
                <p class="asunt">REPORTE: <span class="sub-asunt">DETERMINACIÓN DE CLORO</span>  </p>
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
                    <th class="qty">Localidad</th>
                    <th class="qty">Dirección</th>
                    <th class="qty">Coliformes Totales </th>
                    <th class="qty">Coliformes Fecales </th>
                    <th class="qty">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registers as $item)
                    <tr>
                        <td class="desc">{{$item->municipio}}</td>
                        <td class="desc">{{$item->localidad}}</td>
                        <td class="desc-long">{{$item->direccion }}</td>
                        <td class="desc">{{$item->coliformes_totales}}</td>
                        <td class="desc">{{$item->coliformes_fecales}}</td>
                        <td class="desc">{{ strtoupper($item->fecha) }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</section>
</body>
