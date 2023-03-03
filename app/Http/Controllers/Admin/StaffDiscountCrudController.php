<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffDiscountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Models\StaffDiscount;
use Illuminate\Http\Request;

/**
 * Class StaffDiscountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StaffDiscountCrudController extends CrudController
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
        CRUD::setModel(\App\Models\StaffDiscount::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/staff-discount');
        CRUD::setEntityNameStrings('descuento', 'descuentos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label' => 'Descuento',
            'type' => 'relationship',
            'name' => 'discount_id', // the method that defines the relationship in your Model
            'entity' => 'discount', // the method that defines the relationship in your Model
            'attribute' => 'description',
        ]);

        CRUD::addColumn([
            'label' => 'Personal',
            'type' => 'relationship',
            'name' => 'staff_id', // the method that defines the relationship in your Model
            'entity' => 'staff', // the method that defines the relationship in your Model
            'attribute' => 'name',
        ]);
        
        CRUD::column('amount')->label('Monto');
        CRUD::column('days')->label('Días');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'discount_id',
            'type'  => 'select2',
            'label' => 'Descuento'
        ],
            function() {
                return \App\Models\Discount::select()->distinct()->get()->pluck('description', 'id')->toArray();
            },
            function($value) { // if the filter is active
                CRUD::addClause('where', 'discount_id', $value);
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
        CRUD::setValidation(StaffDiscountRequest::class);

        CRUD::addField([
            'label' => 'Descuento',
            'type' => 'relationship',
            'name' => 'discount_id', // the method that defines the relationship in your Model
            'entity' => 'discount', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'label' => 'Personal',
            'type' => 'relationship',
            'name' => 'staff_id', // the method that defines the relationship in your Model
            'entity' => 'staff', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);
        
        CRUD::addField([
            'label' => 'Monto',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'amount', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-6'
            ],
        ]);
        
        CRUD::addField([
            'name'  => 'days',
            'label' => 'Días',
            'type' => 'number',
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6'
            ],
        ]);
        CRUD::field('days');

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

    protected function storeDiscounts($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['staff_id'] = $id;
            //$input['user_id'] = Auth::id();
            
            if(StaffDiscount::create($input)){
                return view('vendor.backpack.licenses_in_staff.discounts_items', ['discounts' => StaffDiscount::where('staff_id', $id)->with('discount')->get()]);
            }
        }
    }

    protected function storeDiscounts2($id ,Request $request){
        if(isset($request)){
            $input = $request->all();
            $input['discount_id'] = $id;
            //$input['user_id'] = Auth::id();
            
            if(StaffDiscount::create($input)){
                return view('vendor.backpack.staff_in_discounts.discounts_items', ['staff' => StaffDiscount::where('discount_id', $id)->with('staff')->get()]);
            }
        }
    }

    protected function deleteDiscounts($id ,Request $request){
        $discount = StaffDiscount::where('id', '=', $request->id)->first();
        if($discount->delete()){
            return view('vendor.backpack.licenses_in_staff.discounts_items', ['discounts' => StaffDiscount::where('staff_id', $id)->with('discount')->get()]);
        }
    }

    protected function deleteStaff($id ,Request $request){
        $staff = StaffDiscount::where('id', '=', $request->id)->first();
        $staff_discount = $staff->id;
        if($staff->delete()){
            $staff_discount = StaffDiscount::where('staff_discount_id', '=', $staff_discount)->first();
            $staff_discount->delete();
            return view('vendor.backpack.staff_in_discounts.discounts_items', ['staff' => StaffDiscount::where('discount_id', $id)->with('staff')->get()]);
        }
    }
}
