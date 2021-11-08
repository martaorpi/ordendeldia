<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.center {
  margin: auto;
  width: 600px;
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
.h7{font-size: 11px;}
</style>

<?php
function mayus($str){
  return ucwords(strtolower($str));
}
function dateFormat($d){
  $date = new DateTime($d);
  return $date->format('d/m/Y');
}
function isAlive($bool){
  if($bool){
    return "si";
  }else{
    return "no";
  }
}
function dependenciaEconomica($dep){
  switch ($dep) {
    case 1:
      return 'Padres';
      break;
    case 2:
      return 'Parientes';
      break;
    case 3:
      return 'Otros';
      break;
    case 4:
      return 'de Nadie';
      break;
  }
}
function religion($rel){
  switch ($rel) {
    case 1:
      return 'Católica';
      break;
    case 2:
      return 'Otra';
      break;
    case 3:
      return 'Ninguna';
      break;
  }
}
function sacramento($rel){
  switch ($rel) {
    case 1:
      return 'Bautismo';
      break;
    case 2:
      return 'Comunión';
      break;
    case 3:
      return 'Confirmación';
      break;
  }
}
function medios($rel){
  switch ($rel) {
    case 1:
      return 'Radio';
      break;
    case 2:
      return 'Televisión';
      break;
    case 3:
      return 'Diario';
      break;
    case 4:
      return 'Redes Sociales';
      break;
    case 5:
      return 'Folletos';
      break;
    case 6:
      return 'Un profesional';
      break;
    case 7:
      return 'Otros';
      break;
  }
}
function motivos($rel){
  switch ($rel) {
    case 1:
      return 'Mis padres creen que es una buena opción';
      break;
    case 2:
      return 'Es una carrera corta';
      break;
    case 3:
      return 'Es muy costoso seguir una carrera universitaria';
      break;
    case 4:
      return 'Quiero que esta sea mi profesión';
      break;
  }
}
$session = Yii::$app->session;
?>
<div class="row">
  <div class="col-sm-12">
    <div class="">
      <div class="card-body" style="margin:0 auto">
        <img src="<?php echo Yii::$app->homeUrl?>img/header.png" alt="">
      </div>
    </div>
  </div>
</div>
<br>
<div>
  <table class="center h5" border="1" >
    <tr>
        <th colspan="2" class="text-center h4 negrita" >Solicitud Reinscripcion <?= Date('Y') ?></td>
    </tr>
    <tr>
        <td class="text-center  px-2" id="formFecha">Fecha <?= date('d/m/Y') ?>;</td>
        <td class="text-center  px-2">Legajo N°: <?= $modelForm->dni?></td>
    </tr>
    <tr>
        <td class="text-center w-50 px-2" >Formulario N°: <?= $modelForm->id_fomrulario ?> </td>
        <td class="text-center w-50 px-2" id="formContra">Contraseña: <?= $modelForm->clave ?></td>
    </tr>
  </table>

  <table class="tope1 tableFila h5">
    <tr>
      <td class="tdSinEspacio negrita"><span>Carrera:</span></td><td class="border-bottom border-dark negrita"><?php
        echo explode("(", $modelForm->carrera->descripcion)[0];
        $modelForm->carrera->descripcion ?>
      </td>
    </tr>
  </table>
  <table class="tope1 h5">
    <tr>
      <td class="border-bottom border-dark negrita"><span>1.Datos Personales</span></td>
    </tr>
  </table>


  <table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Apellidos(Completo):</td>
            <td class="border-bottom border-dark"><?=  mayus($modelForm->apellido) ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Nombres(Completo):</td>
            <td class="border-bottom border-dark"><?=  mayus($modelForm->nombre.' '.$modelForm->apellido) ?></td>
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
            <td class="tdSinEspacio" style="width:70px;" >D.N.I. N°:</td>
            <td class="border-bottom border-dark"><?=  $modelForm->dni ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">C.U.I.L.:</td>
            <td class="border-bottom border-dark"><?= $modelForm->cuil ?></td>
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
            <td class="tdSinEspacio" style="width:150px;" >Fecha de Nacimiento:</td>
            <td class="border-bottom border-dark"><?= dateFormat($modelForm->fecha_nacimiento) ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio"  style="width:155px;">Lugar de Nacimiento:</td>
            <td class="border-bottom border-dark"><?php if(isset($modelForm->localidadNac->descripcion) ){
              echo $modelForm->localidadNac->descripcion;
            }
            if(isset($modelForm->departamentoNac->descripcion) ){
              echo ', '.$modelForm->departamentoNac->descripcion;
            }
           ?></td>
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
            <td class="tdSinEspacio">Provincia</td>
            <td class="border-bottom border-dark"><?= $modelForm->provinciaNac->descripcion ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Nacionalidad</td>
            <td class="border-bottom border-dark"><?php if(isset($modelForm->nacionalidadNac->denominacion)){
              echo $modelForm->nacionalidadNac->denominacion;
            } ?></td>
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
            <td class="tdSinEspacio" style="width:90px;">Estado Civil:</td>
            <td class="border-bottom border-dark"><?= $modelForm->estadoCivil->denominacion ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio" style="width:85px;">N° de Hijos:</td>
            <td class="border-bottom border-dark"><?= $modelForm->n_hijos ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <p class="h6 tope1 negrita" style="text-align:justify">LUGAR DE RESIDENCIA ACTUAL (Si es del interior indicar domicilio en la ciudad de Santiago del Estero)</p>
  <table class="tope2 tableFila">
    <tr>
      <td style="width:275px;">Domicilio Legal (el que figura en el DNI):</td><td class="border-bottom border-dark"><?= $modelForm->direccionLegal.', Barrio '.$modelForm->barrioLegal->descripcion ?></td>
    </tr>
  </table>  
  <table class="tope2 tableFila">
    <tr>
      <td style="width:290px;">Domicilio Real (donde reside actualmente):</td><td class="border-bottom border-dark"><?= $modelForm->direccionReal.', Barrio '.$modelForm->barrioReal->descripcion ?></td>
    </tr>
  </table>  
  <p class="h6 tope1 negrita" style="text-align:justify">DATOS DE CONTACTO</p>  
  <table class="tableFila tope2">
    <tr>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">E-Mail:</td>
            <td class="border-bottom border-dark"><?= $modelForm->email ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Tel-Fijo:</td>
            <td class="border-bottom border-dark"><?= $modelForm->telefono_fijo ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Tel-Cel:</td>
            <td class="border-bottom border-dark"><?= $modelForm->telefono_celular ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table> 
  <table class="tope1 h5">
    <tr>
      <td class="border-bottom border-dark negrita"><span>2.Datos Familiares</span></td>
    </tr>
  </table>

  <table class="tableFila tope2">
    <tr>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio" style="width:125px;">Nombre del Padre</td>
            <td class="border-bottom border-dark"><?= $modelForm->nombre_padre ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio" style="width:145px;">¿Vive?-<?= strtoupper(isAlive($modelForm->padre_vive)) ?>-Ocupación: </td>
            <td class="border-bottom border-dark"><?= $modelForm->padre_ocupacion;?></td>
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
            <td class="tdSinEspacio" style="width:140px;">Nombre de la Madre</td>
            <td class="border-bottom border-dark"><?= $modelForm->nombre_madre ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila2">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio" style="width:145px;">¿Vive?-<?= strtoupper(isAlive($modelForm->madre_vive)) ?>-Ocupación: </td>
            <td class="border-bottom border-dark"><?= $modelForm->madre_ocupacion;?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br><br>
  <p class="h6 tope1 negrita">CONTACTO EN CASO DE URGENCIAS <small>(Debe residir en Dpto. Capital o Banda)</small></p>
  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:130px;">Nombre Completo:</td><td class="border-bottom border-dark"><?= $modelForm->contacto_urgencia ?></td>
    </tr>
  </table>
  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio">Domicilio:</td><td class="border-bottom border-dark">
        <?= $modelForm->domicilio_urgencia ?>
      </td>
    </tr>
  </table>

  <table class="tableFila tope2">
    <tr>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">E-Mail:</td>
            <td class="border-bottom border-dark"><?= $modelForm->emailUrg ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Tel-Fijo:</td>
            <td class="border-bottom border-dark"><?= $modelForm->telefono_fijoUrg ?></td>
          </tr>
        </table>
      </td>
      <td class="tableFila3">
        <table class="tableFila">
          <tr>
            <td class="tdSinEspacio">Tel-Cel:</td>
            <td class="border-bottom border-dark"><?= $modelForm->telefono_celularUrg ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table> 

  <table class="tope1 h5">
    <tr>
      <td class="negrita"><span class="border-bottom border-dark ">3.Situacion Económica:</span></td>
    </tr>
  </table>
  <?php if($modelForm->trabaja){?>
    <table class="tope2 tableFila">
      <tr>
        <td class="tdSinEspacio" style="width:165px">¿Trabaja actualmente? </td>
        <td class="border-bottom border-dark">SI en <?= $modelForm->trabajo ?></td>
      </tr>
    </table>
  <?php }else{ ?>
    <table class="tope2 tableFila">
      <tr>
        <td class="tdSinEspacio" style="width:240px">No trabaja, depende economicamente de:</td><td class="border-bottom border-dark"><?= dependenciaEconomica($modelForm->dependencia_economica) ?></td>
      </tr>
    </table>
  <?php } ?>
  <br>
  <small>"EL HORARIO DE CURSADA DE CADA UNIDAD CURRICULAR NO SERA FACTIBLE DE MODIFICAR POR NECESIDADES PERSONALES DE CUALQUIER INDOLE"</small>
  <table class="tope1 h5">
    <tr>
      <td class="negrita"><span class="border-bottom border-dark ">4.Datos Academicos:</span></td>
    </tr>
  </table>
  <?php if ($modelForm->titulo_secundario != ''){?>
    <table class="tope2 tableFila">
      <tr>
        <td class="tdSinEspacio" style="width:130px">Titulo Secundario:</td><td class="border-bottom border-dark"><?= $modelForm->titulo_secundario ?></td>
      </tr>
    </table>
    <table class="tableFila tope2">
      <tr>
        <td class="tableFila2">
          <table class="tableFila">
            <tr>
              <td class="tdSinEspacio">Establecimiento:</td>
              <td class="border-bottom border-dark"><?= $modelForm->establecimiento_secundario ?></td>
            </tr>
          </table>
        </td>
        <td class="tableFila2">
          <table class="tableFila">
            <tr>
              <td class="tdSinEspacio">Localidad:</td>
              <td class="border-bottom border-dark">
                <?php
                if($modelForm->id_localidadSec != null && $modelForm->id_departamentoSec != null){
                  echo $modelForm->localidadSec->descripcion.', '. $modelForm->departamentoSec->descripcion;
                } ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <p class="h6 tope1"><span class="negrita">TITULO TERCIARIO Y/O UNIVERSITARIO</span>(OPCIONAL)</p>
    <table class="tableFila tope2">
      <tr>
        <td class="tableFila2">
          <table class="tableFila">
            <tr>
              <td class="tdSinEspacio">Titulo:</td>
              <td class="border-bottom border-dark"><?= $modelForm->titulo_terciario1 ?></td>
            </tr>
          </table>
        </td>
        <td class="tableFila2">
          <table class="tableFila">
            <tr>
              <td class="tdSinEspacio" style="width:130px">Otorgado por:</td>
              <td class="border-bottom border-dark"><?= $modelForm->otorgado1 ?></td>
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
              <td class="tdSinEspacio">Titulo:</td>
              <td class="border-bottom border-dark"><?= $modelForm->titulo_terciario2 ?></td>
            </tr>
          </table>
        </td>
        <td class="tableFila2">
          <table class="tableFila">
            <tr>
              <td class="tdSinEspacio" style="width:130px">Otorgado por:</td>
              <td class="border-bottom border-dark"><?= $modelForm->otorgado2 ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  <?php }else{ ?>
  <p><b>SECUNDARIO SIN CULMINAR </b></p>
  <p style="text-align:justify"><b><i>* Debe tramitar ante el Ministerio de Educación de la Provincia la certificación correspondiente, la que será exigida al momento de la Inscripción</i></b></p>
  <?php } ?>
  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:80px">Idiomas:</td><td class="border-bottom border-dark"><?= strtoupper(isAlive($modelForm->idioma)) ?> <?= $modelForm->lista_idiomas ?></td>
    </tr>
  </table>

  <table class="tope1 h5">
    <tr>
      <td class="border-bottom border-dark negrita"><span>5.Otros</span></td>
    </tr>
  </table>

  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:200px">Culto o Religion que profesa:</td><td class="border-bottom border-dark">
        <?php echo religion($modelForm->id_religion); if($modelForm->id_religion==1){
            if($modelForm->id_sacramento != null){echo ' - '.sacramento($modelForm->id_sacramento);}} ?></td>
    </tr>
  </table>

  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:430px">¿Estaria Interesado en participar del voluntariado institucional?:</td><td class="border-bottom border-dark">
        <?= strtoupper(isAlive($modelForm->voluntariado)) ?>
      </td>
    </tr>
  </table>

  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:315px">¿A traves de que medio conoce la institucion?:</td><td class="border-bottom border-dark">
        <?= medios($modelForm->id_medio) ?>
      </td>
    </tr>
  </table>

  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:310px">¿Cual es la motivacion para elegir la carrera?:</td><td class="border-bottom border-dark">
        <?= motivos($modelForm->id_motivo) ?>
      </td>
    </tr>
  </table>

  <table class="tope2 tableFila">
    <tr>
      <td class="tdSinEspacio" style="width:310px">Necesidades educativas especiales:</td><td class="border-bottom border-dark">
        <?= isAlive($modelForm->n_especial) ?>
      </td>
    </tr>
  </table>

  <table class="tope1 h5">
    <tr>
      <td class="border-bottom border-dark negrita"><span>6.COMPROMISO CON LA INSTITUCION</span></td>
    </tr>
  </table>
  <p class="text-justify">Por medio de la presente, declaro conocer y aceptar todas las disposiciones contenidas en los Reglamentos del instituto San Martin de Porres referentes a las disposiciones academicas y diciplinarias a las condiciones de matriculacion abono de cuotas y otros conceptos, asi como otras resoluciones que emita la autoridad competente y comprometo a respetarlos estrictamente.</p>
  <p class="h6 tope1 text-justify negrita">EL INGRESANTE ADQUIRIRÁ LA CONDICION DE ESTUDIANTE REGULAR CON LA INSCRIPCIÓN DEFINITIVA QUE COMPRENDE: EL CUMPLIMIENTO DE TODOS LOS REQUISITOS EXIGIDOS Y LA ASISTENCIA AL TALLER PROPEDEUTICO.</p>
  <br>
  
    
  <p class="h6 tope1 negrita">INFORMACION IMPORTANTE A TENER EN CUENTA</p>

  <p class="text-justify tope1">* La inscripcion sera valida a partir del momento en que se acredite el pago de dicho arancel,
    sea en el instituto o en la entidad financiera correspondeinte, dentro de las fechas establecidas por la institucion y
    la presentacion de la documentacion correspondiente.
  </p>
  <p class="text-justify tope1">* Por el pago de la inscripcón, el ingresante tiene derecho, a realizar el taller propedéutico, 
    <b class="border-bottom border-dark negrita">NO SIENDO EL MONTO REINTEGRABLE POR NINGUN CONCEPTO.</b> El ingresante adquiere la condicion de estudiante regular por el pago de la matricula completa, 
    la realización del taller propedéutico y la presentación de todos los requisitos establecidos por la institución.</p>

  <p class="text-justify tope1">*Los montos fijados para las cuotas mensuales, pueden ser modificadas por el instituto a lo largo del ciclo electivo, 
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
  <p class="h6 tope1 negrita">CONTROL DE DOCUMENTACION</p>
  <table class="tope2">
    <tr>
      <td class="h7">2.- Solicitud de Reinscripcion Completa.</td>
      <td class="border border-dark tdSinEspacio"></td>
    </tr>
  </table>
  <table class="tope2">
    <tr>
      <td class="h7">6.- Certificado de Residencia (actualizado).</td>
      <td class="border border-dark tdSinEspacio"></td>
    </tr>
  </table>
  <table class="tope2">
    <tr>
      <td class="h7">11.- En caso de contar con necesidades educativas especiales, presentar la documentacion que acredite dicha situacion.</td>
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
</div>