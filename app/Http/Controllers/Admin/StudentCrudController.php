<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\Log;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
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

        $this->crud->addColumn([
            'name'=> 'first_name',
            'label'=> 'Nombre',
        ]);

        $this->crud->addColumn([
            'name'=> 'last_name',
            'label'=> 'Apellido',
        ]);

        $this->crud->addColumn([
            'name'=> 'dni',
            'label'=> 'DNI',
        ]);

        $this->crud->addColumn([
            'name'=> 'career',
            'label'=> 'Carrera',
        ]);

        $this->crud->addColumn([
            'name'=> 'cycle',
            'label'=> 'Ciclo',
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
        CRUD::setValidation(StudentRequest::class);

        CRUD::setFromDb(); // fields

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
        $this->setupCreateOperation();
    }

    /******************************************** FUNCIONES EXTRAS ********************************************/        

    public function rejected($id, Request $request) 
    {  
        $student = $this->crud->model::find($id);
        $input = $request->all();

        $log = new Log;
        $log->user_admin_id = auth()->user()->id;
        $log->student_id = $id;
        $log->text = $input['val'];
        $log->type = 'Rechazados';
        $log->save();
        
        $student->status = 'Rechazado';
        if($student->save()){
            return ["status" => $input];
        }else{
            return ["status" => 400];
        }

    }
    public function signUp($id) 
    {  
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
        $idtipodocumento= 2;
        $email= $student->user->email;
        $direccion= $student->address;
        $sexo= "F";

        $fechanacimiento = Date('1990-01-01');
        $idcarrera = $student->career->ws_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://190.105.227.212/ApiInscripcion/api/inscripcion/alumno",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n    \"nombre\": \".$nombre.\",\r\n    \"apellido\": \"".$apellido."\",\r\n    \"idtipodocumento\": ".$idtipodocumento.",\r\n    \"nrodocumento\": ".$nrodocumento.",\r\n    \"fechanacimiento\": \"".$fechanacimiento."\",\r\n    \"email\": \"".$email."\",\r\n    \"direccion\": \"".$direccion."\",\r\n    \"sexo\": \"".$sexo."\",\r\n    \"idcarrera\": ".$idcarrera."\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token,
                "Content-Type: application/json"
            ),
        ));
        
        curl_exec($curl);
        
        if (!curl_errno($curl)) {
            switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                case 200:  
                    echo 'estudiante dado de alta en el sistema de cobranza con éxito';

                    $student->status = 'Aprobado';
                    $student->save();
                break;
            default:
                $response = curl_exec($curl);
                //echo 'Unexpected HTTP code: ', $http_code, "\n";
                print_r($response);
            }
        }
        
        curl_close($curl);
    }
}
