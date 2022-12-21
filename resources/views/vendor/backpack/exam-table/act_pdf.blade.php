<style>
.acta, .acta table{font-size: 13px;font-family:arial;}
p{
    padding:0;
    margin:5px 0 5px 0;
    text-align:justify;
}
.mayuscula{text-transform: uppercase;}
#instituto{text-decoration: underline;}
#alumnos, #alumnos th, #alumnos td {
    border: 1px solid black;
    font-size: 11px;
}
#cabecera, #cabecera th, #cabecera td {
    border: 1px solid black;
    font-size: 13px;
    
}
#tr_extra{line-height: 1.2em;}
</style>

@php
$exam_table = App\Models\ExamTable::find($id);

if($condicion == 'regulares'){
    $alumnos = App\Models\ExamInscriptions::where(['exam_table_id' => $id])
        //->andWhere('estado = 2')
        ->where('condition_exam', 'Regular')
        ->orWhere('condition_exam', 'Promoción')
        ->join('sworn_declaration_items', 'sworn_declaration_items.id', 'exam_students.sworn_declaration_item_id')
        ->join('sworn_declarations', 'sworn_declarations.id', 'sworn_declaration_items.sworn_declaration_id')
        ->join('students', 'students.id', 'sworn_declarations.student_id')
        ->orderBy('students.last_name','asc')
        ->get();
}else{
    $alumnos = App\Models\ExamInscriptions::where(['exam_table_id' => $id])
        //->andwhere('estado = 2')
        ->where('condition_exam', 'Libre')
        //->innerJoin('alumnos', 'alumnos.id = alumnos_has_examenes.id_alumno')
        //->orderBy('alumnos.apellido','asc')
        ->all();
}

if($exam_table->subject->study_plan->educative_offer_id == 1){
    switch($exam_table->subject->annual_period){
        case 1: $curso = '1er AÑO';break;
        case 2: $curso = '2do AÑO';break;
        case 3: $curso = '3er AÑO';break;
        case 4: $curso = '4to AÑO';break;
    }
}else{
    $curso = $exam_table->subject->quarterly_period.' CUARTRIMESTRE';
}

switch(date("m", strtotime($exam_table->date))){
	case '1': $mes = 'Enero';break;
	case '2': $mes = 'Febrero';break;
	case '3': $mes = 'Marzo';break;
	case '4': $mes = 'Abril';break;
	case '5': $mes = 'Mayo';break;
	case '6': $mes = 'Junio';break;
	case '7': $mes = 'Julio';break;
	case '8': $mes = 'Agosto';break;
	case '9': $mes = 'Septiembre';break;
	case '10': $mes = 'Octubre';break;
	case '11': $mes = 'Noviembre';break;
	case '12': $mes = 'Diciembre';break;
}
@endphp



