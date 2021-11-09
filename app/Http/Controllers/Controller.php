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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function student_create(Request $request)
    {
        $rules = [
            'dni' => 'required|max:8|min:7',
        ];
        $this->validate($request, $rules);

        /*if(date('m') == 11 || date('m') == 12){
            $ciclo_academico = date('Y')+1;
        }else{
            $ciclo_academico = date('Y');
        }*/
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
        //$input['department_id'] = 7;//$request->department_id;
        $input['slug'] = $request->first_name.' '.$request->last_name;
        $input['user_id'] = auth()->user()->id;
        //$input['created_at']
        //$cycle = Cycle::whereBetween('created_at', [$ageFrom, $ageTo])
        
        $input['cycle_id'] = 1;
        $this->validate($request, $rules);
        $student = Student::create($input);

        if($request->hasFile('files')){
            $files = $request->file('files');
            $carpeta = 'public/uploads/'.$request->dni;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            foreach ($files as $clave => $file) {
                $nombrearchivo  = $file->getClientOriginalName();
                //$file->move(public_path($carpeta."/"),$nombrearchivo);
                copy($file->getRealPath(),$carpeta."/".$nombrearchivo);
                $input2['student_id'] = $student->id;
                $input2['src'] = $carpeta."/".$nombrearchivo;
                $input2['description'] = $input['description'.$clave];
                Documentation::create($input2);
            }
        }
        //return redirect('formulario_update');
        return redirect()->back();
    }

    public function student_update(Request $request)
    {
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
}
