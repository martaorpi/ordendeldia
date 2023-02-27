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

        /*CRUD::addColumn([
            'name'=> 'tariff_category',
            'label'=> 'Categoría Arancelaria',
            'type' => "relationship",
            'attribute' => "description",
        ]);*/
        
        CRUD::addColumn([
            'name'    => 'state',
            'type'    => 'closure',
            'label'   => 'Estado',
            'function' => function($entry) {
                switch ($entry->state) {
                    case 'App\States\Order\Pending': $state = 'Pendiente'; break;
                    case 'App\States\Order\Paid': $state = 'Pagado'; break;
                }               
                return $state;
            }
        ]);

        CRUD::addColumn([
            'name'    => 'type',
            'type'    => 'closure',
            'label'   => 'Tipo',
            'function' => function($entry) {
                switch ($entry->type) {
                    case 'App\Models\Order': $type = 'Matricula'; break;
                    case 'App\Models\MonthlyOrder': $type = 'Cuota Mensual'; break;
                    case 'App\Models\ExtraOrder': $type = 'Otro'; break;
                }               
                return $type;
            }
        ]);
        
        CRUD::column('amount')->label('Monto');

        CRUD::addColumn([
            'name'=> 'expirated_at',
            'label'=> 'Vencimiento',
            'type'  => 'date',
            'format'   => 'l',
        ]);

        CRUD::addColumn([
            'name'=> 'created_at',
            'label'=> 'Creacion',
            'type'  => 'date',
            'format'   => 'l',
        ]);

        /*CRUD::addColumn([
            'name'=> 'updated_at',
            'label'=> 'Pago',
            'type'  => 'date',
            'format'   => 'l',
        ]);*/

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addFilter([
            'name'  => 'state',
            'type'  => 'dropdown',
            'label' => 'Estado'
        ], [
            'App\States\Order\Pending' => 'Pendiente',
            'App\States\Order\Paid'=> 'Pagado',
        ]);

        /*CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'updated_at',
            'label' => 'Pago'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'updated_at', '>=', $dates->from);
            $this->crud->addClause('where', 'updated_at', '<=', $dates->to . ' 23:59:59');
        });*/

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'expirated_at',
            'label' => 'Vencimiento'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'expirated_at', '>=', $dates->from);
            $this->crud->addClause('where', 'expirated_at', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addFilter([
            'name'  => 'type',
            'type'  => 'dropdown',
            'label' => 'Tipo'
        ], [
            'App\Models\Order' => 'Matricula',
            'App\Models\MonthlyOrder'=> 'Cuota Mensual',
            'App\Models\ExtraOrder'=> 'Otro',
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

        /*CRUD::addField([
            'label' => 'Categoría Arancelaria',
            'type' => 'relationship',
            'name' => 'tariff_account_id', // the method that defines the relationship in your Model
            'entity' => 'tariff_category', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'wrapper'   => [
                'class' => 'form-group col-12 col-lg-6',
            ],
        ]);*/

        CRUD::addField([
            'name'        => 'state',
            'label'       => "Estado",
            'type'        => 'select_from_array',
            'options'     => ['App\States\Order\Pending' => 'Pendiente', 'App\States\Order\Paid' => 'Pagado'],
            'allows_null' => false,
            'default'     => '',
            'wrapper'   => [
                'class' => 'col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'name'        => 'type',
            'label'       => "Tipo",
            'type'        => 'select_from_array',
            'options'     => ['App\Models\Order' => 'Matricula', 'App\Models\MonthlyOrder' => 'Cuota Mensual', 'App\Models\ExtraOrder' => 'Otro'],
            'allows_null' => false,
            'default'     => '',
            'wrapper'   => [
                'class' => 'col-12 col-lg-6'
            ],
        ]);

        CRUD::addField([
            'name'  => 'expirated_at',
            'label' => 'Vencimiento',
            'type' => 'date',
            'wrapper'   => [
                'class' => 'col-12 col-lg-6'
            ],
        ]);
        
        CRUD::addField([
            'label' => 'Monto',
            'type' => 'number',
            'attributes' => ['step' => 0.01],
            'name' => 'amount', // the method that defines the relationship in your Model
            'wrapper'   => [
                'class' => 'col-12 col-lg-6 mt-3'
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

        foreach ( $this->crud->model::pending()->where('expirated_at', '<=', date('Y-m-d H:i:s'))->get() as $order) {
            !$order->state->canTransitionTo(Expired::class) ?: $order->state->transitionTo(Expired::class);
        }
    }

    public function metrics(){
        $totals = [];
        $total_paied = 0;
        $total_pending = 0;
        for ($i=1; $i <= 12; $i++) { 
            $totals[$i] = $this->getTotalAmountMonthly($i);
            $total_paied += $totals[$i]["paid"];
            $total_pending += $totals[$i]["pending"];
        }

        //$totals = json_encode($totals);

        return view('metrics', compact('totals', 'total_paied', 'total_pending'));
    }

    public function getTotalAmountMonthly($month_number){

        $query = $this->crud->model::whereMonth('paied_at', '=', $month_number)
            //->where('description', "Mensual_$month_number")
            //->orwhere('description', "Matricula")
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

    public function payment_coupon(){
        return view('payment_coupon');
    }

    public static function routes()
    {
        Route::post('createOrder/{student}', [self::class, 'aprobeStudent']);//TODO: mover a estudiantes crud controllers
        Route::get('generate_monthly_orders', [self::class, 'generateMonthlyOrders']);//TODO: boton para generar mensualmente
        Route::get('expire_orders', [self::class, 'expiredOrders']);
        Route::get('metrics_orders', [self::class, 'metrics'])->name('metrics_orders');
        Route::get('payment_coupon', [self::class, 'payment_coupon'])->name('payment_coupon');
    }
}
