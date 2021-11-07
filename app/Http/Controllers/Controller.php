<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Student;
use App\Models\Documentation;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function student_update(Request $request)
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
            $input['location_id'] = 0;
            
        }else{
            $input['province_id'] = 2;
            $input['location_id'] = 2;
        }
        $input['slug'] = $request->first_name.' '.$request->last_name;
        $input['user_id'] = auth()->user()->id;
        $this->validate($request, $rules);
        $student = Student::create($input);

        if($request->hasFile('files')){
            $files = $request->file('files');
            $carpeta = 'public/uploads/'.$request->dni;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            foreach ($files as $file) {
                $nombrearchivo  = $file->getClientOriginalName();
                //$file->move(public_path($carpeta."/"),$nombrearchivo);
                copy($file->getRealPath(),$carpeta."/".$nombrearchivo);
                $input2['student_id'] = $student->id;
                $input2['src'] = $carpeta."/".$nombrearchivo;
                Documentation::create($input2);
            }
        }
        return redirect()->back();
    }
}
