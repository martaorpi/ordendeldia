<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Subject;
use \App\Models\ExamStudent;

use App\Http\Requests\ExamTableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \PDF;

/**
 * Class ExamTableCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExamTableCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ExamTable::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exam-table');
        CRUD::setEntityNameStrings('mesa de examen', 'mesas de examen');
        //CRUD::setShowView('vendor/backpack/examTable/show');
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
        CRUD::addButtonFromView('line', 'showExamTable', 'showExamTable', 'end');
        CRUD::addButtonFromView('line', 'actPDF', 'actPDF', 'end');
        CRUD::addButtonFromView('line', 'actPDFReg', 'actPDFReg', 'end');
        
        CRUD::addColumn([
            'label' => 'Turno Examen',
            'type' => 'relationship',
            'name' => 'exam_shift_id', // the method that defines the relationship in your Model
            'entity' => 'exam_shift', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        CRUD::addColumn([
            'label' => 'Plan de Estudio',
            'type' => 'relationship',
            'name' => 'subject', // the method that defines the relationship in your Model
            'entity' => 'subject.study_plan', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);
        CRUD::column('subject_id')->label('Asignatura');
        CRUD::column('commission')->label('Comisión');
        CRUD::column('date')->label('Fecha');
        CRUD::column('hour')->label('Hora');
        //CRUD::column('max_date')->label('Fecha Tope');
        CRUD::addColumn([
            'name'    => 'current',
            'type'    => 'closure',
            'label'   => 'Vigente',
            'function' => function($entry) {
                switch ($entry->special) {
                    case 0: $special = 'NO'; break;
                    case 1: $special = 'SI'; break;
                }               
                return $special;
            }
        ]);
        //CRUD::column('previous_table_id')->label('Mesa Anterior');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'full_name',
            'type'  => 'select2',
            'label' => 'Turno Examen'
        ],
            function() {
                return \App\Models\ExamShift::select()->distinct()->get()->pluck('full_name', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'exam_shift_id', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'current',
            'type'  => 'select2',
            'label' => 'Vigente'
        ],
            function() {
                return [
                  0 => 'NO',
                  1 => 'SI',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'current', $value);
            }
        );
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ExamTableRequest::class);

        CRUD::addField([
            'label' => 'Turno de Examen',
            'type' => 'select2',
            'name' => 'exam_shift_id', 
            'entity'    => 'exam_shift', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                    return $query->where('type', 'Turno-Examen')->get();
                }),
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        CRUD::addField([
            'label' => 'Plan de Estudio',
            'type' => 'relationship',
            'name' => 'study_plan_id', // the method that defines the relationship in your Model
            'entity' => 'study_plan', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);

        

        /*CRUD::addField([   // 1-n relationship
            'label'       => "Asignatura", // Table column heading
            'type'        => "select2_from_ajax",
            'name'        => 'subject_id', // the column that contains the ID of that connected entity
            'entity'      => 'subject', // the method that defines the relationship in your Model
            'attribute'   => "description", // foreign key attribute that is shown to user
            'data_source' => url("get-subjects-by-study-plan"), // url to controller search function (with /{id} should return model)
        
            // OPTIONAL
            // 'delay' => 500, // the minimum amount of time between ajax requests when searching in the field
            'placeholder'             => "Select a category", // placeholder for the select
            'minimum_input_length'    => 0, // minimum characters to type before querying results
            'model'                => "App\Models\Subject",
             'dependencies'            => ['subject.study_plan'], // when a dependency changes, this select2 is reset to null
            // 'method'                  => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
            // 'include_all_form_fields' => false, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)


            
        ]);*/


        CRUD::addField([
            'label' => 'Asignatura',
            'type' => 'relationship',
            'name' => 'subject_id', // the method that defines the relationship in your Model
            'entity' => 'subject', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Comisión',
            'type' => 'text',
            'name' => 'commission', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Fecha',
            'type' => 'date',
            'name' => 'date', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Hora',
            'type' => 'time',
            'name' => 'hour', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Fecha límite',
            'type' => 'date',
            'name' => 'max_date', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        /*CRUD::addField([
            'label' => 'Turno Anterior',
            'type' => 'relationship',
            'name' => 'previous_table_id', // the method that defines the relationship in your Model
            'entity' => 'previous_table', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
        ]);*/
        CRUD::field('current')->label('Vigente');
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

    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'label' => 'Turno Examen',
            'type' => 'relationship',
            'name' => 'exam_shift_id', // the method that defines the relationship in your Model
            'entity' => 'exam_shift', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        CRUD::column('subject_id')->label('Asignatura');
        CRUD::column('commission')->label('Comisión');
        CRUD::column('date')->label('Fecha');
        CRUD::column('hour')->label('Hora');
        CRUD::addColumn([
            'name'    => 'current',
            'type'    => 'closure',
            'label'   => 'Vigente',
            'function' => function($entry) {
                switch ($entry->current) {
                    case 0: $current = 'NO'; break;
                    case 1: $current = 'SI'; break;
                }               
                return $current;
            }
        ]);
        CRUD::column('max_date')->label('Fecha Tope');
        CRUD::column('previous_table_id')->label('Mesa Anterior');
    }

    /*public function getSubjectsByStudyPlan(Request $request){
        $search_term = $request->input('id');

        if ($search_term)
        {
            $results = Subject::where('study_plan_id ', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = Subject::paginate(10);
        }

        return $results;
    }*/

    public function showExamTable($id) 
    {
        return view('vendor.backpack.examTable.list_inscriptions', ['inscriptions' => ExamStudent::where('exam_table_id', $id)->get()]);
    }

    public function actPDF($id) 
    {
        return view('vendor.backpack.examTable.act_pdf', ['inscriptions' => ExamStudent::where('exam_table_id', $id)->get()]);
    }

    public function act_pdf($id){
        $pdf = PDF::loadView('vendor.backpack.exam-table.act_pdf', [
            "id" => $id,
            "condicion" => 'Libres',
        ]);
        return $pdf->stream('Acta_examen.pdf');
    }

    public function act_pdf_reg($id){
        $pdf = PDF::loadView('vendor.backpack.exam-table.act_pdf', [
            "id" => $id,
            "condicion" => 'regulares',
        ]);
        return $pdf->stream('Acta_examen_reg.pdf');
    }

}
