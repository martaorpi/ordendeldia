<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\EnrollmentOrder;

use App\Mail\StudentsMailable;
use Illuminate\Support\Facades\Mail;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        $studentsMail = new StudentsMailable;
        Mail::to($student->user->email)->send($studentsMail->mailFormCompleted());
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {        
        if($student->status == "Aprobado"){
            try {  
                EnrollmentOrder::create([
                    'student_id' => $student->id,
                    'description' => 'Matricula',
                    'amount' => $student->career->amount,
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
        }

        if($student->status == "Inscripto"){

            $studentsMail = new StudentsMailable;
            Mail::to($student->user->email)->send($studentsMail->mailEnrolled());
        }
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
