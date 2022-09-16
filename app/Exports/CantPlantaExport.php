<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\StaffSubject;
use App\Models\License;
use App\Models\Staff;
use App\Models\Job;
//use Illuminate\Support\Facades\DB::class;

class CantPlantaExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Función',
            'Privada',
            'Suplente SPEP',
            'Titular SPEP',
            'Total General',
        ];
    }
    public function collection()
    {
        $jobs = StaffSubject::select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
        $licenses = License::whereIn('id', [1, 2, 4, 15, 22, 32, 34, 35])->get();
        $staff = Staff::where('status', 'Activo')->get();
        $priv_gral = 0;                                
        $sup_spep_gral = 0;                                
        $tit_spep_gral = 0;
        foreach($jobs as $job){
            
            $j = Job::where('id', $job->job_id)->first();
            $privada = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                            ->where('job_id', $job->job_id)
                            ->where('plant_type', 'Privada')
                            ->count();
            $sup_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                            ->where('job_id', $job->job_id)
                            ->where('job_id', $job->job_id)->where('plant_type', 'Suplente Spep')
                            ->count();
            $tit_spep = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                            ->where('job_id', $job->job_id)
                            ->where('job_id', $job->job_id)->where('plant_type', 'Titular Spep')
                            ->count();
            $priv_gral += $privada;
            $sup_spep_gral += $sup_spep;
            $tit_spep_gral += $tit_spep;
            $staff_jobs = StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                            ->where('job_id', $job->job_id)
                            ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                            ->get();
            $i=1;
            
        }

        $staff = DB::table('jobs')
                    ->leftjoin('staff_subjects', 'staff_subjects.job_id', '=', 'jobs.id')
                    ->leftjoin('staff', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->where('staff.status','Activo')
                    ->select('jobs.description', 'staff.name', 'staff_subjects.plant_type')
                    ->orderBy('jobs.description','ASC')
                    //->rightjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    //->leftjoin('staff_discounts', 'staff_discounts.staff_license_id', '=', 'staff_licenses.id')
                    //->leftjoin('discounts', 'staff_discounts.discount_id', '=', 'discounts.id')
                    //->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    //->select('staff.name', 'licenses.article', 'staff_licenses.requested_days', 'staff_licenses.start_date', 'staff_licenses.end_date', 'discounts.description', 'staff_licenses.observations')
                    //->orderBy('staff.name','ASC')
                    //->where('staff.status','Activo')
                    //->whereBetween('staff_licenses.start_date', [$date1, $date2])
                    //->orWhere('staff_licenses.end_date', null)
                    ->get();

        /*$staff = DB::table('staff')
                    ->rightjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    ->leftjoin('staff_discounts', 'staff_discounts.staff_license_id', '=', 'staff_licenses.id')
                    ->leftjoin('discounts', 'staff_discounts.discount_id', '=', 'discounts.id')
                    ->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    ->select('staff.name', 'licenses.article', 'staff_licenses.requested_days', 'staff_licenses.start_date', 'staff_licenses.end_date', 'discounts.description', 'staff_licenses.observations')
                    ->orderBy('staff.name','ASC')
                    ->where('staff.status','Activo')
                    ->whereBetween('staff_licenses.start_date', [$date1, $date2])
                    ->orWhere('staff_licenses.end_date', null)
                    ->get();
*/
                    

        return $staff;
    }
}