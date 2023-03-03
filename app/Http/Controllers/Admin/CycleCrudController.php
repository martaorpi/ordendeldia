<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\CycleRequest;

class CycleCrudController extends CrudController {

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup() 
    {
        $this->crud->setModel("App\Models\Cycle");
        $this->crud->setRoute("admin/cycle");
        $this->crud->setEntityNameStrings('Ciclo', 'Ciclos');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addColumn([
            'label' => 'Descripcion',
            'name' => 'description',
        ]);
        $this->crud->addColumn([
            'label' => 'Desde',
            'name' => 'from_',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'label' => 'Hasta',
            'name' => 'until_',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'label' => 'Tipo',
            'name' => 'Type',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CycleRequest::class);

        $this->crud->addField([
            'name' => 'description',
            'label' => 'Descripción',
        ]);

        $this->crud->addField([
            'name' => 'from_',
            'label' => 'Desde',
        ]);

        $this->crud->addField([
            'name' => 'until_',
            'label' => 'Hasta',
        ]);

        $this->crud->addField([
            'name' => 'type',
            'label' => 'Tipo',
            'type' => 'enum',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}