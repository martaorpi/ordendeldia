<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LicenseExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Apellido y Nombre',
            'Artículo',
            'Días',
            'Fecha Inicio',
        ];
    }
    public function collection()
    {
        $mes_ant = date('m', strtotime('-1 month'));
        $mes = date('m');
        $mes_sig = date('m', strtotime('+1 month'));

        if(date('d') > 20){
            $date1 = '2022-'.$mes.'-20';
            $date2 = '2022-'.$mes_sig.'-20';
        }else{
            $date1 = '2022-'.$mes_ant.'-20';
            $date2 = '2022-'.$mes.'-20';
        }
        
        $staff = DB::table('staff')
                    //->leftjoin('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->rightjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    //->leftjoin('jobs', 'jobs.id', '=', 'staff.job_id')
                   // ->leftjoin('subjects', 'subjects.id', '=', 'staff_subjects.subject_id')
                    ->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    ->select('staff.name', 'licenses.article', 'staff_licenses.requested_days', 'staff_licenses.start_date')
                    ->orderBy('staff.name','ASC')
                    ->where('staff.status','Activo')
                    ->whereBetween('staff_licenses.start_date', [$date1, $date2])
                    ->get();

        return $staff;
    }
}