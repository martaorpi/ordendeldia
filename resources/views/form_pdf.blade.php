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
.tope0{margin-top:50px}
.tope1{margin-top:30px}
.tope2{margin-top:12px}
.tdSinEspacio{width: 15px;}
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
                    <th colspan="3" class="text-center h5 negrita" >Solicitud de Inscripcion {{ Date('Y') }}</td>
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
              <td class="tdSinEspacio">Nacionalidad: </td>
              <td class="border-bottom border-dark">{{ $estudiante->nationality->description }}</td>
            </tr>
        </table>
      </td>
    </tr>
</table>

<table class="tope1 h6">
    <tr>
        <td class="border-bottom border-dark negrita"><span>2. Domicilio</span></td>
    </tr>
</table>
  
<table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Provincia: </td>
            <td class="border-bottom border-dark">{{ $estudiante->province->description }}</td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Departamento: </td>
            <td class="border-bottom border-dark">{{ $estudiante->department->description }}</td>
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
            <td class="border-bottom border-dark">{{ $estudiante->location->description }}</td>
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
<br>

<p class="h7 text-justify">Por medio de la presente, declaro conocer y aceptar todas las disposiciones contenidas en los Reglamentos del instituto San Martin de Porres referentes a las disposiciones academicas y diciplinarias a las condiciones de matriculacion abono de cuotas y otros conceptos, asi como otras resoluciones que emita la autoridad competente y comprometo a respetarlos estrictamente.</p>
<p class="h7 text-justify negrita">EL INGRESANTE ADQUIRIRÁ LA CONDICION DE ESTUDIANTE REGULAR CON LA INSCRIPCIÓN DEFINITIVA QUE COMPRENDE: EL CUMPLIMIENTO DE TODOS LOS REQUISITOS EXIGIDOS Y LA ASISTENCIA AL TALLER PROPEDEUTICO.</p>
<p class="h7 negrita">INFORMACION IMPORTANTE A TENER EN CUENTA</p>

<p class="h7 text-justify">* La inscripcion sera valida a partir del momento en que se acredite el pago de dicho arancel,
sea en el instituto o en la entidad financiera correspondeinte, dentro de las fechas establecidas por la institucion y
la presentacion de la documentacion correspondiente.
</p>
<p class="h7 text-justify">* Por el pago de la inscripcón, el ingresante tiene derecho, a realizar el taller propedéutico, 
<b class="h7 border-bottom border-dark negrita">NO SIENDO EL MONTO REINTEGRABLE POR NINGUN CONCEPTO.</b> El ingresante adquiere la condicion de estudiante regular por el pago de la matricula completa, 
la realización del taller propedéutico y la presentación de todos los requisitos establecidos por la institución.</p>

<p class="h7 text-justify">*Los montos fijados para las cuotas mensuales, pueden ser modificadas por el instituto a lo largo del ciclo electivo, 
en caso de que haya una variacion significativa en la estructura de costos internos.
</p>
<br><br><br>

<table style="border-bottom:1px solid;border-collapse:separate;border-spacing:-30px;text-align:center;" class="tableFila tope0">
<tr>
    <td>Aclaracion de Apellido y Nombre</td>
    <td>Tipo y N° de Documento</td>
    <td>Firma del Alumno/a</td>
</tr>
</table>
<br>
<br>
<p class="h6 tope1 negrita">CONTROL DE DOCUMENTACION</p>
<table class="tope2">
<tr>
    <td class="h6 tdSinEspacio">1.- Solicitud de Inscripcion Completa. </td>
    <td class="border border-dark tdSinEspacio"></td>
</tr>
</table>
<table class="tope2">
<tr>
    <td class="h6 tdSinEspacio">2.- Fotocopia de DNI (actualizado) frente y reverso. </td>
    <td class="border border-dark tdSinEspacio"></td>
</tr>
</table>
<table class="tope2">
<tr>
    <td class="h6 tdSinEspacio">3.- Foto Carnet color (4 x 4). </td>
    <td class="border border-dark tdSinEspacio"></td>
</tr>
</table>
<br><br>
<table class="punteado" >
<tr>
    <td class="text-justify px-2"> ATENCION: UNA VEZ PRESENTADA LA FICHA DE INSCRIPCION Y LA DOCUMENTACION CORRESPONDIENTE, 
    EL PERSONAL DEL ISMP QUE LO ATIENDA, LE ENTREGARA EL CUPON PARA PAGO DE MATRICULA, 
    EL QUE TENDRA VALIDEZ UNICAMENTE ESE DIA. ELLO CON EL FIN DE PRESERVAR SU CUPO EN LA CARRERA SELECCIONADA</td>
</tr>
</table>
