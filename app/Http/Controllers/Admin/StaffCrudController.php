<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffRequest;
use App\Exports\StaffExport;
use App\Exports\LicenseExport;
use Maatwebsite\Excel\Facades\Excel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade as PDF;

/**
 * Class StaffCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StaffCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Staff::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/staff');
        CRUD::setEntityNameStrings('personal', 'personal');
        CRUD::setEditView('vendor/backpack/licenses_in_staff/show');
        CRUD::setShowView('vendor/backpack/staff/show');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::enableResponsiveTable();
        //CRUD::enableExportButtons();
        CRUD::addButtonFromView('top', 'exportStaff', 'exportStaff', 'end');
        CRUD::addButtonFromView('top', 'licenseStaff', 'licenseStaff', 'end');

        CRUD::column('name')->label('Apellido y Nombre');
        CRUD::addColumn([
            'label' => 'Función',
            'type' => 'relationship',
            'name' => 'job_id', // the method that defines the relationship in your Model
            'entity' => 'job', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('cuil')->label('Cuil');
        CRUD::column('docket')->label('Legajo');
        CRUD::column('sex')->label('Sexo');
        CRUD::column('date_birth')->label('Fecha Nac.');
        CRUD::column('address')->label('Dirección');
        CRUD::addColumn([
            'label' => 'Localidad',
            'type' => 'relationship',
            'name' => 'location_id', // the method that defines the relationship in your Model
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('landline')->label('Tel. Fijo');
        CRUD::column('cell_phone')->label('Tel. Celular');
        CRUD::column('personal_mail')->label('Correo Personal');
        CRUD::column('institutional_mail')->label('Correo Institucional');
        CRUD::column('start_date')->label('Fecha Alta');
        CRUD::column('weekly_hours')->label('Horas semanales');
        CRUD::addColumn([
            'label' => 'Asignaturas',
            'type' => 'relationship',
            'name' => 'subjects', // the method that defines the relationship in your Model
            'entity' => 'subjects', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('status')->label('Estado');
        CRUD::column('observations')->label('Observaciones');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'job_id',
            'type'  => 'select2',
            'label' => 'Función'
        ],
            function() {
                return \App\Models\Job::select()->distinct()->get()->pluck('description', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'job_id', $value);
            }
        );
        CRUD::addFilter([
            'name'  => 'sex',
            'type'  => 'select2',
            'label' => 'Sexo'
        ],
            function() {
                return [
                  'f' => 'Femenino',
                  'm' => 'Masculino',
                  'x' => 'No Binario',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'sex', $value);
            }
        );
        CRUD::addFilter([
            'name'  => 'location_id',
            'type'  => 'select2',
            'label' => 'Localidad'
        ],
            function() {
                return \App\Models\Location::select()->distinct()->get()->pluck('description', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'location_id', $value);
            }
        );
        CRUD::addFilter([
            'name'  => 'status',
            'type'  => 'select2',
            'label' => 'Estado'
        ],
            function() {
                return [
                  'Activo' => 'Activo',
                  'Bloqueado' => 'Bloqueado',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'status', $value);
            }
        );
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StaffRequest::class);

        CRUD::addField([
            'label' => 'Apellido y Nombre',
            'type' => 'text',
            'name' => 'name', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12'
            ],
        ]);
        CRUD::addField([
            'label' => 'Cuil',
            'type' => 'text',
            'name' => 'cuil', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Legajo',
            'type' => 'number',
            'name' => 'docket', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'name'  => 'sex',
            'label' => 'Sexo',
            'type' => 'enum',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'name'  => 'date_birth',
            'label' => 'Fecha Nacimiento',
            'type' => 'date',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::field('address')->label('Dirección');
        CRUD::addField([
            'label' => 'Localidad',
            'type' => 'relationship',
            'name' => 'location_id', // the method that defines the relationship in your Model
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'value' => 2,
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'name'  => 'landline',
            'label' => 'Tel. Fijo',
            'type' => 'text',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'name'  => 'cell_phone',
            'label' => 'Tel. Celular',
            'type' => 'text',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'name'  => 'personal_mail',
            'label' => 'Correo Personal',
            'type' => 'text',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);
        CRUD::addField([
            'name'  => 'institutional_mail',
            'label' => 'Correo Institucional',
            'type' => 'text',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);
        CRUD::addField([
            'label' => 'Función',
            'type' => 'relationship',
            'name' => 'job_id', // the method that defines the relationship in your Model
            'entity' => 'job', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'name'  => 'start_date',
            'label' => 'Fecha Alta',
            'type' => 'date',
            'value' => Now(),
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'name'  => 'weekly_hours',
            'label' => 'Horas Semanales',
            'type' => 'number',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2'
            ],
        ]);
        CRUD::addField([
            'label' => 'Asignaturas',
            'type' => 'select2_multiple',
            'name' => 'subjects', // the method that defines the relationship in your Model
            //'entity' => 'staffs', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'inline_create' => ['entity' => 'subject'],
            'ajax' => true,
        ]);
        CRUD::addField([
            'name'  => 'status',
            'label' => 'Estado',
            'type' => 'enum',
            'value' => 'Activo',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::field('observations')->label('Observaciones');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        CRUD::setCreateContentClass('col-12 mx-auto mt-3');
        CRUD::setEditContentClass('col-12 mx-auto mt-3');
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

    protected function setupShowOperation()
    {   
        CRUD::set('show.setFromDb', false);
        
        CRUD::column('name')->label('Apellido y Nombre');
        CRUD::addColumn([
            'label' => 'Función',
            'type' => 'relationship',
            'name' => 'job_id', // the method that defines the relationship in your Model
            'entity' => 'job', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('cuil')->label('Cuil');
        CRUD::column('docket')->label('Legajo');
        CRUD::column('sex')->label('Sexo');
        CRUD::column('date_birth')->label('Fecha Nac.');
        CRUD::column('address')->label('Dirección');
        CRUD::addColumn([
            'label' => 'Localidad',
            'type' => 'relationship',
            'name' => 'location_id', // the method that defines the relationship in your Model
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('landline')->label('Tel. Fijo');
        CRUD::column('cell_phone')->label('Tel. Celular');
        CRUD::column('personal_mail')->label('Correo Personal');
        CRUD::column('institutional_mail')->label('Correo Institucional');
        CRUD::column('start_date')->label('Fecha Alta');
        CRUD::column('weekly_hours')->label('Horas semanales');
        CRUD::addColumn([
            'label' => 'Asignaturas',
            'type' => 'relationship',
            'name' => 'subjects', // the method that defines the relationship in your Model
            'entity' => 'subjects', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('status')->label('Estado');
        CRUD::column('observations')->label('Observaciones');

        CRUD::setShowContentClass('col-12 mx-auto mt-3');
    }

    public function exportExcel(){
        return Excel::download(new StaffExport, 'planta.xlsx');
    }
    
    public function exportLicense(){
        //return view('license.blade.php');
        return Excel::download(new LicenseExport, 'licencias.xlsx');
    }

    public function getStaff($id)
    {
        $staff = \App\Models\Staff::get();
        return $staff;
    }

    public function novedades()
    {
        return view('novedades');
    }

    public function calculator()
    {
        return view('calculator');
    }

    public function calculator_pdf($param){
        $pdf = PDF::loadView("calculator_pdf", [
            "param" => $param,
        ]);
        return $pdf->stream('Calculator.pdf');
    }

}
