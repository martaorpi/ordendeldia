<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SwornDeclarationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use \App\Models\SwornDeclarationItem;
use \App\Models\Regularity;
use \App\Models\ExamStudent;
/**
 * Class SwornDeclarationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SwornDeclarationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\SwornDeclaration::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sworn-declaration');
        CRUD::setEntityNameStrings('Declarción Jurada', 'Declaraciones Juradas');
        CRUD::setEditView('vendor/backpack/swornDeclaration/edit');

        //$this->crud->setShowView('vendor/backpack/swornDeclaration/show');
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

        CRUD::addColumn([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'entity' => 'student', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        CRUD::addColumn([
            'label' => 'Ciclo',
            'type' => 'relationship',
            'name' => 'cycle_id', // the method that defines the relationship in your Model
            'entity' => 'cycle', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        
        CRUD::column('quarterly_period')->label('Cuatrimestre');
        CRUD::column('date')->label('Fecha Emisión');
        CRUD::column('type')->label('Tipo');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'type',
            'type'  => 'select2',
            'label' => 'Tipo'
        ],
            function() {
                return [
                  'Ingreso' => 'Ingreso',
                  'Cursado Regular' => 'Cursado Regular',
                  //'Cursado Condicional' => 'Cursado Condicional',
                  'Examen Regular' => 'Examen Regular',
                  'Examen Libre' => 'Examen Libre',
                ];
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'type', $value);
            }
        );

        CRUD::addFilter([
            'name'  => 'cycle_id',
            'type'  => 'select2',
            'label' => 'Período'
        ],
            function() {
                return \App\Models\Cycle::select()->distinct()->get()->pluck('description', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'cycle_id', $value);
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
        CRUD::setValidation(SwornDeclarationRequest::class);

        CRUD::addField([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'entity' => 'student', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'label' => 'Ciclo',
            'type' => 'relationship',
            'name' => 'cycle_id', // the method that defines the relationship in your Model
            'entity' => 'cycle', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-4'
            ],
        ]);
        CRUD::addField([
            'label' => 'Cuatrimestre',
            'type' => 'number',
            'name' => 'quarterly_period', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-2'
            ],
        ]);
        CRUD::addField([
            'name'  => 'date',
            'label' => 'Fecha Emisión',
            'type' => 'date',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3 mt-3'
            ],
        ]);
        CRUD::addField([
            'name'  => 'type',
            'label' => 'Tipo',
            'type' => 'enum',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3 mt-3'
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

    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'entity' => 'student', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        CRUD::addColumn([
            'label' => 'Ciclo',
            'type' => 'relationship',
            'name' => 'cycle_id', // the method that defines the relationship in your Model
            'entity' => 'cycle', // the method that defines the relationship in your Model
            'attribute' => 'full_name',
        ]);
        
        CRUD::column('quarterly_period')->label('Cuatrimestre');
        CRUD::column('date')->label('Fecha Emisión');
        CRUD::column('type')->label('Tipo');
        
        CRUD::setShowContentClass('col-12 mx-auto mt-3');
    }

    public function getSubjects($id)
    {
        $dj = \App\Models\SwornDeclaration::where('id',$id)->first();
        if($dj->type == 'Ingreso'){
            $subjects = \App\Models\Subject::where('study_plan_id',$dj->student->study_plan->id)->where('quarterly_period',1)->get();
        }elseif($dj->type == 'Cursado Regular'){
            $subjects = \App\Models\Subject::where('study_plan_id',$dj->student->study_plan->id)
                ->whereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Fuerte')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('exam_student', function ($q){$q
                            ->where('approved',1)
                            ->orWhere('promotion',1);
                        });
                    });
                })
                ->orWhereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Débil')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('regularity', function ($q){$q
                            ->where('date_from', '<=', date('Y-m-d'))
                            ->orWhere('date_to', '>=', date('Y-m-d'));
                        });
                    });
                })
                ->get();
        }elseif($dj->type == 'Examen Regular'){
            $subjects = \App\Models\Subject::where('study_plan_id',$dj->student->study_plan->id)
                ->whereHas('sworn_declaration_item', function ($q){$q
                    ->whereHas('regularity', function ($q){$q
                        ->where('date_from', '<', date('Y-m-d'))
                        ->orWhere('date_to', '>', date('Y-m-d'));
                    });
                })
                ->whereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Fuerte')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('exam_student', function ($q){$q
                            ->where('approved',1)
                            ->orWhere('promotion',1);
                        });
                    });
                })
                ->orWhereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Débil')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('regularity', function ($q){$q
                            ->where('date_from', '<', date('Y-m-d'))
                            ->orWhere('date_to', '>', date('Y-m-d'));
                        });
                    });
                })
                ->with('exam_table')
                ->get();
        }elseif($dj->type == 'Examen Libre'){
            $subjects = \App\Models\Subject::where('study_plan_id',$dj->student->study_plan->id)
                ->where('description', 'not like', "sem%")
                ->where('description', 'not like', "taller%")
                ->where('description', 'not like', "practica%")
                ->where('description', 'not like', "práctica%")
                ->whereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Fuerte')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('exam_student', function ($q){$q
                            ->where('approved',1)
                            ->orWhere('promotion',1);
                        });
                    });
                })
                ->orWhereHas('correlative', function ($q){$q
                    ->where('condition', 'Cursado')
                    ->where('correlativity_type', 'Débil')
                    ->whereHas('sworn_declaration_item', function ($q){$q
                        ->whereHas('regularity', function ($q){$q
                            ->where('date_from', '<', date('Y-m-d'))
                            ->orWhere('date_to', '>', date('Y-m-d'));
                        });
                    });
                })
                ->get();
        }
        return $subjects;
    }

    protected function storeSwornDeclarationItems($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['sworn_declaration_id'] = $id;
            $item = SwornDeclarationItem::create($input);
            $input2['sworn_declaration_item_id'] = $item->id;
            $input3['sworn_declaration_item_id'] = $item->id;
            if($item->sworn_declaration->type == 'Ingreso'){
                $input2['status'] = 'Cursando';
                $input2['date_from'] = Date('Y-m-d');
                $input2['date_to'] = date("Y-m-d",strtotime(Date('Y-m-d')."+ 2 year"));
                Regularity::create($input2);
            }
            if($item->sworn_declaration->type == 'Cursado Regular'){
                $input2['status'] = 'Cursando';
                $input2['date_from'] = Date('Y-m-d');
                $input2['date_to'] = date("Y-m-d",strtotime(Date('Y-m-d')."+ 2 year"));
                Regularity::create($input2);
            }
            if($item->sworn_declaration->type == 'Examen Regular'){
                $exam_table = \App\Models\ExamTable::where('subject_id',$item->subject_id)->orderBy('date','DESC')->first();
                $input3['exam_table_id'] = $exam_table->id;
                $input3['condition_exam'] = 'Regular';
                ExamStudent::create($input3);
            }
            if($item->sworn_declaration->type == 'Examen Libre'){
                $input3['exam_table_id'] = $item->sworn_declaration->cycle_id;
                $input3['condition_exam'] = 'Libre';
                ExamStudent::create($input3);
            }
            
            if($item){
                return view('vendor.backpack.swornDeclaration.list_items', ['swornDeclarationItems' => SwornDeclarationItem::where('sworn_declaration_id', $id)->with('subject')->get()]);
            }
        }
    }

    protected function deleteSubject($id ,Request $request){
        $subject = SwornDeclarationItem::where('id', '=', $request->id)->first();
        if($subject->delete()){
            //return view('vendor.backpack.wornDeclaration.list_items', ['staff' => SwornDeclarationItem::where('license_id', $id)->with('staff')->get()]);
        }
    }
}
