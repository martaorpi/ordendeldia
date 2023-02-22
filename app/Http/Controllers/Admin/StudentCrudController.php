<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\Log;

use App\Mail\StudentsMailable;
use Illuminate\Support\Facades\Mail;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('Estudiante', 'Estudiantes');

        $this->crud->setShowView('vendor.backpack.student_view');
    }


    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        $this->crud->orderBy('id', 'ASC');

        $this->crud->addColumn([
            'name'=> 'last_name',
            'label'=> 'Apellido',
        ]);

        $this->crud->addColumn([
            'name'=> 'first_name',
            'label'=> 'Nombre',
        ]);

        $this->crud->addColumn([
            'name'=> 'dni',
            'label'=> 'DNI',
        ]);

        $this->crud->addColumn([
            'name'=> 'career',
            'label'=> 'Carrera',
            'type' => "relationship",
            'attribute' => "short_name",
        ]);

        $this->crud->addColumn([
            'name'=> 'cell_phone',
            'label'=> 'Tel. Cel.',
        ]);

        $this->crud->addColumn([
            'name'=> 'created_at',
            'label'=> 'Alta',
            'type'  => 'date',
            'format'   => 'l',
        ]);

        $this->crud->addColumn([
            'name'=> 'cycle',
            'label'=> 'Ciclo',
        ]);

        $this->crud->addColumn([
            'name'=> 'status',
            'label'=> 'Estado',
        ]);

        $this->crud->addColumn([
            'name'=> 'user_id',
            'label'=> 'Correo',
            'attribute' => 'email',
        ]);

        /************* FILTROS *************/

        $this->crud->addFilter([
            'name'  => 'career_id',
            'type'  => 'select2',
            'label' => 'Carrera'
        ], function() {
            return \App\Models\Career::all()->pluck('short_name', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'career_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'cycle_id',
            'type'  => 'select2',
            'label' => 'Ciclo'
        ], function() {
            return \App\Models\Cycle::all()->pluck('description', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'cycle_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
        ], [
            'Solicitado' => 'Solicitado',
            'Aprobado'=> 'Aprobado',
            'Inscripto' => 'Inscripto',
            'Rechazado' => 'Rechazado',
            'Cancelado' => 'Cancelado',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->setValidation(StudentRequest::class);
        $this->crud->setEditContentClass('col-md-8 mx-auto mt-3');

        CRUD::addField([
            'name'  => 'career',
            'label' => 'Carrera',
        ]);
        
        CRUD::addField([
            'name'  => 'last_name',
            'label' => 'Apellido',
        ]);

        CRUD::addField([
            'name'  => 'first_name',
            'label' => 'Nombre',
        ]);

        CRUD::addField([
            'name'  => 'status',
            'label' => 'Estado',
            'type' => 'enum'
        ]);

    }

    /******************************************** FUNCIONES EXTRAS ********************************************/
    public function massCheck(){
        $students = $this->crud->model::where('status', 'Aprobado')
            ->where('cycle_id', 2) //TODO:  cambiar a variable
            ->select('id')
            ->get();

        foreach ($students as $student) {
            $student->response = $this->checkStatus($student->id);
        }
        return $students;
    }
    
    public function checkStatus($id){
        $student = $this->crud->model::find($id);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://190.105.227.212/ApiInscripcion/api/token?username=5f069cd8f8a54711bc09&password=8fVHrkjz4P8wruEf0tviB/aWnLDJpz7UpXFjLfpUVFE=",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Content-type: text/plain',
                'Content-length: 0',
                "Authorization: Basic MzYzZGNlYzEtYmY1Zi00MGMyLWFmOTgtZWExNThjYjA3ODAwLmlzbXAuZWR1LmFyOlUyQkdCUFBiU2dEVllVTitxU25HMC91eVVrSStDenFoVUxER2x2Q2E0SXc9"
            ),
        ));

        $token = json_decode(curl_exec($curl));
        curl_close($curl);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          //CURLOPT_URL => 'http://190.105.227.212/ApiInscripcion/api/alumnos/tienedeuda?nrodoc='.$student->dni,
          CURLOPT_URL => 'http://190.105.227.212/ApiInscripcion/api/alumnos/pagomatricula?nrodoc='.$student->dni,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
          ),
        ));
        
        curl_exec($curl);

        if (!curl_errno($curl)) {
            switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                /*case 200:
                    return  ['statusCode'=> $http_code, 'msg' => 'Pendiente de pago' ];
                    break;

                case 204:
                    //$student->status = 'Inscripto';
                    //$student->save();
                    return  ['statusCode'=> $http_code, 'msg' => 'Estudiante al día!' ];
                    break;

                case 206:
                    $student->status = 'Inscripto';
                    $student->save();
                    return  ['statusCode'=> $http_code, 'msg' => 'El estudiante pagó la matrícula, está Inscripto' ];
                    break;

                case 404:
                    return  ['statusCode'=> $http_code, 'msg' => 'Estudiante no encontrado!' ];
                    break;
                default:
                    # code...
                    break;*/
                case 200:
                    $student->status = 'Inscripto';
                    $student->save();
                    return  ['statusCode'=> $http_code, 'msg' => 'Pagó la matrícula de pre inscripción' ];
                    break;

                case 204:
                    return  ['statusCode'=> $http_code, 'msg' => 'No pagó la matrícula de pre inscripción' ];
                    break;

                case 404:
                    return  ['statusCode'=> $http_code, 'msg' => 'Alumno no encontrado!' ];
                    break;
                default:
                    break;
            }
        }
    }
    public function customEmail($id, Request $request) 
    {  
        $student = $this->crud->model::find($id);
        $input = $request->all();

        $log = new Log;
        $log->user_admin_id = auth()->user()->id;
        $log->student_id = $id;
        $log->text = $input['val'];
        $log->type = 'Observacion enviada';
        $log->save();
        
        $student->status = 'Revision';
        $student->save();
        
        $email_destino = $student->user->email;

        $cuerpo = '<style>
            .footer-copyright-area {
                background: linear-gradient(178deg, #e12503 0%, #85060c 100%);
                padding: 20px 0px 10px 0;
                text-align: center;
                color: #fff;
                font-size: 12px;
            }
            .linea{
                padding-top:0;
                margin-top:0;
                background: black;
            }
            .link{
                color: #a52929;
                text-decoration: underline;
            }
            .link:hover{
                color: black;
            }
            </style>
            <!DOCTYPE html>
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>ISMP</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
                </head>
                <body style="margin: 0; padding: 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="500">
                        <tr style="padding-bottom:0">
                            <td align="left" bgcolor="#fff" style="border-left: 1px solid grey;border-right: 1px solid grey;">
                                <img src="https://devweb.com.ar/ismp.academico/images/logo.jpg" width="150" style="margin-bottom:0"/>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 10px 30px 20px 30px;border-left: 1px solid grey;border-right: 1px solid grey;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <p class="text-left">
                                                <b>'.utf8_decode("Luego de realizar un análisis de la documentación presentada se observa lo siguiente:").'</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td align="right" style="padding-left:40%;padding-top:0">
                                            <hr class="linea">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-left" style="padding:0 10% 0 10%" id="observaciones">'.utf8_decode($input['val']).'</p>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td align="left" style="padding-right:40%;padding-top:0">
                                            <hr class="linea">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <br><i>Gracias por elegir el ISMP<br>
                                            '.utf8_decode("Te deseamos éxitos en tu formación profesional.").'</i>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="background: linear-gradient(178deg, #e12503 0%, #85060c 100%); padding: 20px 0px 10px 0; text-align: center; color: #fff; font-size: 12px;">
                                    <p>Copyright &copy; '.date("Y").' <b>DevWeb</b> Todos los derechos reservados.</p>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </body>
            </html>';
        $this->sendMail($email_destino,$cuerpo);
        
    }

    public function sendMail($email_destino,$cuerpo){
        //$email_destino = $model->email;
        $asunto = "Informacion ISMP";
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ISMP Soporte <info@devweb.com.ar>\r\n"; 

        if($email_destino != ''){
            mail($email_destino, $asunto, $cuerpo, $headers);
        }
    }

    public function signUp($id){  
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://190.105.227.212/ApiInscripcion/api/token?username=5f069cd8f8a54711bc09&password=8fVHrkjz4P8wruEf0tviB/aWnLDJpz7UpXFjLfpUVFE=",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
            'Content-type: text/plain',
            'Content-length: 0',
            "Authorization: Basic MzYzZGNlYzEtYmY1Zi00MGMyLWFmOTgtZWExNThjYjA3ODAwLmlzbXAuZWR1LmFyOlUyQkdCUFBiU2dEVllVTitxU25HMC91eVVrSStDenFoVUxER2x2Q2E0SXc9"
            ),
        ));

        $token = json_decode(curl_exec($curl));
        curl_close($curl);

        $student = $this->crud->model::find($id);

        //==Params==
        $nrodocumento=$student->dni;
        $nombre = $student->first_name;
        $apellido = $student->last_name;
        $idtipodocumento= 1;
        $email= $student->user->email;
        $direccion= $student->address;
        $sexo= "F";
        if(date('m') > 10){
            $ciclolectivo = date("Y",strtotime(date('Y')."+ 1 year"));
        }else{
            $ciclolectivo = date('Y');
        }

        $fechanacimiento = "1988/07/28";//Date('1990-01-01');
        $idcarrera = $student->career->ws_id;

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://190.105.227.212/ApiInscripcion/api/inscripcion/alumno',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "Nombre": "'.$nombre.'",
            "Apellido": "'.$apellido.'",
            "IdTipoDocumento": "'.$idtipodocumento.'",
            "NroDocumento": "'.$nrodocumento.'",
            "FechaNacimiento": "'.$fechanacimiento.'",
            "EMail": "'.$email.'",
            "Direccion": "'.$direccion.'",
            "Sexo": "'.$sexo.'",
            "IdCarrera": "'.$idcarrera.'",
            "CicloLectivo" : "'.$ciclolectivo.'"
        }',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$token,
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);

        $enviado = "Nombre: ".$nombre.",
            Apellido: ".$apellido.",
            IdTipoDocumento: ".$idtipodocumento.",
            NroDocumento: ".$nrodocumento.",
            FechaNacimiento: ".$fechanacimiento.",
            EMail: ".$email.",
            Direccion: ".$direccion.",
            Sexo: ".$sexo.",
            IdCarrera: ".$idcarrera.",
            CicloLectivo : ".$ciclolectivo;

        $log = new Log;
        $log->user_admin_id = auth()->user()->id;
        $log->student_id = $id;
        $log->text = $enviado;
        $log->type = 'datos enviados';
        $log->save();
        
        $log = new Log;
        $log->user_admin_id = auth()->user()->id;
        $log->student_id = $id;
        $log->text = $response;
        $log->type = 'respuesta Cobranza';
        $log->save();

        if (!curl_errno($curl)) {
            switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                case 200:
                    $student->status = 'Aprobado';
                    $student->save();
                    
                    $studentsMail = new StudentsMailable;
                    Mail::to($student->user->email)->send($studentsMail->mailSignUpPaySistem($student->dni));

                    return $http_code;
                    break;
                case 400:
                    return $http_code;                    
                    break;
                default:
                    # code...
                    break;
            }
        }
        curl_close($curl);
    }
}
