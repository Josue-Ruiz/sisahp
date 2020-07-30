<body>

<section>

    @foreach($registers as $item)
    <div class="container">
        <div class="details clearfix">
            <div class="client left import">
                <p>SECRETARÍA DE SALUD</p>
                <p>INSTITUTO DE SALUD</p>
                <p>DIRECCIÓN DE PROTECCION CONTRA RIESGOS SANITARIOS</p>
                <p>SUBDIRECCIÓN DE SALUD AMBIENTAL</p>
                <p>DEPARTAMENTO DE EVIDENCIA Y MANEJO DE RIESGOS</p>
            </div>
        </div>

        <div class="details-right clearfix">
            <div class="data right">
                    <p class="import">OFICIO No. DIPRIS/SSA/DEMAR/«{{$item->numero_oficio}}»/{{$item->anio}}.</p>
                    <p><span class="import">ASUNTO:</span>  Exhorto por eficiencia de cloración del agua.</p>
                    <p>Tuxtla Gutiérrez, Chiapas; «{{$item->fecha}}».</p>

            </div>
        </div>

        <div class="details clearfix">
            <div class="client left">
                <p class="import">{{ strtoupper($item->presidente)}}</p>
                <p class="import">PRESIDENTE MUNICIPAL DE {{ strtoupper($item->municipio) }}</p>
                <p>PRESENTE</p>

            </div>
        </div>

        <div class="content">
                <p class="desc">Apreciable Sr.ª Presidente:</p>
                <p class="desc">El objetivo de suministrar agua desinfectada a través de los Sistemas Formales de Abastecimiento, es el de contribuir a la mejora del bienestar de la población y coadyuvar a reducir la incidencia de enfermedades intestinales, tales como Salmonelosis, Cólera, Hepatitis A, Rotavirus y otras enfermedades gastrointestinales de origen hídrico.</p>
                <p class="desc">En consecuencia de lo anterior, <span class="import">se observó que la Eficiencia de Cloración en su Municipio durante el mes de «{{strtoupper($item->mes)}}» de {{$item->anio}} fue de «{{$item->eficiencia}}»% por lo que NO CUMPLE con el 90% requerido por la COFEPRIS para garantizar agua segura.</span>  Por lo anterior, se considera que su población está en riesgo para la transmisión de enfermedades gastrointestinales, <span class="import">debido a que se han detectado «{{$item->edas}}» casos de EDA´s en el mismo mes, lo que representa un gasto de $«{{$item->costo_edas}}» pesos en atención médica</span> , debido a que los niveles de eficiencia de cloración del agua en su municipio, son deficientes. </p>
                <p class="desc">Es por ello que, como autoridad responsable de la vigilancia de la calidad del agua de uso y consumo humano,</p>
                <p class="asunt import">LO EXHORTO</p>
                <p class="desc">al cumplimiento de obligatoriedad constitucional en el proceso de <span class="import">DESINFECCIÓN</span>  de su “<span class="import">Sistema Formal de Abastecimiento de Agua Para Consumo Humano</span> ”, no omito referirle que esta se encuentra establecida en los <span class="import"> Artículos: 115, fracción III, inciso a de la Constitución Política de los Estados Unidos Mexicanos; 70, fracción II de la Constitución Política del Estado de Chiapas; 201, fracción I, incisos d, e y g, y fracción II, del Reglamento de la Ley General de Salud en Materia de Control Sanitario de Actividades, Establecimientos, Productos y Servicios; 168 de la Ley de Salud del Estado de Chiapas; 87, de la Ley Orgánica Municipal. Así también le informo que esta autoridad sanitaria podrá instrumentar en todo momento la vigilancia para su cumplimiento y en su caso, aplicar las sanciones administrativas que la Ley vigente contempla en los artículos: 420, 421 y 423 de la Ley General de Salud.</span></p>
                <p class="desc">Asimismo, se le recomienda implementar mecanismos que permitan fomentar mejoras en su Sistema Formal de Abastecimiento, que incluyan todos los aspectos relacionados con la idoneidad del abastecimiento del vital líquido, considerando los parámetros básicos del servicio: Calidad, Cantidad, Accesibilidad, Asequibilidad y Continuidad. No omito manifestar, que una de las herramientas para poder hacer un diagnóstico de su Sistema con enfoque de riesgos, es el Plan de Seguridad del Agua (PSA), por tal motivo se le solicita mantener actualizado su Plan, y en caso de no contar con él, favorecer el proceso para su elaboración y entregarlo a las autoridades sanitarias a través del Delegado Técnico Municipal del Agua.</p>
                <p class="desc">Seguro de contar con su intervención a favor de la protección de la salud pública, le reitero un cordial saludo.</p>
        </div>

        <div>

            @php  echo $asunto @endphp

        </div>

    </div>

    @endforeach
</section>
</body>
