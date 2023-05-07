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
        //$this->crud->setTitle('Boletín Policial');
        $this->crud->setModel(\App\Models\Doc::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/doc');
        $this->crud->setEntityNameStrings('Boletin', 'Boletines');
        $this->crud->setShowView('vendor/backpack/doc/show');
        $this->crud->setShowContentClass('col-12 mx-auto mt-3');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();

        if(!backpack_user()->hasRole('editor') && !backpack_user()->hasRole('admin')){
            $this->crud->removeButton('create');
            $this->crud->removeButton('delete');
            $this->crud->removeButton('update');
        }

        $this->crud->addColumn([
            'label' => 'Estructura',
            'name' => 'type',
            'type' => 'enum',
        ]);
        $this->crud->column('src')->label('Archivo');
        $this->crud->addColumn([
            'label' => 'Fecha de Actualización',
            'name' => 'updated_at',
            'type' => 'datetime',
        ]);
        $this->crud->column('user_id')->label('Usuario');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - $this->crud->column('price')->type('number');
         * - $this->crud->addColumn(['name' => 'price', 'type' => 'number']);
         */
        $this->crud->addFilter([
            'name'  => 'type',
            'type'  => 'dropdown',
            'label' => 'Estructura'
        ], [
            'Completo' => 'Completo',
            'Urgentes'=> 'Disposiciones Judiciales Urgentes',
            'Estructura Organizacional' => 'Estructura Organizacional',
            'Recursos Humanos' => 'Recursos Humanos',
            'Disposiciones Generales' => 'Disposiciones Generales',
            'Desarrollo Educativo' => 'Desarrollo Educativo',
            'Disposiciones Judiciales' => 'Disposiciones Judiciales',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DocRequest::class);

        $this->crud->addField([
            'label' => "Archivo (<small>solo JPG,JPEG,PNG,PDF</small>)",
            'name' => "src",
            'type' => 'upload',
            'upload' => true,
        ]);
        $this->crud->addField([
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
        $this->crud->addField([
            'label' => "Resumen",
            'name' => "summary",
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'label' => "Estructura",
            'name' => "type",
            'type' => 'enum',
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - $this->crud->field('price')->type('number');
         * - $this->crud->addField(['name' => 'price', 'type' => 'number']));
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
        $this->crud->set('show.setFromDb', false);

    }

    protected function example()
    {
        return view('example');
    }

    protected function digesto()
    {
        return view('digesto');
    }
}
