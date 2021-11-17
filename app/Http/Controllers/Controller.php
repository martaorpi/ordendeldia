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
        $input['cycle_id'] = 1;
        
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
}
