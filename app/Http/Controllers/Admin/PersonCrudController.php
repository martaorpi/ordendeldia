<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PersonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PersonCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
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
        CRUD::setModel(\App\Models\Person::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/person');
        CRUD::setEntityNameStrings('person', 'people');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupInlineCreateOperation()
    {
        CRUD::field('dni')->label('DNI');
        CRUD::field('first_name')->label('Nombre');
    }

    protected function setupListOperation()
    {
        $this->crud->setFromDb();
        
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
        CRUD::setValidation(PersonRequest::class);

        CRUD::field('dni')->label('DNI');
        CRUD::field('first_name')->label('Nombre');
        CRUD::field('last_name')->label('Apellido');
        CRUD::field('date_birth')->type('date_picker')->label('Fecha de nacimiento');
        CRUD::field('sex')->type('enum')->label('Sexo');
        CRUD::field('physical_address')->type('text')->label('Direccion Fisica');
        CRUD::field('phone')->label('Telefono');
        CRUD::field('nacionality')->type('enum')->label('Nacionalidad');
        CRUD::field('ocupation')->label('Ocupacion');
        CRUD::field('instruction_grade')->type('enum')->label('Instruccion');
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
