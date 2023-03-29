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

<div class="accordion-wrapper">
    <div class="accordion">
        <input type="radio" name="radio-a" id="check1">
        <label class="accordion-label" for="check1">Normativa Legal General</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check2">
        <label class="accordion-label" for="check2">Dirección General De Policía Ambiental Y Rural</label>
        <div class="accordion-content">
            <h5>Normas Nacionales</h5>
            <p class="ml-3">
                <a href="{{ asset('files/leyes_nacionales/LEY 25675 - POLITICA AMBIENTAL NACIONAL.pdf')}}" target="blank">* Ley Nacional N° 25.675 De Presupuestos Mínimos Ambientales.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY 24051 - RESIDUOS PELIGROSOS.pdf')}}" target="blank">*  Ley Nacional N°24.051 De Residuos Peligrosos.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY 20.418 TOLERANCIAS Y LIMITES ADMINISTRATIVOS EN RESIDUOS DE PLAGUICIDAS.pdf')}}" target="blank">*  Ley Nacional Nº 20.418 sobre Tolerancia de Residuos de Plaguicidas.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY 27279 - PRODUCTOS FITOSANITARIOS.pdf')}}" target="blank">*  Ley Nacional N°27.279 sobre Productos Fitosanitarios y Decreto Reglamentario.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY 25612 - RESIDUOS INDUSTRIALES.pdf')}}" target="blank">*  Ley Nacional N° 25.612 sobre Residuos Industriales y de Actividades de Servicios.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY Nº 19.587 - LEY DE HIGIENE Y SEGURIDAD EN EL TRABAJO.pdf')}}" target="blank">*  Ley de Higiene y Seguridad Laboral Nº 19.587.</a><br>
                <a href="{{ asset('files/leyes_nacionales/LEY 26306 - REGIMEN DEL REGISTRO DEL PATRIMONIO CULTURAL.pdf')}}" target="blank">*  Ley Nacional 26.306 Régimen del Registro del Patrimonio cultural.</a>
                <br><br>
            </p>
            <h5>Normas Provinciales</h5>
            <p class="ml-3">
                <a href="{{ asset('files/leyes_provinciales/LEY 1734 - CODIGO RURAL DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">* Ley 1.734, Código Rural de Santiago del Estero.</a><br>
                <a href="{{ asset('files/leyes_provinciales/LEY 6920 - CODIGO DE PROCEDIMIENTOS MINEROS DE SANTIAGO DEL ESTERO.pdf')}}" target="blank">*  Ley 6.920 Código de procedimientos Mineros.</a><br>
                <a href="{{ asset('files/leyes_provinciales/LEY 6321 - NORMAS GENERALES Y METODOLOGIA DE APLICACION PARA LA DEFENSA, CONSERVACION Y MEJORAMIENTO.pdf')}}" target="blank">*  Ley Provincial
                    N° 6.321 Normas Generales y Metodologías de Aplicación para la defensa, conservación y mejoramiento del Ambiente y los Recursos Naturales. </a>
                <br><br>
            </p>
            <h5>Protocolos</h5>
            <p class="ml-3">
                <a href="{{ asset('files/leyes_provinciales/PROTOCOLO DE REUBICACIÓN DE SECUESTROS DE VEHÍCULOS RELACIONADO A CAUSAS JUDICIALES.pdf')}}" target="blank">*  Protocolo de actuación para reubicación de secuestros o
                    incautos de vehículos vinculados con causas judiciales almacenadas en las dependencias policiales y su anexo I. Aprobado por resolución S.G N° 103/2023.</a><br>
                <a href="{{ asset('files/leyes_provinciales/PROTOCOLO DE REUBICACIÓN DE SECUESTROS DE VEHÍCULOS RELACIONADO A CAUSAS JUDICIALES.pdf')}}" target="blank">*  Principios generales de trabajo en laboratorio.</a>
                <br><br>
            </p>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check3">
        <label class="accordion-label" for="check3">Dirección General De Planeamiento</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check4">
        <label class="accordion-label" for="check4">Dirección General De Policía Comunitaria</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check5">
        <label class="accordion-label" for="check5">Dirección General De Asuntos Internos</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check6">
        <label class="accordion-label" for="check6">Dirección General De Seguridad</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check7">
        <label class="accordion-label" for="check7">Dirección General De Seguridad Vial</label>
        <div class="accordion-content">
            <h5>No hay documentos cargados</h5>
        </div>
    </div>
</div>

@endsection
