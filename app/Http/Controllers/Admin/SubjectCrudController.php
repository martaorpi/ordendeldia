<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Subject::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subject');
        CRUD::setEntityNameStrings('Asignatura', 'Asignaturas');
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
        CRUD::enableExportButtons();
        CRUD::addClause('where', 'id','<>', 0);
        
        CRUD::addColumn([
            'label' => 'Carrera',
            'type' => 'relationship',
            'name' => 'career_id', // the method that defines the relationship in your Model
            'entity' => 'career', // the method that defines the relationship in your Model
            'attribute' => 'short_name',
        ]);
        CRUD::column('description')->label('Descripcion');
        CRUD::column('four_month_period')->label('Cuatrimestre');
        CRUD::column('annual_period')->label('Año');
        CRUD::column('semester')->label('Semestre');
        CRUD::column('hours')->label('Horas');
        CRUD::addColumn([
            'label' => 'Docente/s',
            'type' => 'relationship',
            'name' => 'staff', // the method that defines the relationship in your Model
            'entity' => 'staff', // the method that defines the relationship in your Model
            'attribute' => 'name',
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'career_id',
            'type'  => 'select2',
            'label' => 'Carrera'
        ],
            function() {
                return \App\Models\Career::select()->distinct()->get()->pluck('short_name', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'career_id', $value);
            }
        );
        CRUD::addFilter([
            'name'  => 'four_month_period',
            'type'  => 'select2',
            'label' => 'Cuatrimestre'
        ],
            function() {
                return [
                  '1' => '1',
                  '2' => '2',
                  '3' => '3',
                  '4' => '4',
                  '5' => '5',
                  '6' => '6',
                  '7' => '7',
                  '8' => '8',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'four_month_period', $value);
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
        CRUD::setValidation(SubjectRequest::class);

        CRUD::addField([
            'label' => 'Carrera',
            'type' => 'relationship',
            'name' => 'career_id', // the method that defines the relationship in your Model
            'entity' => 'career', // the method that defines the relationship in your Model
            'attribute' => 'short_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Descripción',
            'type' => 'text',
            'name' => 'description', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-9'
            ],
        ]);
        CRUD::addField([
            'label' => 'Cuatrimestre',
            'type' => 'number',
            'name' => 'four_month_period', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Año',
            'type' => 'number',
            'name' => 'annual_period', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Semestre',
            'type' => 'number',
            'name' => 'semester', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Código',
            'type' => 'number',
            'name' => 'code', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Horas',
            'type' => 'number',
            'name' => 'hours', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Docente/s',
            'type' => 'select2_multiple',
            'name' => 'staff', // the method that defines the relationship in your Model
            //'entity' => 'staffs', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'inline_create' => ['entity' => 'staff'],
            'ajax' => true,
        ]);
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

        CRUD::addColumn([
            'label' => 'Carrera',
            'type' => 'relationship',
            'name' => 'career_id', // the method that defines the relationship in your Model
            'entity' => 'career', // the method that defines the relationship in your Model
            'attribute' => 'short_name',
        ]);
        CRUD::column('description')->label('Descripcion');
        CRUD::column('four_month_period')->label('Cuatrimestre');
        CRUD::column('semester')->label('Semestre');
        CRUD::column('hours')->label('Horas');
        CRUD::addColumn([
            'label' => 'Docente/s',
            'type' => 'relationship',
            'name' => 'staff', // the method that defines the relationship in your Model
            'entity' => 'staff', // the method that defines the relationship in your Model
            'attribute' => 'name',
        ]);

        CRUD::setShowContentClass('col-12 mx-auto mt-3');
    }

    public function getSubjects($id,$id2)
    {
        $subjects = \App\Models\Subject::where('career_id', $id2)->get();
        return $subjects;
    }
}
