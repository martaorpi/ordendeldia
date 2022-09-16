<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\StaffSubject;
use App\Models\License;
use App\Models\Staff;
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

        return $staff;*/
    }
}