<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LicenseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LicenseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LicenseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\License::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/license');
        CRUD::setEntityNameStrings('licencia', 'licencias');
        CRUD::setEditView('vendor/backpack/staff_in_licenses/show');
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

        CRUD::column('article')->label('Artículo');
        CRUD::column('type_days')->label('Tipo de Días');
        CRUD::column('days')->label('Cant Días');
        CRUD::column('extra_days')->label('Días Adicionales');
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
        CRUD::setValidation(LicenseRequest::class);

        CRUD::addField([
            'name'  => 'article',
            'label' => 'Artículo',
            'type' => 'text',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'name'  => 'type_days',
            'label' => 'Tipo de Días',
            'type' => 'enum',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'name'  => 'days',
            'label' => 'Cantidad de Días',
            'type' => 'number',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2'
            ],
        ]);
        
        CRUD::addField([
            'name'  => 'extra_days',
            'label' => 'Días Adicionales',
            'type' => 'number',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2'
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

    public function getLicenses($id)
    {
        $licenses = \App\Models\License::get();
        return $licenses;
    }
}
