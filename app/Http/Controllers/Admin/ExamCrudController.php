<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExamCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExamCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Exam::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exam');
        CRUD::setEntityNameStrings('exam', 'exams');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

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
        CRUD::setValidation(ExamRequest::class);

        CRUD::addField(['name' => 'subject', 'label' =>'Materia', 'type' => 'relationship']);
        CRUD::addField(['name' => 'date', 'label' =>'Fecha Examen', 'type' => 'date']);
        CRUD::addField(['name' => 'hour', 'label' =>'Hora Examen', 'type' => 'time']);
        
        CRUD::addField([
            'name' => 'teachers',
            'label' =>'Profesores', 
            'type' => 'select2_multiple'
        ]);

    }

    protected function setupShowOperation()
    {
        CRUD::addColumn(['name' => 'subject', 'label' =>'Materia', 'type' => 'relationship']);
        CRUD::addColumn(['name' => 'date', 'label' =>'Fecha Examen', 'type' => 'date']);
        CRUD::addColumn(['name' => 'hour', 'label' =>'Hora Examen', 'type' => 'time']);
        
        CRUD::addColumn([
            'name' => 'teachers',
            'label' =>'Profesores', 
        ]);

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
