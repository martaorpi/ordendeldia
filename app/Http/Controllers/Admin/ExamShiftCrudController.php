<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamShiftRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExamShiftCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExamShiftCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ExamShift::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exam-shift');
        CRUD::setEntityNameStrings('Turno de Examen', 'Turnos de Examen');
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
        
        CRUD::column('year')->label('Período');
        CRUD::column('description')->label('Descripción');
        CRUD::column('from')->label('Fecha Inicio');
        CRUD::column('to')->label('Fecha Fin');
        CRUD::addColumn([
            'name'    => 'special',
            'type'    => 'closure',
            'label'   => 'Turno Especial',
            'function' => function($entry) {
                switch ($entry->special) {
                    case 0: $special = 'NO'; break;
                    case 1: $special = 'SI'; break;
                }               
                return $special;
            }
        ]);
        CRUD::column('previous_turn_id')->label('Turno Anterior');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'year',
            'type'  => 'select2',
            'label' => 'Período'
        ],
            function() {
                return \App\Models\Cycle::select()->distinct()->get()->pluck('year', 'year')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'year', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'type',
            'type'  => 'select2',
            'label' => 'Tipo'
        ],
            function() {
                return \App\Models\Cycle::select()->distinct()->get()->pluck('type', 'type')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'type', $value);
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
        CRUD::setValidation(ExamShiftRequest::class);

        CRUD::addField([
            'label' => 'Período',
            'type' => 'number',
            'name' => 'year',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Descripción',
            'type' => 'text',
            'name' => 'description', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-8'
            ],
        ]);
        CRUD::addField([
            'label' => 'Fecha Inicio',
            'type' => 'date',
            'name' => 'from', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Fecha Fin',
            'type' => 'date',
            'name' => 'to', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Turno Especial',
            'type' => 'checkbox',
            'name' => 'special', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2 mt-4'
            ],
        ]);
        CRUD::addField([
            'type' => 'enum',
            'name' => 'type',
            'value' => 'Turno-Examen',
            'wrapper'   => [
                'style' => 'display:none'
            ],
        ]);
        CRUD::addField([
            'label' => 'Turno Anterior',
            'type' => 'relationship',
            'name' => 'previous_turn_id', // the method that defines the relationship in your Model
            'entity' => 'previous_turn', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        //CRUD::field('previous_turn_id');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        CRUD::setCreateContentClass('col-12 mx-auto mt-3');
        CRUD::setEditContentClass('col-12 mx-auto mt-3');
    }

    protected function setupShowOperation()
    {
        CRUD::column('cycle_id')->label('Período');
        CRUD::column('description')->label('Descripción');
        CRUD::column('start_date')->label('Fecha Inicio');
        CRUD::column('end_date')->label('Fecha Fin');
        
        CRUD::column('previous_turn_id')->label('Turno Anterior');

        
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
