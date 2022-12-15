<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TariffCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TariffCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TariffCategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TariffCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tariff-category');
        CRUD::setEntityNameStrings('Categoría Arancelaria', 'Categorías Arancelarias');
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

        CRUD::column('description')->label('Descripción');
        CRUD::column('percentage')->label('Porcentaje');
        CRUD::column('category')->label('Categoría');

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

        CRUD::column('factor')->label('Factor');

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
        CRUD::setValidation(TariffCategoryRequest::class);

        CRUD::field('description')->label('Descripción');
        CRUD::field('category')->label('Categoría');

        CRUD::addField([
            'label' => 'Porcentaje',
            'type' => 'number',
            'decimals' => 0,
            'name' => 'percentage', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => 'Factor',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'factor', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => 'Vigente',
            'type' => 'checkbox',
            'name' => 'current', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4 mt-4'
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
