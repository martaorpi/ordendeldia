@extends(backpack_view('blank'))

<style>
    input {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }
    .accordion-wrapper {
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 4px 4px -2px rgba(0, 0, 0, 0.5);
        width: 100%;
        margin:0 auto;
    }
    .accordion {
        width: 100%;
        color: white;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .accordion:last-child{margin-bottom: 0;}
    .accordion-label {
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        padding: 10px;
        background: #f1f4f8;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        color:#222;
    }
    .accordion-label:hover {
        background: #28166f;
        color:#fff;
    }
    .accordion-label::after {
        content: "\276F";
        width: 16px;
        height: 16px;
        text-align: center;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .accordion-content {
        max-height: 0;
        padding: 0 16px;
        color: rgba(4,57,94,1);
        background: white;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        overflow-y: scroll;
    }
    .accordion-content p{
        margin: 0;
        color: rgba(4,57,94,.7);
        font-size: 18px;
    }
    input:checked + .accordion-label {
        background: #cfd9e7;
        color:#000;
    }
    input:checked + .accordion-label::after {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    input:checked ~ .accordion-content {
        max-height: 100vh;
        padding: 16px;
    }
/*-----------------POST-------------------*/
    img {max-width:100%;}
    .avator {
        border-radius:100px;
        width:48px;
        margin-right: 10px;
    }
    .tweet-wrap {
        max-width:100%;
        background: #fff;
        margin: 0 auto;
        margin-top: 10px;
        border-radius:3px;
        padding: 20px;
        border-bottom: 1px solid #e6ecf0;
        border-top: 1px solid #e6ecf0;
    }
    .tweet-header {
        display: flex;
        align-items:flex-start;
        font-size:14px;
    }
    .tweet-header-info {font-weight:bold;}
    .tweet-header-info span {
        color:#657786;
        font-weight:normal;
        margin-left: 5px;
    }
    .tweet-header-info p {
        font-weight:normal;
        margin-top: 5px;
    }
    .tweet-img-wrap {padding-left: 60px;}
    .tweet-info-counts {
        display: flex;
        margin-left: 60px;
        margin-top: 10px;
    }
    .tweet-info-counts div {
        display: flex;
        margin-right: 20px;
    }
    .tweet-info-counts div svg {
    color:#657786;
    margin-right: 10px;
    }
    @media screen and (max-width:430px){
        .tweet-header {flex-direction:column;}
        .tweet-header img {margin-bottom: 20px;}
        .tweet-header-info p {margin-bottom: 30px;}
        .tweet-img-wrap {padding-left: 0;}
        .tweet-info-counts {
            display: flex;
            margin-left: 0;
        }
        .tweet-info-counts div {margin-right: 10px;}
    }
</style>

@section('content')

<h3>Digesto Jurídico Policial</h3>
<div class="accordion-wrapper">
    <div class="accordion">
        <input type="radio" name="radio-a" id="check1">
        <label class="accordion-label" for="check1">Normativa Legal General</label>
        <div class="accordion-content">
            <h5>Normativa Nacional e Internacional</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Código de conducta para funcionarios encargados de hacer cumplir la ley.pdf')}}" target="blank">* Código de conducta para funcionarios encargados de hacer cumplir la ley.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONVENCION DE BELEM DO PARA.pdf')}}" target="blank">* Convención de belem do para.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONVENCION INTERAMERICANA PARA PREVENIR Y SANCIONAR LA TORTURA.pdf')}}" target="blank">* Convención interamericana para prevenir y sancionar la tortura.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONVENCION INTERAMERICANA PARA PREVENIR,  SANCIONAR Y ERRADICAR LA VIOLENCIA CONTRA LA MUJER.pdf')}}" target="blank">* Convención interamericana para prevenir, sancionar y erradicar la violencia contra la mujer.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención Internacional para la Protección de Todas las personas contra las personas.pdf')}}" target="blank">* Convención internacional para la protección de todas las personas contra las personas.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Principios básicos sobre el empleo de la fuerza y de las armas de fuego de Naciones Unidas.pdf')}}" target="blank">* Principios básicos sobre el empleo de la fuerza y de las armas de fuego de Naciones Unidas.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Declaración Universal de Derechos Humanos y Declaración Americana de los Derechos Hombre.pdf')}}" target="blank">* Declaración universal de derechos humanos y declaración americana de los derechos del hombre.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención Americana sobre Derechos Humanos.pdf')}}" target="blank">* Convención americana sobre derechos humanos.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención sobre los derechos del Niño.pdf')}}" target="blank">* Convención sobre los derechos del niño.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Codigo Civil y Comercial.pdf')}}" target="blank">* Código Civil y Comercial de la Nación.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24449 - LEY NACIONAL DE TRANSITO.pdf')}}" target="blank">* Ley Nacional de tránsito N° 24449.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley 24417 CONTRA LA VIOLENCIA FAMILIAR.pdf')}}" target="blank">* Ley Nacional 24417 de protección contra la violencia familiar.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY Nº 26.485 - VIOLENCIA CONTRA LA MUJER.pdf')}}" target="blank">* Ley Nacional 26485 de protección integral a las mujeres.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley Nacional 27499 - Micaela.pdf')}}" target="blank">* Ley Nacional 27499 Micaela.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 22172 - COMUNICACION ENTRE TRIBUNALES.pdf')}}" target="blank">* Ley Nacional 22172 Sobre comunicación entre tribunales de la República de distinta jurisdicción territorial.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley Nacional 26743 - Identidad de Genero.pdf')}}" target="blank">* Ley Nacional 26743 de identidad de género.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24.660 - EJECUCION DE LA PENA PRIVATIVA DE LA LIBERTAD.pdf')}}" target="blank">* Ley Nacional 24660 Ejecución de la pena privativa de la libertad.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley 26061.pdf')}}" target="blank">* Ley Nacional 26061 de protección integral de los derechos de las niñas, niños y adolescentes.</a>
                <br><br>
            </p>
            <h5>Normativa Provincial</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley N° 6910 - CÓDIGO DE PROCEDIMIENTOS  CIVIL Y COMERCIAL.pdf')}}" target="blank">* Código de Procedimiento Civil y Comercial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de Procedimiento Penal.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 2296 - TRAMITE ADMINISTRATIVO.pdf')}}" target="blank">* Ley 2296 - trámite administrativo.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 5873  SALARIAL.pdf')}}" target="blank">* Ley Salarial N° 5873/91.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a>
                <br><br>
            </p>
            <h5>Reglamentos</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Reglamentos/REGLAMENTO GENERAL DE UNIFORMES DE LA POLICÍA DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Reglamento general de uniformes de la policía de la provincia de Santiago del Estero.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check25">
        <label class="accordion-label" for="check25">Asesoria Letrada General</label>
        <div class="accordion-content">
            <h5>Normativa Nacional</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Nacional/Ley N 20.744 –Ley de Contrato de Trabajo..pdf')}}" target="blank">* Ley N° 20.744 –Ley de Contrato de Trabajo.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/LEY 24557 - RIESGOS DEL TRABAJO.pdf')}}" target="blank">* Ley de Riesgo de Trabajo N° 24.557.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY Nº 19.587 - LEY DE HIGIENE Y SEGURIDAD EN EL TRABAJO.pdf')}}" target="blank">* Ley de Higiene y Seguridad Laboral Nº 19.587.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Nacional/Ley N 20.596 - Licencia Especial Deportiva.pdf')}}" target="blank">* Ley N°: 20.596. Licencia Especial Deportiva.</a>
                <br><br>
            </p>
            <h5>Normativa Provincial</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 2296 - TRAMITE ADMINISTRATIVO.pdf')}}" target="blank">* Ley 2296 - trámite administrativo.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/Ley 2297 - Procedimiento Contencioso Administrativo.pdf')}}" target="blank">* Ley N° 2.297 - Procedimiento Contencioso Administrativo.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 5873  SALARIAL.pdf')}}" target="blank">* Ley Salarial N° 5873/91.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/Ley N° 6.738  - LEY DE MINISTERIOS.pdf')}}" target="blank">* Ley N°: 6.738 - De Organización de los Ministerios.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/LEY PROVINCIAL 5711 - Sistema de Protección Integral del Discapacitado y su Familia.pdf')}}" target="blank">* Ley N°: 5.711 - Ley Provincial de Discapacidad.</a><br>
                <a href="{{ asset('files/UTP/REGIMEN DE JUBILACIONES, RETIROS Y PENSIONES PARA TODO EL PERSONAL DEL ESTADO PROVINCIAL.pdf')}}" target="blank">* Ley 4558 régimen de jubilaciones, retiros y pensiones para todo el personal del estado provincial.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/Ley N 4547 - VENTA YO EXPENDIO DE BEBIDAS ALCOHOLICAS AL MENUDEO.pdf')}}" target="blank">* Ley N°: 4.547 - Decreto Reglamentario Serie "A" N°:0056/2.000. Licencia policial para la venta de bebidas alcohólicas al mostrador (adherida Ley Nacional N° 24.788 sobre la prohibición de venta de bebidas alcohólicas a menores que no hubieren cumplido los 18 años de edad).</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/LEY Nº 6452 - MEDIACION.pdf')}}" target="blank">* Ley N°: 6.452. Ley de mediación.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/Ley N° 6.719 - DE ETICA EN EL EJERCICIO DE LA FUNCION PUBLICA.pdf')}}" target="blank">* Ley N°: 6.719. Ley de ética en el ejercicio de la función pública.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/Ley N° 7253 - REGIMEN UNICO DE CONTRATACIONES PUBLICAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Ley N°: 7253 Registro único de contrataciones públicas.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/ACORDADA N09-2005.pdf')}}" target="blank">* Acordada 09/05 del Honorable Tribunal de cuentas de la provincia.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/ACORDADA N14-2005.pdf')}}" target="blank">* Acordada 14/05 del Honorable Tribunal de cuentas de la provincia.</a>
                <br><br>
            </p>
            {{--<h5>Circulares, edictos y decretos</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Circular General N°: 05/05 de fecha 05 de Enero de 2.005.</a><br>
                <a href="{{ asset('files/Asesoria_Letrada/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto Serie "A" N°: 704/77. Edicto y reglamento de las actividades de la Agencia de Seguridad en empresas.</a>
                <br><br>
            </p>--}}
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check2">
        <label class="accordion-label" for="check2">Dirección General de Policía Ambiental Y Rural</label>
        <div class="accordion-content">
            <h5>Normas Nacionales</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 25675 - POLITICA AMBIENTAL NACIONAL.pdf')}}" target="blank">* Ley Nacional N° 25.675 De Presupuestos Mínimos Ambientales.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 24051 - RESIDUOS PELIGROSOS.pdf')}}" target="blank">* Ley Nacional N°24.051 De Residuos Peligrosos.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 20.418 TOLERANCIAS Y LIMITES ADMINISTRATIVOS EN RESIDUOS DE PLAGUICIDAS.pdf')}}" target="blank">* Ley Nacional Nº 20.418 sobre Tolerancia de Residuos de Plaguicidas.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 27279 - PRODUCTOS FITOSANITARIOS.pdf')}}" target="blank">* Ley Nacional N°27.279 sobre Productos Fitosanitarios y Decreto Reglamentario.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 25612 - RESIDUOS INDUSTRIALES.pdf')}}" target="blank">* Ley Nacional N° 25.612 sobre Residuos Industriales y de Actividades de Servicios.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY Nº 19.587 - LEY DE HIGIENE Y SEGURIDAD EN EL TRABAJO.pdf')}}" target="blank">* Ley de Higiene y Seguridad Laboral Nº 19.587.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_nacionales/LEY 26306 - REGIMEN DEL REGISTRO DEL PATRIMONIO CULTURAL.pdf')}}" target="blank">* Ley Nacional 26.306 Régimen del Registro del Patrimonio cultural.</a>
                <br><br>
            </p>
            <h5>Normas Provinciales</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Policia_Ambiental/leyes_provinciales/LEY 1734 - CODIGO RURAL DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Ley 1.734, Código Rural de Santiago del Estero.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_provinciales/LEY 6920 - CODIGO DE PROCEDIMIENTOS MINEROS DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Ley 6.920 Código de procedimientos Mineros.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_provinciales/LEY 6321 - NORMAS GENERALES Y METODOLOGIA DE APLICACION PARA LA DEFENSA, CONSERVACION Y MEJORAMIENTO.pdf')}}" target="blank">* Ley Provincial N° 6.321 Normas Generales y Metodologías de Aplicación para la defensa, conservación y mejoramiento del Ambiente y los Recursos Naturales. </a>
                <br><br>
            </p>
            {{--<h5>Protocolos</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Policia_Ambiental/leyes_provinciales/PROTOCOLO DE REUBICACIÓN DE SECUESTROS DE VEHÍCULOS RELACIONADO A CAUSAS JUDICIALES.pdf')}}" target="blank">*  Protocolo de actuación para reubicación de secuestros o
                    incautos de vehículos vinculados con causas judiciales almacenadas en las dependencias policiales y su anexo I. Aprobado por resolución S.G N° 103/2023.</a><br>
                <a href="{{ asset('files/Policia_Ambiental/leyes_provinciales/PRINCI_1.PDF')}}" target="blank">*  Principios generales de trabajo en laboratorio.</a>
                <br><br>
            </p>--}}
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check3">
        <label class="accordion-label" for="check3">Dirección General de Planeamiento</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 2296 - TRAMITE ADMINISTRATIVO.pdf')}}" target="blank">* Ley 2296 - trámite administrativo.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24449 - LEY NACIONAL DE TRANSITO.pdf')}}" target="blank">* Ley Nacional de tránsito 24449.</a><br>
                <a href="{{ asset('files/Planeamiento/LEY 24788 - LEY NACIONAL DE LUCHA CONTRA EL ALCOHOLISMO.pdf')}}" target="blank">* Ley Nacional de lucha contra el alcoholismo 24788.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check4">
        <label class="accordion-label" for="check4">Dirección General de Drogas Peligrosas</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Drogas_Peligrosas/CODIGO PROCESAL PENAL FEDERAL.pdf')}}" target="blank">* Código procesal penal federal Ley N° 23.984.</a><br>
                <a href="{{ asset('files/Drogas_Peligrosas/Código Procesal Penal Federal (T.O. 2019) - LEY 27.063.pdf')}}" target="blank">* Código procesal penal federal Ley N° 27.063.</a><br>
                <a href="{{ asset('files/Drogas_Peligrosas/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO (1).pdf')}}" target="blank">* Código procesal penal de la provincia.</a><br>
                <a href="{{ asset('files/Drogas_Peligrosas/Ley Nacional N° 23737 - TENENCIA Y TRAFICO DE ESTUPEFACIENTES.pdf')}}" target="blank">* Ley Nacional N° 23737 - Tenencia Y Tráfico De Estupefacientes.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check5">
        <label class="accordion-label" for="check5">Dirección General de Asuntos Internos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24449 - LEY NACIONAL DE TRANSITO.pdf')}}" target="blank">* Ley Nacional de tránsito 24449.</a><br>
                <a href="{{ asset('files/Planeamiento/LEY 24788 - LEY NACIONAL DE LUCHA CONTRA EL ALCOHOLISMO.pdf')}}" target="blank">* Ley Nacional de lucha contra el alcoholismo 24788.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 2296 - TRAMITE ADMINISTRATIVO.pdf')}}" target="blank">* Ley 2296 - trámite administrativo.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check6">
        <label class="accordion-label" for="check6">Dirección General de Seguridad Vial</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Seguridad_Vial/Codigo de Faltas de Transito.pdf')}}" target="blank">* Código de faltas de tránsito de la provincia - reglamentación basada en el decreto de emergencia vial (Dec. Pcial. 372/14).</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check7">
        <label class="accordion-label" for="check7">Unidad de Trámite Previsional (UTP)</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/UTP/REGIMEN DE JUBILACIONES, RETIROS Y PENSIONES PARA TODO EL PERSONAL DEL ESTADO PROVINCIAL.pdf')}}" target="blank">* Ley 4558 régimen de jubilaciones, retiros y pensiones para todo el personal del estado provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 5873  SALARIAL.pdf')}}" target="blank">* Ley Salarial N° 5873/91.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 2296 - TRAMITE ADMINISTRATIVO.pdf')}}" target="blank">* Ley 2296 - trámite administrativo.</a><br>
                <a href="{{ asset('files/UTP/Ley 6081 - RATIFICACION    DEL  CONVENIO  DE  TRANSFERENCIA  DEL  INSTITUTO  DE SEGURIDAD SOCIAL  DE  LA PROVINCIA DE SANTIAGO DEL ESTERO, ETC. A LA NACION.pdf')}}" target="blank">* Ley N° 6081 Santiago ratifícase el convenio de transferencia del sistema provincial de previsión social de la provincia de Santiago del Estero a la Nación y su complementario.</a><br>
                <a href="{{ asset('files/UTP/DECRETO 646 AÑO 2009 ACTA COMPLEMENTARIA.pdf')}}" target="blank">* Decreto N° 646/2009 aprobación de acta complementaria.</a><br>
                <a href="{{ asset('files/UTP/Decreto 30-2010 - Santiago del Estero acepta Acta Complementaria.pdf')}}" target="blank">* Decreto 30/2010 - Santiago del Estero acepta acta complementaria..</a><br>
                <a href="{{ asset('files/UTP/LEY 21965 POLICIA FEDERAL.pdf')}}" target="blank">* Ley Nacional N° 21965 de Policía Federal Argentina.</a><br>
                <a href="{{ asset('files/UTP/Ley 26.657 - Ley de Salud Mental.pdf')}}" target="blank">* Ley Nacional N° 26657 - Ley de Salud Mental.</a><br>
                <a href="{{ asset('files/UTP/DICTADO DE SENTENCIA - CASAGRANDE OCTAVIA Y OTROS C ANSES Y OTROS S REAJUSTES VARIOS - UTP 1.pdf')}}" target="blank">* Dictado de sentencia caso CASAGRANDE "EXPTE N° 44515/2013 CASAGRANDE OCTAVIO Y OTROS C/ANSES Y OTRO S/REAJUSTES VARIOS.</a><br>
                <a href="{{ asset('files/UTP/Dictado de Sentencia Caso LEGUIZAMÓN OSCAR ISMAEL C ADMINISTRACIÓN NACIONAL DE LA SEGURIDAD SOCIAL (ANSES) Y OTRO S REAJUSTES VARIOS 1.pdf')}}" target="blank">* Dictado de sentencia caso LEGUIZAMÓN OSCAR ISMAEL C/ADMINISTRACIÓN NACIONAL DE LA SEGURIDAD SOCIAL (ANSES) Y OTRO S/ REAJUSTES VARIOS.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención Americana sobre Derechos Humanos.pdf')}}" target="blank">* Convención americana sobre derechos humanos (Pacto San José de Costa Rica).</a>
                {{--<a href="{{ asset('files/UTP/REGLAMENTO - INSTRUCTIVO DE TRABAJO - UTP.pdf')}}" target="blank">* Resolución de ANSES N° 540/07 pautas para creación de U.T.P. y lineamientos de trabajo.</a>--}}
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check8">
        <label class="accordion-label" for="check8">Dirección General de Asuntos Judiciales</label>
        <div class="accordion-content">
            <h5>Normativa Nacional</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONVENCION DE BELEM DO PARA.pdf')}}" target="blank">* Convención de belem do para.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24449 - LEY NACIONAL DE TRANSITO.pdf')}}" target="blank">* Ley Nacional de tránsito N° 24449.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 22172 - COMUNICACION ENTRE TRIBUNALES.pdf')}}" target="blank">* Ley Nacional 22172 Sobre comunicación entre tribunales de la República de distinta jurisdicción territorial.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley Nacional 26743 - Identidad de Genero.pdf')}}" target="blank">* Ley Nacional 26743 de identidad de género.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24.660 - EJECUCION DE LA PENA PRIVATIVA DE LA LIBERTAD.pdf')}}" target="blank">* Ley Nacional 24660 Ejecución de la pena privativa de la libertad.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley 26061.pdf')}}" target="blank">* Ley Nacional 26061 de protección integral de los derechos de las niñas, niños y adolescentes.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley 24417 CONTRA LA VIOLENCIA FAMILIAR.pdf')}}" target="blank">* Ley Nacional 24417 de protección contra la violencia familiar.</a>
                <br><br>
            </p>
            <h5>Normativa Provincial</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de Procedimiento Penal.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a><br>
                <a href="{{ asset('files/Asuntos_Judiciales/Provincial/Ley provincial 7344 - Prevencion contra la tortura.pdf')}}" target="blank">* Ley 7344 mecanismo provincial de prev. de la tortura y otros tratos o penas crueles, inhumanos o degradantes de la prov. de Santiago del Estero.</a><br>
                <a href="{{ asset('files/Asuntos_Judiciales/Provincial/LEY 6.308 - VIOLENCIA FAMILIAR.pdf')}}" target="blank">* Ley 6308 Violencia Familiar.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check9">
        <label class="accordion-label" for="check9">Departamento de Reconocimiento Ciudadano</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Reconocimiento_Ciudadano/Ley 25326 - PROTECCION DATOS PERSONALES.pdf')}}" target="blank">* Ley 25326 de protección de datos personales.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check10">
        <label class="accordion-label" for="check10">Oficina Santiago Acompaña</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY Nº 26.485 - VIOLENCIA CONTRA LA MUJER.pdf')}}" target="blank">* Ley Nacional 26485 de protección integral a las mujeres.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley Nacional 27499 - Micaela.pdf')}}" target="blank">* Ley Nacional 27499 Micaela.</a><br>
                <a href="{{ asset('files/Santiago_A/Ley 7032.pdf')}}" target="blank">* Ley Provincial 7032 prevención, sanción y erradicación de la violencia contra las mujeres.</a><br>
                {{--<a href="{{ asset('files/Santiago_A/CONVENIO ENTRE MINISTERIO DE JUSTICIA Y DDHH Y EL MINISTERIO DE SEG Y CULTO - OF SGO ACOMPAÑA.pdf')}}" target="blank">* Convenio entre Ministerio de Justicia y DDHH y el Ministerio de Seguridad y culto.</a>--}}
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check11">
        <label class="accordion-label" for="check11">División Secuestros Judiciales</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Secuestros/Ley 20785 - BIENES OBJETO DE SECUESTRO.pdf')}}" target="blank">* Ley 20785 bienes objeto de secuestro en causas penales. Custodia y disposición.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check12">
        <label class="accordion-label" for="check12">Centro Único de Detenidos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Declaración Universal de Derechos Humanos y Declaración Americana de los Derechos Hombre.pdf')}}" target="blank">* Declaración universal de derechos humanos y declaración americana de los derechos del hombre.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención Americana sobre Derechos Humanos.pdf')}}" target="blank">* Convención americana sobre derechos humanos.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención sobre los derechos del Niño.pdf')}}" target="blank">* Convención sobre los derechos del niño.</a><br>
                {{--<a href="{{ asset('files/CUD/Reglamento General de Procesados.pdf')}}" target="blank">* Reglamento general de procesados - Decreto N° 303/96 modificado por Decreto N° 1464/07.</a><br>--}}
                <a href="{{ asset('files/CUD/Reglamento de las Modalidades Básicas de la Ejecución Penal.pdf')}}" target="blank">* Reglamento de las modalidades básicas de la ejecución penal - Decreto N° 396/99.</a>
                {{--<a href="{{ asset('files/CUD/Reglamento de Disciplina para los Internos.pdf')}}" target="blank">* Reglamento de disciplina para los internos - Decreto N° 18/97.</a><br>
                <a href="{{ asset('files/CUD/Reglamento de Comunicaciones de los Internos.pdf')}}" target="blank">* Reglamento de comunicaciones de los internos - Decreto N° 1136/97..</a>--}}
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check13">
        <label class="accordion-label" for="check13">Dirección General de Recursos Humanos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTARIO 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Decreto reglamentario 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check14">
        <label class="accordion-label" for="check14">Departamento de Reconocimiento Médico</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/DEC REGLAMENTO 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Decreto reglamento 4794 - generalidades para el personal policial.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/LEY PROVINCIAL 5711 - Sistema de Protección Integral del Discapacitado y su Familia.pdf')}}" target="blank">* Ley Provincial N° 5711 "Sistema de protección integral del discapacitado y su familia".</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/LEY 24557 - RIESGOS DEL TRABAJO.pdf')}}" target="blank">* Ley de Riesgo de Trabajo N° 24.557.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/Decreto Nacional 659_96 - Tabla de Incapacidades.pdf')}}" target="blank">* Decreto N° 659/1996.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/Ley 24.241 - Sistema Integrado de Jubilaciones y Pensiones.pdf')}}" target="blank">* Ley Previsional N° 24241.</a><br>
                <a href="{{ asset('files/Reconocimiento_Medico/Decreto N° 478-98 - SISTEMA INTEGRADO DE JUBILACIONES Y PENSIONES.pdf')}}" target="blank">* Decreto N° 478/98.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check15">
        <label class="accordion-label" for="check15">División Prevención y Protección contra el Alcoholismo</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Div_Alcoholismo/Ordenanza N° 418-205.pdf')}}" target="blank">* Ordenanza N° 418/05 ciudad de La Banda – Código de Faltas Municipal.</a><br>
                <a href="{{ asset('files/Planeamiento/LEY 24788 - LEY NACIONAL DE LUCHA CONTRA EL ALCOHOLISMO.pdf')}}" target="blank">* Ley Nacional de lucha contra el alcoholismo 24788.</a><br>
                <a href="{{ asset('files/Div_Alcoholismo/Ley provincial n 4547 VENTA Y-O EXPENDIO DE BEBIDAS ALCOHOLICAS AL MENUDEO.pdf')}}" target="blank">* Ley provincial n° 4547 venta y/o expendio bebidas alcohólicas al menudeo de la provincia y su decreto reglamentario.</a><br>
                <a href="{{ asset('files/Div_Alcoholismo/Ley N 7163 - Prohibición de venta, expendio o suministro de bebidas alcohólicas entre las 24 y las 9 hs..pdf')}}" target="blank">* Ley provincial n° 7163 – prohibición de venta, expendio o suministro de bebidas alcohólicas entre las 24 y las 9 hs.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check16">
        <label class="accordion-label" for="check16">Dirección General de Policía Cinetífica</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Cientifica/Manual_actuacion_lugar_hecho_escena_delito - DGPC.pdf')}}" target="blank">* Manual de actuación en el lugar del hecho y/o escena del delito.</a><br>
                <a href="{{ asset('files/Cientifica/Protocolo unificado de los MP de Arg.pdf')}}" target="blank">* Protocolo unificado de los Ministerios Públicos de la República Argentina.</a><br>
                <a href="{{ asset('files/Cientifica/Guía para el relevamiento y conservación de la evidencia.pdf')}}" target="blank">* Guía para el relevamiento y conservación de la evidencia.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check17">
        <label class="accordion-label" for="check17">Escuela de Cadetes "Cnel. Lorenzo Lugones"</label>
        <div class="accordion-content">
            <h5>Normativa Internacional</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Escuela_Cadetes/Internacional/Declaración Americana.pdf')}}" target="blank">* Declaración americana de derechos y deberes del hombre.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Convención Americana sobre Derechos Humanos.pdf')}}" target="blank">* Convención americana sobre derechos humanos (Pacto San José de Costa Rica).</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Internacional/Declaración Universal.pdf')}}" target="blank">* Declaración universal de derechos humanos.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Internacional/Pacto Internacional.pdf')}}" target="blank">* Pacto internacional de derechos civiles y políticos.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Internacional/Código de Conducta.pdf')}}" target="blank">* Código de conducta para los funcionarios encargados de hacer cumplir la ley (adoptado por la Asamblea General de las Naciones Unidas en su Resolución 34/169, del 17 de diciembre de 1979).</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Internacional/Principio bsco sobre el empleo de la fuerza.pdf')}}" target="blank">* Principios básicos sobre el empleo de la fuerza y armas de fuego por los funcionarios encargados de hacer cumplir ley. VIII Congreso de las Naciones Unidas sobre prevención del delito y tratamiento del delincuente, La Habana (Cuba) del 27 de agosto al 7 de septiembre de 1990.</a>
                <br><br>
            </p>
            <h5>Normativa Nacional</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Codigo Civil y Comercial.pdf')}}" target="blank">* Código Civil y Comercial de la Nación.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/CODIGO PROCESAL PENAL DE LA NACION.pdf')}}" target="blank">* Código Procesal Penal de la Nación.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Ley de Responsabilidad Estatal N° 26944.pdf')}}" target="blank">* Ley de Responsabilidad Estatal N° 26944.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/LEY 24449 - LEY NACIONAL DE TRANSITO.pdf')}}" target="blank">* Ley Nacional de tránsito N° 24449.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Ley Nacional 26743 - Identidad de Genero.pdf')}}" target="blank">* Ley Nacional 26743 de identidad de género.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Ley N° 20.429 de Armas y Explosivos.pdf')}}" target="blank">* Ley N° 20.429 de Armas y Explosivos.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Ley N° 20.655 de Deportes.pdf')}}" target="blank">* Ley N° 20.655 de Deportes.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Resolución 506-13 Cuerpos policiales y fuerza de seguridad. Pautas de intervención para determinadas situaciones Personas con capacidad mental.pdf')}}" target="blank">* Resolución 506/13 (Cuerpos policiales y fuerza de seguridad. Pautas de intervención para determinadas situaciones) Personas con capacidad mental. Ministerio de Seguridad de la Nación.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Resolución 1181-2011 - Colectivo LGBT.pdf')}}" target="blank">* Resolución 1181/2011 - Colectivo LGBT-- Ministerio de Seguridad de la Nación.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Resolución E- 1149-2017 - Pautas mínimas de actuación para registros personales y detención en la vía publica de personas pertenecientes al colectivo LGBT.pdf')}}" target="blank">* Resolución E- 1149/2017 - (pautas mínimas de actuación para registros personales y detención en la vía pública de personas pertenecientes al colectivo LGBT).</a>
                <br><br>
            </p>
            <h5>Normativa Provincial</h5>
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código Procesal Penal de la provincia de Santiago del Estero - Ley N°6941.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a><br>
                <a href="{{ asset('files/Escuela_Cadetes/Provincial/Ley 6283 ADHESION A LA LEY NACIONAL DE TRANSITO..pdf')}}" target="blank">* Ley Provincial de Transito (Ley N° 6283).</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4793 - ORGANICA DE LA POLICIA DE LA PROVINCIA.pdf')}}" target="blank">* Ley 4793 - orgánica de la policía de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/LEY 4794 - GENERALIDADES PARA EL PERSONAL POLICIAL.pdf')}}" target="blank">* Ley 4794 - generalidades para el personal policial.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check18">
        <label class="accordion-label" for="check18">Unidad de Explosivos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Explosivos/LEY N° 20.429 - LEY NACIONAL DE ARMAS Y EXPLOSIVOS.pdf')}}" target="blank">* Ley Nacional N° 20429 -Ley de armas y explosivos.</a><br>
                <a href="{{ asset('files/Explosivos/REGLAMENTO LEY N° 20429.pdf')}}" target="blank">* Decreto 395/75 – Reglamentación Ley 20.429 sobre armas y explosivos.</a><br>
                <a href="{{ asset('files/Explosivos/Ley Nacional N° 25886 - Delitos Con Armas De Fuego Modificación.pdf')}}" target="blank">* Ley Nacional N° 25886 - delitos con armas de fuego.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CODIGO DE FALTAS DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de faltas provincial.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check19">
        <label class="accordion-label" for="check19">División Bomberos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Bomberos/LEY 19.587 - LEY DE HIGIENE Y SEGURIDAD EN EL TRABAJO.pdf')}}" target="blank">* Ley 19.587 - Ley de higiene y seguridad en el trabajo.</a><br>
                <a href="{{ asset('files/Bomberos/DEC. REGLAMENTARIO LEY 19.587 - LEY DE HIGIENE Y SEGURIDAD EN EL TRABAJO.pdf')}}" target="blank">* Decreto 351 - Reglamentario Ley 19.587 - Ley de higiene y seguridad en el trabajo.</a><br>
                <a href="{{ asset('files/Bomberos/recorte ley 19.587 - PROTECCION CONTRA INCENDIOS.pdf')}}" target="blank">* Capítulo 18 protección contra incendios - LEY 19.587.</a><br>
                <a href="{{ asset('files/Bomberos/EDICTO POLICIAL - BOMBEROS.pdf')}}" target="blank">* Edicto policial de seguridad contra incendio del año 1997.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check20">
        <label class="accordion-label" for="check20">Registro Provincial de Armas (RE.P.AR)</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Escuela_Cadetes/Nacional/Ley N° 20.429 de Armas y Explosivos.pdf')}}" target="blank">* Ley N° 20.429 de Armas y Explosivos.</a><br>
                <a href="{{ asset('files/Explosivos/REGLAMENTO LEY N° 20429.pdf')}}" target="blank">* Decreto 395/75 – Reglamentación Ley 20.429 sobre armas y explosivos.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check21">
        <label class="accordion-label" for="check21">División homicidios y delitos complejos</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/CONSTITUCION DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Constitución Provincial.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de Procedimiento Penal.</a><br>
                <a href="{{ asset('files/Div_Homicidios/LEY 27319 - DELITOS COMPLEJOS.pdf')}}" target="blank">* Ley 27319 de delitos complejos de investigación.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/Código de conducta para funcionarios encargados de hacer cumplir la ley.pdf')}}" target="blank">* Código de conducta para funcionarios encargados de hacer cumplir la ley.</a><br>
                <a href="{{ asset('files/Div_Homicidios/PROTOCOLO FEDERAL DE INTERVENCIÓN EN LA ESCENA DEL CRIMEN O LUGAR DEL HECHO.pdf')}}" target="blank">* Protocolo federal de intervención en la escena del crimen o lugar del hecho.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check22">
        <label class="accordion-label" for="check22">Departamento Trata de Personas</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino. Y sus articulos:<br>
                    <small class="ml-5">Art. 119 (Abuso sexual)</small><br>
                    <small class="ml-5">Art 125 bis. (Promoción y facilitación a la prostitución)</small><br>
                    <small class="ml-5">Art. 131 (Grooming)</small><br>
                    <small class="ml-5">Art 128. (Material de representación sexual de niños niñas y adolescentes)</small><br>
                    <small class="ml-5">Art 140. (reducción a la servidumbre).</small>
                </a><br>
                <a href="{{ asset('files/Trata/LEY 26842 - LEY DE TRATAS.pdf')}}" target="blank">* Ley de tratas.: 26.842.</a><br>
                <a href="{{ asset('files/Trata/LEY 25871 - LEY DE MIGRACIONES.pdf')}}" target="blank">* Ley de migraciones, 25.871.</a><br>
                <a href="{{ asset('files/Trata/LEY 26061 - LEY DE PROTECCION INTEGRAL DE LOS DERECHOS DE LAS NIÑAS, NIÑOS Y ADOLESCENTES.pdf')}}" target="blank">* Ley de protección integral de los derechos de niñas niños y adolescentes: 26.061.</a><br>
                <a href="{{ asset('files/Trata/LEY 26485 - LEY DE PROTECCION INTEGRAL A LAS MUJERES.pdf')}}" target="blank">* Ley de protección integral a las mujeres: 26.485.</a><br>
                <a href="{{ asset('files/Trata/PROTOCOLO DE PALERMO.pdf')}}" target="blank">* Protocolo de Palermo: La finalidad del Protocolo de Palermo es: Prevenir y combatir la trata de personas, con especial atención a las mujeres y los niños. Proteger y ayudar a las víctimas de dicha trata, respectando plenamente sus derechos humanos; y. Promover la cooperación entre los Estados Parte para lograr los fines.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check23">
        <label class="accordion-label" for="check23">Departamento Robo y Hurto</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CONSTITUCION NACIONAL.pdf')}}" target="blank">* Constitución Nacional Argentina.</a><br>
                <a href="{{ asset('files/Normativa_General/Nacional_Internacional/CODIGO PENAL DE LA NACION ARGENTINA.pdf')}}" target="blank">* Código Penal Argentino.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley 6941 - CODIGO PROCESAL PENAL DE LA PROVINCIA DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Código de Procesal Penal de la provincia.</a><br>
                <a href="{{ asset('files/Normativa_General/Provincial/Ley N° 6910 - CÓDIGO DE PROCEDIMIENTOS  CIVIL Y COMERCIAL.pdf')}}" target="blank">* Código de Procedimiento Civil y Comercial de la provincia.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check24">
        <label class="accordion-label" for="check24">Oficina de Convenio Policial</label>
        <div class="accordion-content">
            <p class="ml-3">
                <a href="{{ asset('files/Convenio/LEY 24059 - LEY DE SEGURIDAD INTERIOR.pdf')}}" target="blank">* Ley N° 24059 – Seguridad Interior.</a>
                <br><br>
            </p>
        </div>
    </div>
</div>

@endsection
