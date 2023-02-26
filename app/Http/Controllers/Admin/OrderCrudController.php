<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\MonthlyOrder;
use App\States\Order\Expired;

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

    public function aprobeStudent(Student $student){
        try {
            $student->status = "Aprobado";
            $student->save();

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function generateMonthlyOrders(){

        $month_number = date('n');

        $students = Student::where('status', 'Inscripto')
            ->where('cycle_id', 2) //TODO:  cambiar a variable
            ->get();

        foreach ($students as $student) {
            try {
                if( empty($this->crud->model::monthly()->pending()->where('student_id', $student->id)->where('description', "Mensual_$month_number")->get()->toArray()) ){
                
                    MonthlyOrder::create([
                        'student_id' => $student->id,
                        'description' => "Mensual_$month_number",
                        'amount' => $student->career["month_$month_number"],
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function expiredOrders(){

        foreach ( $this->crud->model::pending()->where('expiration_at', '<=', date('Y-m-d H:i:s'))->get() as $order) {
            !$order->state->canTransitionTo(Expired::class) ?: $order->state->transitionTo(Expired::class);
        }
    }

    public function metrics(){
        $totals = [];
        for ($i=1; $i <= 12; $i++) { 
            $totals[$i] = $this->getTotalAmountMonthly($i);
        }

        $totals = json_encode($totals);

        return view('metrics', compact('totals'));
    }

    public function getTotalAmountMonthly($month_number){

        $query = $this->crud->model::monthly()
            ->where('description', "Mensual_$month_number")
            ->selectRaw('SUM( amount ) AS total');

        return array(
            "paid" =>  $query
                ->paid()
                ->get()
                ->pluck('total')[0],
            "pending" =>  $query
                ->pending()
                ->get()
                ->pluck('total')[0],
        );
    }

    public static function routes()
    {
        Route::post('createOrder/{student}', [self::class, 'aprobeStudent']);//TODO: mover a estudiantes crud controllers
        Route::get('generate_monthly_orders', [self::class, 'generateMonthlyOrders']);//TODO: boton para generar mensualmente
        Route::get('expire_orders', [self::class, 'expiredOrders']);
        Route::get('metrics_orders', [self::class, 'metrics'])->name('metrics_orders');
    }
}