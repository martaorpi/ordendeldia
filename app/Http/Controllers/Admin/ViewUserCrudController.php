<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ViewUserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\Doc;
use \App\Models\ViewUser;
/**
 * Class ViewUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ViewUserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ViewUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/view-user');
        CRUD::setEntityNameStrings('Auditoria de vista', 'Auditoria de vistas');
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

        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
        $this->crud->removeButton('update');
        $this->crud->removeButton('show');

        $this->crud->column('user_id')->label('Usuario');
        $this->crud->column('doc_id')->label('Documento');
        $this->crud->column('created_at')->label('Fecha');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        $this->crud->addFilter([
            'name'  => 'user_id',
            'type'  => 'select2',
            'label' => 'Usuario'
        ], function() {
            return \App\Models\User::all()->pluck('name', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'user_id', $value);
        });

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'created_at',
            'label' => 'Fecha'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'created_at', '>=', $dates->from);
            $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ViewUserRequest::class);



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

    protected function addViewsUsers($id)
    {
        $doc = Doc::where('id', $id)->first();
        $view_user = ViewUser::where('doc_id', $doc->id)->where('user_id', backpack_user()->id)->first();
        if(!$view_user){
            ViewUser::create(
                ['doc_id' => $doc->id,
                'user_id' => backpack_user()->id]
            );
        }
        $views = ViewUser::where('doc_id', $doc->id)->count();
        return $views;
    }
}
