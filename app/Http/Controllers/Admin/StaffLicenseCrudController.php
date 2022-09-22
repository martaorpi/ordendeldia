<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffLicenseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\StaffLicense;
use \App\Models\StaffDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class StaffLicenseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StaffLicenseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\StaffLicense::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/staff-license');
        CRUD::setEntityNameStrings('licencia', 'licencias');
        //$this->crud->setListView('vendor/backpack/inc/licenses_items');
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
        CRUD::column('license_id');
        CRUD::column('requested_days');
        CRUD::column('application_date');
        CRUD::column('authorized_date');
        CRUD::column('start_date');
        CRUD::column('end_date');
        CRUD::column('user_id');
        CRUD::column('status');

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
    /*protected function setupCreateOperation()
    {
        CRUD::setValidation(StaffLicenseRequest::class);

        CRUD::field('id');
        CRUD::field('staff_id');
        CRUD::field('license_id');
        CRUD::field('requested_days');
        CRUD::field('application_date');
        CRUD::field('authorized_date');
        CRUD::field('start_date');
        CRUD::field('end_date');
        CRUD::field('user_id');
        CRUD::field('status');
        CRUD::field('created_at');
        CRUD::field('updated_at');

        
    }*/

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

    protected function storeLicenses($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['staff_id'] = $id;
            $input['user_id'] = Auth::id();
            $staff_license = StaffLicense::create($input);
            
            if($staff_license){
                if(($input['license_id'] < 7 || $input['license_id'] > 12) && 
                    $input['license_id'] != 14 && 
                    ($input['license_id'] < 16 || $input['license_id'] > 20) && 
                    $input['license_id'] != 29 && 
                    $input['license_id'] != 33 &&
                    ($input['license_id'] < 38 || $input['license_id'] > 40) &&
                    ($input['license_id'] < 42 || $input['license_id'] > 47) &&
                    $input['license_id'] != 50 &&
                    $input['license_id'] != 54){
                        $input2['staff_id'] = $id;
                        $input2['staff_license_id'] = $staff_license->id;
                        $input2['discount_id'] = 1;//presentismo
                        $input2['days'] = $input['requested_days'];
                        StaffDiscount::create($input2);
                }
                if($input['license_id'] == 59 || (date('Y-m-d') >= date('Y').'01-01' && date('Y-m-d') <= date('Y').'01-31')){
                    $input2['staff_id'] = $id;
                    $input2['staff_license_id'] = $staff_license->id;
                    $input2['discount_id'] = 2;//transporte
                    $input2['days'] = $input['requested_days'];
                    StaffDiscount::create($input2);
                }
                return view('vendor.backpack.licenses_in_staff.licenses_items', ['licenses' => StaffLicense::where('staff_id', $id)->with('license')->get()]);
            }
        }
    }

    protected function deleteLicenses($id ,Request $request){
        $license = StaffLicense::where('id', '=', $request->id)->first();
        $staff_license = $license->id;
        if($license->delete()){
            $staff_discount = StaffDiscount::where('staff_license_id', '=', $staff_license)->first();
            $staff_discount->delete();
            return view('vendor.backpack.licenses_in_staff.licenses_items', ['licenses' => StaffLicense::where('staff_id', $id)->with('license')->get()]);
        }
    }

    protected function storeLicenses2($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['license_id'] = $id;
            $input['user_id'] = Auth::id();
            $staff_license = StaffLicense::create($input);
            
            if($staff_license){
                if(($input['license_id'] < 7 || $input['license_id'] > 12) && 
                    $input['license_id'] != 14 && 
                    ($input['license_id'] < 16 || $input['license_id'] > 20) && 
                    $input['license_id'] != 29 && 
                    $input['license_id'] != 33 &&
                    ($input['license_id'] < 38 || $input['license_id'] > 40) &&
                    ($input['license_id'] < 42 || $input['license_id'] > 47) &&
                    $input['license_id'] != 50 &&
                    $input['license_id'] != 54){
                        $input2['staff_id'] = $id;
                        $input2['staff_license_id'] = $staff_license->id;
                        $input2['discount_id'] = 1;//presentismo
                        $input2['days'] = $input['requested_days'];
                        StaffDiscount::create($input2);
                }
                if($input['license_id'] == 59 || (date('Y-m-d') >= date('Y').'01-01' && date('Y-m-d') <= date('Y').'01-31')){
                    $input2['staff_id'] = $id;
                    $input2['staff_license_id'] = $staff_license->id;
                    $input2['discount_id'] = 2;//transporte
                    $input2['days'] = $input['requested_days'];
                    StaffDiscount::create($input2);
                }
                return view('vendor.backpack.staff_in_licenses.licenses_items', ['staff' => StaffLicense::where('license_id', $id)->with('staff')->get()]);
            }
        }
    }

    protected function deleteStaff($id ,Request $request){
        $staff = StaffLicense::where('id', '=', $request->id)->first();
        $staff_license = $staff->id;
        if($staff->delete()){
            $staff_discount = StaffDiscount::where('staff_license_id', '=', $staff_license)->first();
            $staff_discount->delete();
            return view('vendor.backpack.staff_in_licenses.licenses_items', ['staff' => StaffLicense::where('license_id', $id)->with('staff')->get()]);
        }
    }
}
