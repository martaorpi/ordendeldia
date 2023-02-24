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
        CRUD::setCreateView('vendor/backpack/staff_licenses/create');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::removeButton('update');
        CRUD::removeButton('delete');
        CRUD::removeButton('show');
        //CRUD::column('staff_id');
        CRUD::column('license_id')->label('Licencia');
        CRUD::column('requested_days')->label('Días Solicitados');
        CRUD::column('application_date')->label('Fecha Solicitud');
        CRUD::column('authorized_date')->label('Fecha Autorización');
        CRUD::column('start_date')->label('Fecha Inicio');
        CRUD::column('end_date')->label('Fecha Fin');
        //CRUD::column('user_id');
        CRUD::column('status')->label('Estado');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        /************* FILTROS *************/

        CRUD::addFilter([
            'name'  => 'staff_id',
            'type'  => 'select2',
            'label' => 'Personal'
        ], function() {
            return \App\Models\Staff::all()->pluck('name', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'staff_id', $value);
        });

        CRUD::addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
        ], [
            'Solicitada' => 'Solicitada',
            'Autorizada'=> 'Autorizada',
            'En Curso' => 'En Curso',
            'Rechazada' => 'Rechazada',
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
        CRUD::setValidation(StaffLicenseRequest::class);

        CRUD::addField([
            'type' => 'number',
            'name' => 'staff_id',
            'value' => 75,
            'attributes' => [
                'hidden' => 'hidden',
            ],
        ]);

        CRUD::addField([
            'type' => 'number',
            'name' => 'user_id',
            'value' => auth()->user()->id,
            'attributes' => [
                'hidden' => 'hidden',
            ],
        ]);

        CRUD::field('staff_id');
        CRUD::field('license_id');
        CRUD::field('requested_days');
        CRUD::field('application_date');
        CRUD::field('authorized_date');
        CRUD::field('start_date');
        CRUD::field('end_date');
        CRUD::addField([
            'name'  => 'status',
            'label' => 'Estado',
            'type' => 'enum',
            'value' => 'Solicitado',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-3'
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
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

    protected function getLicenses($id){
        $licenses = \App\Models\StaffLicense::where('staff_id', $id)->get();
        //return $licenses;
        return view('vendor.backpack.licenses_in_staff.licenses_staff', ['staff' => StaffLicense::where('staff_id', $id)->with('staff')->get()]);
    }
}
