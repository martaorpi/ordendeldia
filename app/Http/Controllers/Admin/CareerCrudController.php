<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CareerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CareerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CareerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Career::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/career');
        CRUD::setEntityNameStrings('carrera', 'carreras');

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('create');

        //CRUD::setFromDb(); // columns
        CRUD::denyAccess(['show', 'delete']);

        CRUD::addColumn([
            'name'=> 'short_name',
            'label'=> 'Nombre corto',
        ]);
        CRUD::addColumn([
            'name' => 'amount',
            'label' => 'Monto'
        ]);
        CRUD::addColumn([
            'name' => 'available_space',
            'label' => 'Cupo'
        ]);
        CRUD::addColumn([
            'name' => 'duration',
            'label' => 'Duracion'
        ]);
        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Estado'
        ]);
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
        CRUD::setValidation(CareerRequest::class);

        CRUD::addField(
        [
            'name'  => 'short_name',
            'label' => 'Nombre Corto',
        ]);

        CRUD::addField(
        [
            'name'  => 'amount',
            'label' => 'Monto',
        ]);

        CRUD::addField(
        [
            'name'  => 'available_space',
            'label' => 'Cupos',
        ]);

        CRUD::addField(
        [
            'name'  => 'status',
            'label' => 'Estado',
            'type'  => 'enum'
        ]);

        CRUD::addField(
        [
            'name'  => 'month_1',
            'label' => 'Enero',
        ]);

        CRUD::addField(
        [
            'name'  => 'month_2',
            'label' => 'Febrero',
        ]);
        CRUD::addField(
        [
            'name'  => 'month_3',
            'label' => 'Marzo',
        ]);
        
        CRUD::addField(
        [
            'name'  => 'month_4',
            'label' => 'Abril',
        ]);

        CRUD::addField(
        [
            'name'  => 'month_5',
            'label' => 'Mayo',
        ]);

        CRUD::addField(
        [
            'name'  => 'month_6',
            'label' => 'Junio',
        ]);
        CRUD::addField(
        [
            'name'  => 'month_7',
            'label' => 'Julio',
        ]);
        CRUD::addField(
        [
            'name'  => 'month_8',
            'label' => 'Agosto',
        ]);
        CRUD::addField(
        [
            'name'  => 'month_9',
            'label' => 'Septiembre',
        ]);
        
        CRUD::addField(
        [
            'name'  => 'month_10',
            'label' => 'Octubre',
        ]);

        CRUD::addField(
        [
            'name'  => 'month_11',
            'label' => 'Noviembre',
        ]);

        CRUD::addField(
        [
            'name'  => 'month_12',
            'label' => 'Diciembre',
        ]);       

        //CRUD::setFromDb(); // fields

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
