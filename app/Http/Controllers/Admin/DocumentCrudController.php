<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocumentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class DocumentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DocumentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Document::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/document');
        CRUD::setEntityNameStrings('Denuncia', 'Denuncias');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $user = Auth::user();

        //$user->dependence != null ?: $this->crud->hasAccessOrFail('something');// throws 403 error

        if (!$user->hasRole('admin')){       
            crud::addClause('where', 'dependency_id', '=', $user->dependence->id);
        }

        CRUD::column('ex_number')->label('Nº Expediente');
        CRUD::column('title')->label('Caratula');
        CRUD::column('type')->label('Typo');
        CRUD::column('autority')->type('relationship')->label('Fiscal');
        CRUD::column('dependence')->type('relationship')->label('Dependencia')->attribute('description');
        CRUD::column('user')->type('relationship')->label('Usuario');
        CRUD::column('event_datetime')->type('date')->label('Fecha');
        CRUD::column('crime_id')->type('relationship')->label('delito')->entity('crime');
        
        CRUD::addFilter([
            'name'  => 'type',
            'type'  => 'select2',
            'label' => 'Tipo'
        ], function() {
            return \App\Models\Document::getEnumValuesAsAssociativeArray('type');
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'type', $value);
        });

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'event_datetime',
            'label' => 'Fecha'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'event_datetime', '>=', $dates->from);
            $this->crud->addClause('where', 'event_datetime', '<=', $dates->to . ' 23:59:59');
        });

        $this->crud->addFilter([
            'name'  => 'authority_id',
            'type'  => 'select2',
            'label' => 'fiscal'
        ], function() {
            return \App\Models\Authority::all()->pluck('last_name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'authority_id', $value);
        });

        if ($user->hasRole('admin')){       
            $this->crud->addFilter([
                'name'  => 'dependency_id ',
                'type'  => 'select2',
                'label' => 'Dependencia'
            ], function() {
                return \App\Models\Dependence::all()->pluck('long_name', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'dependency_id ', $value);
            });
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DocumentRequest::class);

        CRUD::field('title')->label('Titulo');
        CRUD::field('body')->type('tinymce')->label('Cuerpo');
        //CRUD::field('type')->type('enum')->label('Tipo');

        CRUD::addField([
            'name'          => 'complainant',
            'label'         => 'Denunciante',
            'type'          => "relationship",
            'ajax'          => true,
            'attribute'     => "full_name",
            'data_source'   => backpack_url("document/fetch/person"),
            'inline_create' => ['entity' => 'person'],
        ]);

        CRUD::addField([
            'name'          => 'victim',
            'type'          => "relationship",
            'label'         => 'Victima',
            'ajax'          => true,
            'attribute'     => "full_name",
            'data_source'   => backpack_url("document/fetch/person"),
            'inline_create' => ['entity' => 'person'],
        ]);

        CRUD::addField([
            'name'          => 'accused',
            'type'          => "relationship",
            'label'         => 'Denunciado',
            'ajax'          => true,
            'attribute'     => "full_name",
            'data_source'   => backpack_url("document/fetch/person"),
            'inline_create' => ['entity' => 'person'],
        ]);

        CRUD::field('autority')->type('relationship')->label('Autoridad');
        CRUD::field('dependence')->type('relationship')->label('dependencia')->attribute('description');
        CRUD::field('event_datetime')->label('event_datetime');
        CRUD::field('ex_number')->label('Nº Expediente');
        CRUD::field('crime')->type('relationship')->label('delito')->entity('crime');

        $this->crud->setCreateContentClass('col-md-8 mx-auto mt-3');
        $this->crud->setEditContentClass('col-md-8 mx-auto mt-3');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function fetchPerson() {
        return $this->fetch([
            'model' => \App\Models\Person::class,
            'query' => function($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereRaw('CONCAT(`first_name`," ",`last_name`) LIKE "%' . $search . '%"')
                        ->orWhereRaw('dni LIKE "%' . $search . '%"');
                }else{
                    return $model;
                }
            },
            'searchable_attributes' => []
        ]);
    }

}
