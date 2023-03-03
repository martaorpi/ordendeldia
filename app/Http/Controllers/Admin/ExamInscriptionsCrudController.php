<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamInscriptionsRequest;
use App\Models\ExamInscriptions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class ExamInscriptionsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExamInscriptionsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ExamInscriptions::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exam-inscriptions');
        CRUD::setEntityNameStrings('inscripción a examen', 'Inscripciones a examenes');
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
        CRUD::removeButton('create');
        /*$this->crud->addClause('whereHas', 'sworn_declaration_item', function($query) {
            $query->whereHas('sworn_declaration', function($query) {
                $query->whereHas('student', function($query) {
                    //$query->where('students.id', 'sworn_declaration.student_id');
                });
            });
        });*/

        CRUD::addColumn([
            'label' => 'Mesa de Examen',
            'type' => 'relationship',
            'name' => 'exam_table_id', // the method that defines the relationship in your Model
            'entity' => 'exam_table.subject', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        /*CRUD::addColumn([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'sworn_declaration_item_id', // the method that defines the relationship in your Model
            'entity' => 'sworn_declaration_item.sworn_declaration.student', // the method that defines the relationship in your Model
            'attribute' => 'student_id',
        ]);*/

        CRUD::addColumn([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'entity' => 'student', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);

        CRUD::column('sworn_declaration_item_id')->label('Item DJ');
        CRUD::column('condition_exam')->label('Condición')->type('enum');
        CRUD::column('created_at')->label('Fecha de Inscripción')->type('date');
        CRUD::column('assistance')->label('Asistencia')->type('boolean');
        CRUD::column('written_qualification')->label('Nota Escrito');
        CRUD::column('oral_qualification')->label('Nota Oral');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'full_name',
            'type'  => 'select2',
            'label' => 'Mesa de Examen'
        ],
            function() {
                return \App\Models\ExamTable::select()->where('current', 1)->distinct()->get()->pluck('full_name', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'exam_table_id', $value);
            }
        );

        $this->crud->addFilter([
            'name'  => 'student_id',
            'type'  => 'select2',
            'label' => 'Estudiante'
        ], function() {
            return \App\Models\Student::all()->pluck('full_name', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'student_id', $value);
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
        CRUD::setValidation(ExamInscriptionsRequest::class);

        CRUD::addField([
            'label' => 'Mesa de Examen',
            'type' => 'relationship',
            'name' => 'exam_table_id', // the method that defines the relationship in your Model
            'entity' => 'exam_table.subject', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);
        /*CRUD::addField([
            'label' => 'Mesa de Examen',
            'type' => 'number',
            'name' => 'exam_table_id', // the method that defines the relationship in your Model
            
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);*/
        CRUD::addField([
            'label' => 'Estudiante',
            'type' => 'number',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'value' => 21,
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);
        /*CRUD::addField([
            'label' => 'Item DJ',
            'type' => 'text',
            'name' => 'sworn_declaration_item_id',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);*/
        /*CRUD::addField([
            'label' => 'Acta de Examen',
            'type' => 'relationship',
            'name' => 'exam_act_id', // the method that defines the relationship in your Model
            'entity' => 'exam_act', // the method that defines the relationship in your Model
            'attribute' => 'act', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);*/
        CRUD::addField([
            'label' => 'Condición',
            'type' => 'enum',
            'name' => 'condition_exam',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Nota Escrita',
            'type' => 'text',
            'name' => 'written_qualification',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Nota Oral',
            'type' => 'text',
            'name' => 'oral_qualification',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Promedio',
            'type' => 'text',
            'name' => 'average',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Asistencia',
            'type' => 'checkbox',
            'name' => 'assistance_exam',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Aprobado',
            'type' => 'checkbox',
            'name' => 'approved',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4 mt-3'
            ],
        ]);
        CRUD::addField([
            'label' => 'Promocionado',
            'type' => 'checkbox',
            'name' => 'promotion',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4 mt-3'
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
}
