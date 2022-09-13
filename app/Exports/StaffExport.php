<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Modalidad Planta',
            'Tipo de Planta',
            'Apellido y Nombre',
            'Función',
            'Tipo de Hora',
            'Horas Semanales',
            'Asignatura',
            'Observaciones',
        ];
    }
    public function collection()
    {
        if(date('m') == 4 || date('m') == 8){
            $staff = DB::table('staff')
                    ->leftjoin('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->leftjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    ->leftjoin('jobs', 'jobs.id', '=', 'staff.job_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'staff_subjects.subject_id')
                    ->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    ->select('staff_subjects.plant_mode', 'staff_subjects.plant_type', 'staff.name', 'jobs.description as description1', 'staff_subjects.time_type', 'staff_subjects.weekly_hours', 
                            'subjects.description as description2', 'staff_subjects.observations', 'licenses.article')
                    ->orderBy('staff.name','ASC')
                    ->get();
        }
        if(date('m') > 4 && date('m') < 8){
            $staff = DB::table('staff')
                    ->leftjoin('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->leftjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    ->leftjoin('jobs', 'jobs.id', '=', 'staff.job_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'staff_subjects.subject_id')
                    ->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    ->select('staff_subjects.plant_mode', 'staff_subjects.plant_type', 'staff.name', 'jobs.description as description1', 'staff_subjects.time_type', 'staff_subjects.weekly_hours', 
                            'subjects.description as description2', 'staff_subjects.observations', 'licenses.article')
                    ->orderBy('staff.name','ASC')
                    ->where('staff_subjects.plant_mode', '=', '1er Cuatrimestre')
                    ->orWhere('staff_subjects.plant_mode', '=', 'Anual')
                    ->get();
        }
        if(date('m') > 8){
            $staff = DB::table('staff')
                    ->leftjoin('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->leftjoin('staff_licenses', 'staff_licenses.staff_id', '=', 'staff.id')
                    ->leftjoin('jobs', 'jobs.id', '=', 'staff.job_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'staff_subjects.subject_id')
                    ->leftjoin('licenses', 'licenses.id', '=', 'staff_licenses.license_id')
                    ->select('staff_subjects.plant_mode', 'staff_subjects.plant_type', 'staff.name', 'jobs.description as description1', 'staff_subjects.time_type', 'staff_subjects.weekly_hours', 
                            'subjects.description as description2', 'staff_subjects.observations', 'licenses.article')
                    ->orderBy('staff.name','ASC')
                    ->where('staff_subjects.plant_mode', '=', '2do Cuatrimestre')
                    ->orWhere('staff_subjects.plant_mode', '=', 'Anual')
                    ->get();
        }
        return $staff;
    }
}