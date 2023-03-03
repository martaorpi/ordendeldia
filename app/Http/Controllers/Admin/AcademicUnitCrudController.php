<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AcademicUnitRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AcademicUnitCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AcademicUnitCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\AcademicUnit::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/academic-unit');
        CRUD::setEntityNameStrings('unidades académicas', 'Unidades Académicas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('branch_id')->label('Sede');
        CRUD::column('short_name')->label('Nombre Corto');
        CRUD::column('long_name')->label('Nombre Largo');
        CRUD::column('abbreviation')->label('Abreviación');
        CRUD::column('created_at')->label('Fecha de Creación');
        //CRUD::column('updated_at')->label('Fecha de Última Actualización');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AcademicUnitRequest::class);

        CRUD::field('id');
        CRUD::field('branch_id');
        CRUD::field('short_name');
        CRUD::field('long_name');
        CRUD::field('abbreviation');
        CRUD::field('created_at');
        CRUD::field('updated_at');

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

    protected function setupShowOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('branch_id')->label('Sede');
        CRUD::column('short_name')->label('Nombre Corto');
        CRUD::column('long_name')->label('Nombre Largo');
        CRUD::column('abbreviation')->label('Abreviación');
        CRUD::column('created_at')->label('Fecha de Creación');
        //CRUD::column('updated_at')->label('Fecha de Última Actualización');
    }
}
