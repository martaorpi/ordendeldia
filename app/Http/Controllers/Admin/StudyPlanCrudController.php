<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudyPlanRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudyPlanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudyPlanCrudController extends CrudController
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
        CRUD::setModel(\App\Models\StudyPlan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/study-plan');
        CRUD::setEntityNameStrings('Plan de Estudio', 'Planes de Estudio');
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
        
        CRUD::addColumn([
            'label' => 'Oferta Educativa',
            'type' => 'relationship',
            'name' => 'educative_offer_id', // the method that defines the relationship in your Model
            'entity' => 'educative_offer', // the method that defines the relationship in your Model
            'attribute' => 'short_name',
        ]);
        CRUD::addColumn(['name' => 'year', 'label' => 'Año']);
        CRUD::addColumn([
            'name'    => 'current',
            'type'    => 'closure',
            'label'   => 'Vigente',
            'function' => function($entry) {
                switch ($entry->current) {
                    case 0: $vigente = 'NO'; break;
                    case 1: $vigente = 'SI'; break;
                }               
                return $vigente;
            }
        ]);
        CRUD::addColumn(['name' => 'description', 'label' => 'Descripción']);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        
        CRUD::addFilter([
            'name'  => 'educative_offer_id',
            'type'  => 'select2',
            'label' => 'Oferta Eductiva'
        ],
            function() {
                return \App\Models\EducativeOffer::select()->distinct()->get()->pluck('short_name', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'educative_offer_id', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'year',
            'type'  => 'select2',
            'label' => 'Año'
        ],
            function() {
                return [
                  date("Y")-4 => date("Y")-4,
                  date("Y")-3 => date("Y")-3,
                  date("Y")-2 => date("Y")-2,
                  date("Y")-1 => date("Y")-1,
                  date("Y") => date("Y"),
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'year', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'current',
            'type'  => 'select2',
            'label' => 'Vigente'
        ],
            function() {
                return [
                  0 => 'NO',
                  1 => 'SI',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'current', $value);
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
        CRUD::setValidation(StudyPlanRequest::class);

        CRUD::addField([
            'label' => 'Oferta Educativa',
            'type' => 'relationship',
            'name' => 'educative_offer_id', // the method that defines the relationship in your Model
            'entity' => 'educative_offer', // the method that defines the relationship in your Model
            'attribute' => 'short_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-5'
            ],
        ]);

        CRUD::addField([
            'label' => 'Año',
            'type' => 'number',
            'name' => 'year', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => 'Vigente',
            'type' => 'checkbox',
            'name' => 'current', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3 mt-4'
            ],
        ]);    
        
        CRUD::addField([
            'label' => 'Descripción',
            'type' => 'textarea',
            'name' => 'description', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 mt-4'
            ],
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
}