<div class="acta">
    <table width="100%" id="cabecera">
        <tr>
            <td align="center"><img src="images/logo2.png" width="50" height="60"></td>
            <td align="center">
                <h3>ACTA DE EXÁMENES VOLANTES</h3>
                <b>Instituto de Estudios Superiores "SAN MARTIN DE PORRES"</b>
            </td>
            <td align="center">
                <b>LIBRO Nº: _______<br><br>
                FOLIO Nº: _______</b>
            </td>
        </tr>
    </table>
    <p class="mayuscula"><b>CARRERA: "<?= $exam_table->subject->study_plan->educative_offer->long_name?>"</b></p>
    <p><b>EXÁMENES DE ESTUDIANTES: <?= strtoupper($condicion)?></b></p>
    <p class="mayuscula"><b>UNIDAD CURRICULAR: <i>"<?= $exam_table->subject->description?>"</i></b></p>
    <p class="mayuscula"><b>CORRESPONDIENTE AL AÑO/CURSO: <?= $curso?></b></p>
    <p>A los <?= Date('j',strtotime($exam_table->date))?> días del mes de <?php echo $mes;?> del año <?php echo Date('Y',strtotime($exam_table->date))?>, 
    reunida la comisión examinadora de la asignatura mencionada, con la presencia de sus miembros, señores:</p><br>
    <table width="100%">
        <tr>
            <td width="33%"><b>1º. _________________________________</b></td>
            <td width="33%"><b>2º. _________________________________</b></td>
            <td width="33%"><b>3º. _________________________________</b></td>
        </tr>
    </table>
    <p>Procedió a cumplir su tarea, con los resultados que se consignan a continuación:</p>
    <table width="100%" id="alumnos">
        <thead>
            <tr>
                <th rowspan="2" width="7%">N° de Orden</th>
                <th rowspan="2" width="10%">Permiso de Examen N°</th>
                <th rowspan="2" width="10%">DNI</th>
                <th rowspan="2" width="28%">Apellido y Nombre</th>
                <th colspan="2" width="15%">Examen Escrito</th>
                <th colspan="2" width="15%">Examen Oral</th>
                <th colspan="2" width="15%">Calificacion Definitiva</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>Letras</th>
                <th>N°</th>
                <th>Letras</th>
                <th>N°</th>
                <th>Letras</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=0;
            foreach ($alumnos as $alumno):
                if(!function_exists('letra')){ 
                    function letra($nro) {
                        $valor = array('cero','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince','dieciseis','diecisiete','dieciocho','diecinieve','veinte','veintiuno','veintidos','veintitres','veinticuatro','veinticinco','veintiseis','veintisiete','veintiocho','veintinueve','treinta','treinta y uno','treinta y dos','treinta y tres','treinta y cuatro','treinta y cinco','treinta y seis','treinta y siete','treinta y ocho','treinta y nueve', 'cuarenta');
                        return $valor[$nro];
                    }
                }
                if(!function_exists('letradecimal')){ 
                    function letradecimal($numero) {
                        $nrodecimal = explode('.',$numero);
                        $valordecimal = '';
                        
                        return $valordecimal;
                    }
                }
                $aprobados = 0;
                $desaprobados = 0;
                $ausentes = 0;
                //if($alumno->estado > 1 && $alumno->estado != 3):
                    if($alumno->approved == 1 || $alumno->promotion == 1){$aprobados++;}
                    if($alumno->approved == 0 && $alumno->promotion == 0){$desaprobados++;}
                    if($alumno->assistance_exam == 0){$ausentes++;}
                    $i++;
                    $nro_escrito = '';
                    $letra_escrito = '';
                    $nro_oral = '';
                    $letra_oral = '';
                    $promedio = '';
                    $letra_promedio = '';
                    if($alumno->written_qualification <> null && $alumno->oral_qualification <> null){
                        $letra_escrito = letra($alumno->written_qualification).letradecimal($alumno->written_qualification);
                        $letra_oral = letra($alumno->oral_qualification).letradecimal($alumno->oral_qualification);
                        //$letra_promedio = letra($alumno->average).' '.letradecimal($alumno->average);
                    }elseif($alumno->oral_qualification <> ''){
                            $letra_escrito = letra($alumno->oral_qualification).letradecimal($alumno->oral_qualification);
                            //$letra_promedio = letra($promedio).letradecimal($promedio);
                    }elseif($alumno->written_qualification <> ''){
                        $letra_oral = letra($alumno->written_qualification).letradecimal($alumno->written_qualification);
                        //$letra_promedio = letra($promedio).letradecimal($promedio);
                    }
                    ?>
                    <tr>
                        <td align="center"><?= $i?></td>
                        <td align="center"></td>
                        <td align="center"><?= $alumno->sworn_declaration_item->sworn_declaration->student->dni?></td>
                        <td><?= strtoupper($alumno->sworn_declaration_item->sworn_declaration->student->last_name.', '.$alumno->sworn_declaration_item->sworn_declaration->student->first_name)?></td>
                        <td align="center"><?= $alumno->written_qualification ?></td>
                        <td align="center"><?= $letra_escrito ?></td>
                        <td align="center"><?= $alumno->oral_qualification ?></td>
                        <td align="center"><?= $letra_oral ?></td>
                        <td align="center"><?= $alumno->average?></td>
                        <td align="center"><?//= $letra_promedio?></td>
                    </tr>
                <?php //endif;
            endforeach; 
            for ($j = $i+1; $j <= 29; $j++) {?>
                <tr id="tr_extra">
                    <td align="center"><?= $j?></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Se hace constar que de un total de: (<?= count($alumnos)?>) <?= letra(count($alumnos))?> alumnos resultaron:</p>
    <p>Aprobados: ________________________, Desaprobados: ________________________ y Ausentes: ________________________.</p>
    <br><br>
    <table width="100%">
        <tr>
            <td align="center">____________________________</td>
            <td align="center">____________________________</td>
            <td align="center">____________________________</td>
        </tr>
        <tr>
            <td align="center">1) Firma Profesor/a</td>
            <td align="center">1) Firma Presidente</td>
            <td align="center">1) Firma Profesor/a</td>
        </tr>
    </table>
    <p><b>NOTA:</b> Toda enmienda o raspadura deberá ser salvada con la firma de todos los miembros de la comisión examinadora.</p>
</div>