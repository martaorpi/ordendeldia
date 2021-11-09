<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/estudiantes');
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
            return \App\Models\Cycle::all()->pluck('denomination', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'cycle_id', $value);
        });
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
}
