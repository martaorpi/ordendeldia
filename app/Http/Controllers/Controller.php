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
use App\Models\Staff;
use App\Models\Job;
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



        $email_destino = $student->user->email;

        $cuerpo = '<style>
            .footer-copyright-area {
                background: linear-gradient(178deg, #e12503 0%, #85060c 100%);
                padding: 20px 0px 10px 0;
                text-align: center;
                color: #fff;
                font-size: 12px;
            }
            .linea{
                padding-top:0;
                margin-top:0;
                background: black;
            }
            .link{
                color: #a52929;
                text-decoration: underline;
            }
            .link:hover{
                color: black;
            }
            </style>
            <!DOCTYPE html>
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>ISMP</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
                </head>
                <body style="margin: 0; padding: 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="500">
                        <tr style="padding-bottom:0">
                            <td align="left" bgcolor="#fff" style="border-left: 1px solid grey;border-right: 1px solid grey;">
                                <img src="https://devweb.com.ar/ismp.academico/images/logo.jpg" width="150" style="margin-bottom:0"/>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 10px 30px 20px 30px;border-left: 1px solid grey;border-right: 1px solid grey;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <p class="text-left">
                                                <b>'.utf8_decode("Luego de realizar un análisis de la documentación presentada se observa lo siguiente:").'</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td align="right" style="padding-left:40%;padding-top:0">
                                            <hr class="linea">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-left" style="padding:0 10% 0 10%" id="observaciones"></p>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td align="left" style="padding-right:40%;padding-top:0">
                                            <hr class="linea">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <br><i>Gracias por elegir el ISMP<br>
                                            '.utf8_decode("Te deseamos éxitos en tu formación profesional.").'</i>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="background: linear-gradient(178deg, #e12503 0%, #85060c 100%); padding: 20px 0px 10px 0; text-align: center; color: #fff; font-size: 12px;">
                                    <p>Copyright &copy; '.date("Y").' <b>DevWeb</b> Todos los derechos reservados.</p>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </body>
            </html>';
        //$this->sendMail($email_destino,$cuerpo);

        $asunto = "Informacion ISMP";
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ISMP Soporte <info@devweb.com.ar>\r\n"; 

        if($email_destino != ''){
            mail($email_destino, $asunto, $cuerpo, $headers);
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
            
            
                

            array_push($data, [ 
                "Nro" => $i,
                "Funcion" => $j->description,
                "Privada" => $privada,
                "Suplente SPEP" => $sup_spep,
                "Titular SPEP" => $tit_spep,
                "Total General" => $privada + $sup_spep + $tit_spep,
            ]);
            
        }
        return (new FastExcel($data))->download('general.xlsx');
    }
}
