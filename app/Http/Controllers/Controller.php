<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Student;
use App\Models\Documentation;
use App\Models\Location;
use App\Models\Cycle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CantPlantaExport;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\StaffSubject;
use App\Models\StaffLicense;
use App\Models\Staff;
use App\Models\Job;
use App\Models\Order;
use App\Models\License;
use App\Models\ExamStudent;
use DB;

use App\Http\Requests\StudentRequestFrontend;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function studentUpdateOrCreate(StudentRequestFrontend $request)
    {
        Student::disableAuditing();

        //$estudiante = Student::where('user_id', auth()->user()->id)->first();
        $input = $request->all();

   
        if($request->nationality_id != 1){
            $input['province_id'] = 0;
            $input['department_id'] = 0;
            $input['location_id'] = 0;
        }
        if($request->province_id != 1){
            $input['department_id'] = 0;
            $input['location_id'] = 0;
        }
        $input['user_id'] = auth()->user()->id;
        $input['cycle_id'] = 2;
        $input['status'] = 'Solicitado';
        
        $condition = ["user_id" => auth()->user()->id];
        $student = Student::updateOrCreate($condition,$input);

        if($request->hasFile('files')){
            $files = $request->file('files');
            $folder = 'public/uploads/'.$request->dni;
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            foreach ($files as $key => $file) {
                $filename  = $file->getClientOriginalName();
                copy($file->getRealPath(),$folder."/".$filename);
                $inputFile['student_id'] = $student->id;
                $inputFile['src'] = $folder."/".$filename;
                $inputFile['description'] = $input['description'.$key];

                Documentation::create($inputFile);
            }
        }

        Student::enableAuditing();
        return redirect()->back();
    }

    public function getLocalidades($id){
        $localidades = Location::where('department_id', $id)->orderBy('description', 'asc')->get();
        return response()->json($localidades);
    }

    public function form_pdf(Request $request){
        $input = $request->all();
        $estudiante = Student::where('user_id', $input['id'])->with(['province','department','nationality'])->get();
        $pdf = PDF::loadView("form_pdf", [
            "estudiante" => $estudiante[0],
        ]);
        return $pdf->stream('Formulario N° '.$estudiante[0]->dni.'.pdf');
    }

    /*public function exportCantPlanta(){
        return Excel::download(new CantPlantaExport, 'cant_planta.xlsx');
    }*/

    public function exportCantPlanta()
    { 
        $data = array();
        $jobs = StaffSubject::select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
        //$licenses = App\Models\License::whereIn('id', [1, 2, 4, 15, 22, 32, 34, 35])->get();
        $staff = Staff::where('status', 'Activo')->get();

        $priv_gral = 0;                                
        $sup_spep_gral = 0;                                
        $tit_spep_gral = 0;

        foreach($jobs as $job){
            $j = Job::where('id', $job->job_id)->first();
            $privada = 0;
            $sup_spep = 0;
            $tit_spep = 0;
            if($j->id == 6 || $j->id == 11){
                if(date('m') > 06){
                    $privada = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '2do Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Privada')
                                ->count();
                    $sup_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '2do Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Suplente Spep')
                                ->count();
                    $tit_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '2do Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Titular Spep')
                                ->count();
                }else{
                    $privada = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '1er Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Privada')
                                ->count();
                    $sup_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '1er Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Suplente Spep')
                                ->count();
                    $tit_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                ->where('job_id', $job->job_id)
                                ->where(function($q) {$q
                                    ->where('plant_mode', '1er Cuatrimestre')
                                    ->orWhere('plant_mode', 'Anual');
                                })
                                ->where('plant_type', 'Titular Spep')
                                ->count();
                }
                
                $priv_gral += $privada;
                $sup_spep_gral += $sup_spep;
                $tit_spep_gral += $tit_spep;
            }else{
                foreach ($staff as $l) {
                    if(date('m') > 06){
                        $staff_subjects = StaffSubject::where('staff_id', $l->id)->where(function($q) {$q->where('plant_mode', '2do Cuatrimestre')->orWhere('plant_mode', 'Anual');})->get()->unique('staff_id');
                    }else{
                        $staff_subjects = StaffSubject::where('staff_id', $l->id)->where(function($q) {$q->where('plant_mode', '1er Cuatrimestre')->orWhere('plant_mode', 'Anual');})->get()->unique('staff_id');
                    }
                    foreach ($staff_subjects as $staff_subject) {
                        if(StaffSubject::where('plant_type', 'Privada')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$privada++;}
                        if(StaffSubject::where('plant_type', 'Suplente Spep')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$sup_spep++;}
                        if(StaffSubject::where('plant_type', 'Titular Spep')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$tit_spep++;}
                    }   
                }
                $priv_gral += $privada;
                $sup_spep_gral += $sup_spep;
                $tit_spep_gral += $tit_spep;
            }
            
            array_push($data, [ 
                "Funcion" => $j->description,
                "Privada" => $privada,
                "Suplente SPEP" => $sup_spep,
                "Titular SPEP" => $tit_spep,
                "Total General" => $privada + $sup_spep + $tit_spep,
            ]);
        }
        array_push($data, [ 
            "Funcion" => 'Total General',
            "Privada" => $priv_gral,
            "Suplente SPEP" => $sup_spep_gral,
            "Titular SPEP" => $tit_spep_gral,
            "Total General" => $priv_gral + $sup_spep_gral + $tit_spep_gral,
        ]);
        return (new FastExcel($data))->download('cantidad_por_planta.xlsx');
    }

    public function exportLicPlanta()
    { 
        $data = array();
        $licenses = License::whereIn('id', [1, 2, 4, 15, 22, 32, 34, 35])->get();
        $priv_gral = 0;                                
        $sup_spep_gral = 0;                                
        $tit_spep_gral = 0;     

        $mes_ant = date('m', strtotime('-1 month'));
        $mes = date('m');
        $mes_sig = date('m', strtotime('+1 month'));

        $year_ant = date('Y', strtotime('-1 year'));
        $year = date('Y');
        $year_sig = date('Y', strtotime('+1 year'));

        if(date('d') > 20){
            if($mes == 12){
                $date1 = $year.$mes.'-20';
                $date2 = $year_sig.'01-20';
            }else{
                $date1 = $year.'-'.$mes.'-20';
                $date2 = $year.'-'.$mes_sig.'-20';
            }
        }else{
            if($mes == 1){
                $date1 = $year_ant.'-12-20';
                $date2 = $year.$mes.'-20';
            }else{
                $date1 = $year.'-'.$mes_ant.'-20';
                $date2 = $year.'-'.$mes.'-20';
            }
        }
        foreach($licenses as $license){
            $staff_licenses = StaffLicense::whereHas('staff', function($q){$q->where('status', 'Activo');})
                        ->where('license_id', $license->id)
                        ->where(function($q) use ($date1, $date2){
                            $q->whereBetween('start_date', [$date1, $date2])
                            ->orWhere('end_date', null);
                        })
                        ->get();
            $privada = 0;
            $sup_spep = 0;
            $tit_spep = 0;
            foreach ($staff_licenses as $staff_license) {
                if($staff_license->staff->subjects[0]->pivot->plant_type == 'PRIVADA'){$privada++;}
                if($staff_license->staff->subjects[0]->pivot->plant_type == 'SUPLENTE SPEP'){$sup_spep++;}
                if($staff_license->staff->subjects[0]->pivot->plant_type == 'TITULAR SPEP'){$tit_spep++;}
            }
            $priv_gral += $privada;
            $sup_spep_gral += $sup_spep;
            $tit_spep_gral += $tit_spep;

            array_push($data, [ 
                "Licencia" => $license->article,
                "Privada" => $privada,
                "Suplente SPEP" => $sup_spep,
                "Titular SPEP" => $tit_spep,
                "Total General" => $privada + $sup_spep + $tit_spep,
            ]);
        }
        array_push($data, [ 
            "Licencia" => 'Total General',
            "Privada" => $priv_gral,
            "Suplente SPEP" => $sup_spep_gral,
            "Titular SPEP" => $tit_spep_gral,
            "Total General" => $priv_gral + $sup_spep_gral + $tit_spep_gral,
        ]);
        return (new FastExcel($data))->download('licencias_por_planta.xlsx');
    }

    public function exportHorarioPlanta()
    { 
        $data = array();
        $jobs = StaffSubject::select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
        $staff = Staff::where('status', 'Activo')->get();
        $priv_gral = 0;                                
        $sup_spep_gral = 0;                                
        $tit_spep_gral = 0;  

        foreach($jobs as $job){

            $j = Job::where('id', $job->job_id)->first();
                $privada = 0;
                $sup_spep = 0;
                $tit_spep = 0;
                if($j->id == 6 || $j->id == 11){
                    $privada = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                    ->where('job_id', $job->job_id)
                                    ->where('plant_type', 'Privada')
                                    ->sum('weekly_hours');
                    $sup_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                    ->where('job_id', $job->job_id)
                                    ->where('job_id', $job->job_id)->where('plant_type', 'Suplente Spep')
                                    ->sum('weekly_hours');
                    $tit_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                    ->where('job_id', $job->job_id)
                                    ->where('job_id', $job->job_id)->where('plant_type', 'Titular Spep')
                                    ->sum('weekly_hours');
                    $priv_gral += $privada;
                    $sup_spep_gral += $sup_spep;
                    $tit_spep_gral += $tit_spep;
                }else{
                    foreach ($staff as $l) {
                        $staff_subjects = StaffSubject::where('staff_id', $l->id)->get()->unique('staff_id');
                        foreach ($staff_subjects as $staff_subject) {
                            if(StaffSubject::where('plant_type', 'Privada')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$privada += $staff_subject->weekly_hours;}
                            if(StaffSubject::where('plant_type', 'Suplente Spep')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$sup_spep += $staff_subject->weekly_hours;}
                            if(StaffSubject::where('plant_type', 'Titular Spep')->where('id', $staff_subject->id)->where('job_id', $job->job_id)->first()){$tit_spep += $staff_subject->weekly_hours;}
                        }   
                    }
                    $priv_gral += $privada;
                    $sup_spep_gral += $sup_spep;
                    $tit_spep_gral += $tit_spep;
                }

            array_push($data, [ 
                "Función" => $j->description,
                "Privada" => $privada,
                "Suplente SPEP" => $sup_spep,
                "Titular SPEP" => $tit_spep,
                "Total General" => $privada + $sup_spep + $tit_spep,
            ]);
        }
        array_push($data, [ 
            "Función" => 'Total General',
            "Privada" => $priv_gral,
            "Suplente SPEP" => $sup_spep_gral,
            "Titular SPEP" => $tit_spep_gral,
            "Total General" => $priv_gral + $sup_spep_gral + $tit_spep_gral,
        ]);
        return (new FastExcel($data))->download('licencias_por_planta.xlsx');
    }

}
