<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegularityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RegularityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RegularityCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Regularity::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/regularity');
        CRUD::setEntityNameStrings('regularidad', 'regularidades');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'sworn_declaration_item_id', // the method that defines the relationship in your Model
            'entity' => 'item.sworn_declaration', // the method that defines the relationship in your Model
            'attribute' => 'student_id',
        ]);
        CRUD::column('date_from')->label('Fecha Desde');
        CRUD::column('date_to')->label('Fecha Hasta');
        CRUD::column('theory_percentage')->label('% Teoría');
        CRUD::column('practice_percentage')->label('% Práctica');
        CRUD::column('plan_change_id')->label('Cambio de Plan');
        CRUD::column('prorogation')->label('Prórroga');
        CRUD::column('status')->label('Estado');
        CRUD::column('observations')->label('Observaciones');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RegularityRequest::class);

        CRUD::addField([
            'label' => 'Item DJ',
            'type' => 'number',
            'value' => 1,
            'name' => 'sworn_declaration_item_id', 
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        /*CRUD::addField([
            'label' => 'Cambio de Plan',
            'type' => 'relationship',
            'name' => 'plan_change_id', // the method that defines the relationship in your Model
            'entity' => 'study_plan', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);*/
        
        CRUD::addField([
            'label' => '% Teoría',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'theory_percentage', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => '% Práctica',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'practice_percentage', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => 'Fecha Desde',
            'type' => 'date',
            'name' => 'date_from', 
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);

        CRUD::addField([
            'label' => 'Fecha Hasta',
            'type' => 'date',
            'name' => 'date_to', 
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);

        CRUD::addField([
            'label' => 'Prórroga',
            'type' => 'checkbox',
            'name' => 'prorogation', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);    

        CRUD::addField([
            'label' => 'Estado',
            'type' => 'enum',
            'name' => 'status', 
            'wrapper'   => [
                'class' => 'disabled form-group col-12 col-lg-3'
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
}
