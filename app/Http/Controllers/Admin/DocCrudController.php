<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DocCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DocCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Doc::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/doc');
        CRUD::setEntityNameStrings('Boletin', 'Boletines');
        CRUD::setShowView('vendor/backpack/doc/show');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('user_id')->label('Usuario');
        CRUD::column('src')->label('Archivo');
        CRUD::addColumn([
            'label' => 'Fecha de Actualización',
            'name' => 'updated_at',
            'type' => 'date',
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
        CRUD::setValidation(DocRequest::class);

        CRUD::addField([
            'label' => "Archivo",
            'name' => "src",
            'type' => 'upload',
            'upload' => true,
        ]);
        CRUD::addField([
            'type' => 'number',
            'name' => 'user_id',
            'label' => '',
            'value' => backpack_user()->id,
            'attributes' => [
                'hidden' => 'hidden',
            ],
            'wrapper'   => [
                'class' => 'mt-0 pt-0',
            ],
        ]);

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
        CRUD::set('show.setFromDb', false);

        CRUD::setShowContentClass('col-12 mx-auto mt-3');
    }

}
