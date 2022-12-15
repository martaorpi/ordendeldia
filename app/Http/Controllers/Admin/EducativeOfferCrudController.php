<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EducativeOfferRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EducativeOfferCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EducativeOfferCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\EducativeOffer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/educative-offer');
        CRUD::setEntityNameStrings('oferta educativa', 'Oferta Educativa');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->disableResponsiveTable();
        $this->crud->enableResponsiveTable();

        CRUD::column('id')->label('ID');
        CRUD::column('academic_unit_id')->label('Unidad Académica');
        CRUD::column('short_name')->label('Nombre Corto');
        CRUD::column('long_name')->label('Nombre Largo');
        CRUD::column('abbreviation')->label('Abreviación');
        CRUD::column('current')->label('Vigente')->type('boolean');
        CRUD::column('registration_date')->label('Fecha de Registro');
        CRUD::column('title')->label('Título');
        CRUD::column('duration_regularity')->label('Duración de la Regularidad');
        CRUD::column('years_duration')->label('Años de Duración');
        CRUD::column('quota')->label('Cupo');
        CRUD::column('created_at')->label('Fecha de Creación');
        CRUD::column('updated_at')->label('Fecha de Última Actualización');

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
        CRUD::setValidation(EducativeOfferRequest::class);
        
        //CRUD::field('academic_unit_id')->label('Unidad Académica');
        CRUD::field('short_name')->label('Nombre Corto');
        CRUD::field('long_name')->label('Nombre Largo');
        CRUD::field('abbreviation')->label('Abreviación');
        CRUD::field('current')->label('Vigente')->default(true);
        CRUD::field('registration_date')->label('Fecha de Registro');
        CRUD::field('title')->label('Título');
        CRUD::field('duration_regularity')->label('Duración de la Regularidad');
        CRUD::field('years_duration')->label('Años de Duración');
        CRUD::field('quota')->label('Cupo');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(EducativeOfferRequest::class);
        
        /*CRUD::field('academic_unit_id')->label('Unidad Académica');
        CRUD::field('short_name')->label('Nombre Corto');
        CRUD::field('long_name')->label('Nombre Largo');
        CRUD::field('abbreviation')->label('Abreviación');*/
        CRUD::field('current')->label('Vigente')->default(true);
        /*CRUD::field('registration_date')->label('Fecha de Registro');
        CRUD::field('title')->label('Título');*/
        CRUD::field('duration_regularity')->label('Duración de la Regularidad');
        //CRUD::field('years_duration')->label('Años de Duración');
        CRUD::field('quota')->label('Cupo');
    }

    protected function setupShowOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('academic_unit_id')->label('Unidad Académica');
        CRUD::column('short_name')->label('Nombre Corto');
        CRUD::column('long_name')->label('Nombre Largo');
        CRUD::column('abbreviation')->label('Abreviación');
        CRUD::column('current')->label('Vigente')->type('boolean');
        CRUD::column('registration_date')->label('Fecha de Registro');
        CRUD::column('title')->label('Título');
        CRUD::column('duration_regularity')->label('Duración de la Regularidad');
        CRUD::column('years_duration')->label('Años de Duración');
        CRUD::column('quota')->label('Cupo');
        CRUD::column('created_at')->label('Fecha de Creación');
        CRUD::column('updated_at')->label('Fecha de Última Actualización');
    }
}
