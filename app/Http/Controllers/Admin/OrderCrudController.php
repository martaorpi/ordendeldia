<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use App\Models\Student;
use App\Models\Career;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('Orden', 'ordenes');
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
            'name'=> 'student',
            'label'=> 'Estudiante',
            'type' => "relationship",
            'attribute' => "full_name",
        ]);

        CRUD::addColumn([
            'name'=> 'tariff_category',
            'label'=> 'Categoría Arancelaria',
            'type' => "relationship",
            'attribute' => "description",
        ]);
        
        CRUD::column('state')->label('Estado');
        CRUD::column('amount')->label('Monto');

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
        CRUD::setValidation(OrderRequest::class);

        CRUD::addField([
            'label' => 'Estudiante',
            'type' => 'relationship',
            'name' => 'student_id', // the method that defines the relationship in your Model
            'entity' => 'student', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6',
            ],
        ]);

        CRUD::addField([
            'label' => 'Categoría Arancelaria',
            'type' => 'relationship',
            'name' => 'tariff_account_id', // the method that defines the relationship in your Model
            'entity' => 'tariff_category', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6',
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

    }

    public function createOrder($id){
        try {
            $student = Student::find($id);



            Order::create([
                'student_id' => $id,
                'tariff_account_id' => 1,
                'amount' => 5000,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public static function routes()
    {
        Route::post('createOrder/{id}', [self::class, 'createOrder']);
    }
}
