<?php

namespace App\Exports;

use App\Models\Staff;
use App\Models\Subject;
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

        $staff = DB::table('staff')
                    ->join('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->join('jobs', 'jobs.id', '=', 'staff.job_id')
                    ->join('subjects', 'subjects.id', '=', 'staff_subjects.subject_id')
                    ->select('staff_subjects.plant_mode', 'staff_subjects.plant_type', 'staff.name', 'jobs.description as description1', 'staff_subjects.time_type', 'staff_subjects.weekly_hours', 
                            'subjects.description as description2', 'staff_subjects.observations')
                    ->orderBy('staff.name','ASC')
                    ->get();

        /*$staff = DB::table('staff')
                    ->join('staff_subjects', 'staff_subjects.staff_id', '=', 'staff.id')
                    ->join('jobs', 'jobs.id', '=', 'staff.job_id')
                    ->select('staff_subjects.plant_mode', 'staff_subjects.plant_type', 'staff.name', 'jobs.description as description1', 'staff_subjects.time_type', 'staff_subjects.weekly_hours', 
                            'staff_subjects.subject_id', 'staff_subjects.observations')
                    ->where('staff_subjects.subject_id', 0)
                    ->orderBy('staff.name','ASC')
                    ->get();*/
        /*foreach ($subjects as $subject) {
            
        }*/
        return $staff;

    }
}