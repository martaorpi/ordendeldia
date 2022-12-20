<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CorrelativeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class CorrelativeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CorrelativeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Correlative::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/correlative');
        CRUD::setEntityNameStrings('Correlativa', 'Correlativas');
        CRUD::setCreateView('vendor/backpack/correlatives/create');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('subject_id')->label('Asignatura');
        CRUD::column('correlative_id')->label('Correlativa');
        CRUD::column('condition')->label('Condición');
        CRUD::column('correlativity_type')->label('Tipo de Correlativa');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        /*CRUD::addFilter([
            'name'  => 'subject',
            'type'  => 'select2',
            'label' => 'Carrera'
        ],
            function() {
                return \App\Models\Career::select()->distinct()->get()->pluck('short_name', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'subject.career_id', $value);
                //CRUD::addClause('join', 'career', 'subject.career_id', 'career.id');
            }
        );*/

        CRUD::addFilter([
            'name'  => 'condition',
            'type'  => 'select2',
            'label' => 'Condición'
        ],
            function() {
                return [
                  'Cursado' => 'Cursado',
                  'Examen' => 'Examen',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'condition', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'correlativity_type',
            'type'  => 'select2',
            'label' => 'Tipo Correlativa'
        ],
            function() {
                return [
                  'Débil' => 'Débil',
                  'Fuerte' => 'Fuerte',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'correlativity_type', $value);
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
        CRUD::setValidation(CorrelativeRequest::class);

        CRUD::addField([
            'name' => 'subject_id',
            'type' => 'relationship',
            'label' => 'Asignatura',
            'entity' => 'subject', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'label' => 'Asignatura Correlativa',
            'type' => 'relationship',
            'name' => 'correlative_id', // the method that defines the relationship in your Model
            'entity' => 'correlative', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'name'  => 'condition',
            'type' => 'enum',
            'label' => 'Condición',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6 mt-3'
            ],
        ]);

        CRUD::addField([
            'name'  => 'correlativity_type',
            'label' => 'Tipo de correlativa',
            'type' => 'enum',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6 mt-3'
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

    protected function setupShowOperation()
    {   
        CRUD::set('show.setFromDb', false);

        CRUD::addColumn([
            'label' => 'Carrera',
            'type' => 'relationship',
            'name' => 'subject_id', // the method that defines the relationship in your Model
            'entity' => 'career', // the method that defines the relationship in your Model
            'attribute' => 'short_name',
        ]);
        //CRUD::column('subject_id')->label('Asignatura');
        CRUD::column('correlative_id')->label('Correlativa');
        CRUD::column('condition')->label('Condición');
        CRUD::column('correlativity_type')->label('Tipo de Correlativa');

        CRUD::setShowContentClass('col-12 mx-auto mt-3');
    }

}
