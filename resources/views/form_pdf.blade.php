<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.center {
  margin: auto;
  width: 530px;
  padding: 10px;
}
.punteado{
  border-style: dashed double;
  border-width: 2px;
  border-color: #000;
}
.negrita{font-weight:bold;}
.tope0{margin-top:40px}
.tope1{margin-top:30px}
.tope2{margin-top:12px}
.tdSinEspacio{width: 15px;}
.tdSinEspacio1{width: 650px;}
.tdSinEspacio2{width: 30px; height: 35px;}
.tableFila{width: 100%; }
.tableFila2{width: 50%; }
.tableFila3{width: 33%; }
.h7{font-size: 13px;}
</style>

@php
  function mayus($str){
    return ucwords(strtolower($str));
  }
@endphp

<table border="0">
    <tr>
        <td>
            <img src="images/logo.jpg" width="150">
        </td>
        <td>
            <table class="center h6" border="1">
                <tr>
                    <th colspan="3" class="text-center h5 negrita" >Solicitud de Inscripcion {{ $estudiante->cycle->description }}</td>
                </tr>
                <tr>
                    <td class="text-center" id="formFecha">{{ date('d/m/Y',strtotime($estudiante->created_at)) }}</td>
                    <td class="text-center">Legajo N° <?= $estudiante->dni?></td>
                    <td class="text-center" >Formulario N° <?= $estudiante->id ?> </td>
                </tr>
                <tr>
                    <td colspan="3" class="h5 text-center negrita">{{ $estudiante->career->title }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
   
<table class="tope1 h6">
    <tr>
        <td class="border-bottom border-dark negrita"><span>1. Datos Personales</span></td>
    </tr>
</table>

<table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Apellidos: </td>
            <td class="border-bottom border-dark">{{ mayus($estudiante->last_name) }}</td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Nombres: </td>
            <td class="border-bottom border-dark">{{ mayus($estudiante->first_name) }}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>

<table class="tableFila tope2">
  <tr>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio" style="width:70px;" >D.N.I.: </td>
          <td class="border-bottom border-dark">{{ $estudiante->dni }}</td>
        </tr>
      </table>
    </td>
    <td class="tableFila2">
      <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Fecha_de_Nacimiento: </td>
            <td class="border-bottom border-dark">
              @if($estudiante->date_birth)
                  {{ date('d/m/Y',strtotime($estudiante->date_birth)) }}
              @endif
            </td>
          </tr>
      </table>
    </td>
  </tr>
</table>

<table class="tableFila tope2">
  <tr>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio" style="width:70px;" >Tel_Fijo: </td>
          <td class="border-bottom border-dark">{{ $estudiante->landline }}</td>
        </tr>
      </table>
    </td>
    <td class="tableFila2">
      <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Tel_Celular: </td>
            <td class="border-bottom border-dark">
              {{ $estudiante->cell_phone }}
            </td>
          </tr>
      </table>
    </td>
  </tr>
</table>

<table class="tableFila tope2">
  <tr>
    <td class="tableFila2">
      <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Nacionalidad: </td>
            <td class="border-bottom border-dark">
              @if($estudiante->nationality)
                  {{ $estudiante->nationality->description }}
              @endif
            </td>
          </tr>
      </table>
    </td>
    <td class="tableFila2">
      <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Email: </td>
            <td class="border-bottom border-dark">
              {{ auth()->user()->email }}
            </td>
          </tr>
      </table>
    </td>
  </tr>
</table>

<table class="tope1 h6">
    <tr>
        <td class="border-bottom border-dark negrita"><span>2. Domicilio Real</span></td>
    </tr>
</table>
  
<table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Provincia: </td>
            <td class="border-bottom border-dark">
              @if ($estudiante->province)
                  {{ $estudiante->province->description }}
              @endif
            </td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Departamento: </td>
            <td class="border-bottom border-dark">
              @if ($estudiante->department)
                  {{ $estudiante->department->description }}
              @endif
            </td>
          </tr>
        </table>
      </td>
    </tr>
</table>

<table class="tableFila tope2">
  <tr>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio">Localidad: </td>
          <td class="border-bottom border-dark">
            @if ($estudiante->location)
                {{ $estudiante->location->description }}
            @endif
          </td>
        </tr>
      </table>
    </td>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio">Dirección: </td>
          <td class="border-bottom border-dark">{{ $estudiante->address }}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table class="tope1 h6">
  <tr>
      <td class="border-bottom border-dark negrita"><span>3. Domicilio Legal</span></td>
  </tr>
</table>

<table class="tableFila tope2">
  <tr>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio">Provincia: </td>
          <td class="border-bottom border-dark">
            @if ($estudiante->province_legal)
                {{ $estudiante->province_legal->description }}
            @endif
          </td>
        </tr>
      </table>
    </td>
    <td class="tableFila2">
      <table class="tableFila">
        <tr>
          <td class="tdSinEspacio">Departamento: </td>
          <td class="border-bottom border-dark">
            @if ($estudiante->department_legal)
                {{ $estudiante->department_legal->description }}
            @endif
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Localidad: </td>
            <td class="border-bottom border-dark">
              @if ($estudiante->location_legal)
                  {{ $estudiante->location_legal->description }}
              @endif
            </td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Dirección: </td>
            <td class="border-bottom border-dark">{{ $estudiante->address_legal }}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<br>
<p class="h7 negrita">COMPROMISO CON LA INSTITUCIÓN</p>
<p class="h7 text-justify">Por medio de la presente, declaro conocer y aceptar todas las disposiciones contenidas en los reglamentos del Instituto Superior San Martin de Porres, referentes a las condiciones académicas, disciplinarias, de matriculación, abono de cuota y otros conceptos. Comprometiéndome de plena conformidad y propia voluntad a respetarlos estrictamente.</p>
<p class="h7 negrita">INFORMACIÓN IMPORTANTE A TENER EN CUENTA</p>
<p class="h7 text-justify negrita">USTED ADQUIRIRÁ LA CPMDICIÓN DE ESTUDIANTE REGULAR CON LA INSCRIPCIÓN DEFINITIVA, QUE COMPRENDE: EL CUMPLIMIENTO DE TODOS LOS REQUISITOS EXIGIDOS Y LA ASISTENCIA AL TALELR PROPEDÉUTICO</p>
<p class="h7 text-justify">* La inscripción será validada a partir del momento en que se acredite el pago de dicho arancel, dentro de las fechas establecidas por la institución y la presentación de la documentación correspondiente.</p>
<p class="h7 text-justify">* Por el pago de la inscripción el ingresante tiene derecho a realizar el taller propedéutico <b>NO SIENDO EL MONTO REINTEGRABLE POR NINGÚN CONCEPTO.</p>
<p class="h7 text-justify">* Los montos fijados para las cuotas mensuales pueden ser modificadas por el instituto a lo largo del ciclo lectivo, en caso de que haya una variación significativa en la estructura de costos internos.</p>
<p class="h7 text-justify">* Los alumnos que registren deuda de cuotas al momento de rendir exámenes parciales y/o finales, NO PODRÁN INSCRIBIRSE a los mismos hasta tanto no regularicen su situación.</p>
<p class="h7 text-justify">* Los alumnos que requieran Certificación de Finalización de Estudios y/o Constancia de Título en trámite, NO PODRÁN solicitarla si registran deuda con el Instituto, hasta tanto no regularicen su situación.</p>
<br><br>

{{--<table style="border-bottom:1px solid;border-collapse:separate;border-spacing:-30px;text-align:center;" class="tableFila tope0">--}}
<table class="tableFila tope0">
  <tr style="text-align:center;">
    <td>__________________________ </td>
    <td>________________________ </td>
    <td>________________________ </td>
  </tr>
  <tr style="text-align:center;">
      <td>Aclaracion de Apellido y Nombre</td>
      <td>Tipo y N° de Documento</td>
      <td>Firma del Alumno/a</td>
  </tr>
</table>
<br>
<p class="h6 tope1 negrita">CONTROL DE DOCUMENTACION</p>
<table class="tope2">
<tr>
    <td class="h6 tdSinEspacio1">1.- Formulario virtual impreso. </td>
    <td class="border border-dark tdSinEspacio2"></td>
</tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">2.- Certificado de finalización de estudios o título secundario. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">3.- Fotocopia del DNI. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">4.- Dos (2) foto carnet 4x4. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">5.- Firma del Acuerdo. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">6.- Certificado Residencia. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">7.- Carpeta colgante. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">8.- Ficha de Aptitud Psicofísica. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">9.- Certificado de antecedentes penales (expedido por la policía de la provincia de Santiago del Estero o de la provincia en la que tenga residencia). </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<table class="tope2">
  <tr>
      <td class="h6 tdSinEspacio1">10.- Acta de nacimiento actualizada y legalizada. </td>
      <td class="border border-dark tdSinEspacio2"></td>
  </tr>
</table>

<br><br>
<table class="punteado" >
<tr>
    <td class="text-justify px-2"> ATENCIÓN: UNA VEZ PRESENTADA LA FICHA DE INSCRIPCIÓN Y LA DOCUMENTACIÓN CORRESPONDIENTE, 
    EL PERSONAL DEL ISMP QUE LO ATIENDA, LE ENTREGARÁ EL CUPÓN PARA PAGO DE MATRICULA, 
    EL QUE TENDRÁ VALIDÉZ ÚNICAMENTE ESE DÍA. ELLO CON EL FIN DE PRESERVAR SU CUPO EN LA CARRERA SELECCIONADA</td>
</tr>
</table>