<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffSubjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\StaffSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class StaffSubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StaffSubjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\StaffSubject::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/staff-subject');
        CRUD::setEntityNameStrings('staff subject', 'staff subjects');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('staff_id');
        CRUD::column('subject_id');
        CRUD::column('amount')->label('cantidad');
        CRUD::column('score')->label('puntaje');
        CRUD::column('job_id');
        CRUD::column('plant_mode');
        CRUD::column('plant_type');
        CRUD::column('time_type');
        CRUD::column('weekly_hours');
        CRUD::column('state_charge_score');
        CRUD::column('charge_score_ismp');
        CRUD::column('hours_score_ismp');
        CRUD::column('start_date');
        CRUD::column('end_date');
        CRUD::column('resolution_number');
        CRUD::column('observations');
     
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
        CRUD::setValidation(StaffSubjectRequest::class);

        CRUD::field('staff_id');
        CRUD::field('subject_id');
        CRUD::field('job_id');
        CRUD::field('plant_mode');
        CRUD::field('plant_type');
        CRUD::field('time_type');
        CRUD::field('weekly_hours');
        CRUD::field('state_charge_score');
        CRUD::field('charge_score_ismp');
        CRUD::field('hours_score_ismp');
        CRUD::field('start_date');
        CRUD::field('end_date');
        //CRUD::field('resolution_number');
        CRUD::field('observations');
        CRUD::field('amount')->label('cantidad');
        
        CRUD::addField([
            'label' => 'Puntaje',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'score', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-4'
            ],
        ]);

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

    protected function storeSubjects($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['staff_id'] = $id;
            $input['user_id'] = Auth::id();
            $staff_subject = StaffSubject::create($input);
            
            if($staff_subject){
                return view('vendor.backpack.licenses_in_staff.subjects_items', ['subjects_staff' => StaffSubject::where('staff_id', $id)->with('subject')->get()]);
            }
        }
    }

    protected function deleteSubjects($id ,Request $request){
        $subject = StaffSubject::where('id', '=', $request->id)->first();
        if($subject->delete()){
            return view('vendor.backpack.licenses_in_staff.subjects_items', ['subjects_staff' => StaffSubject::where('staff_id', $id)->with('subject')->get()]);
        }
    }
}
