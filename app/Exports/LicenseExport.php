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
            'Fecha Fin',
            'Descuento',
            'Observaciones',
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

        return $staff;
    }
}