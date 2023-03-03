<div class="max-w-7xl mx-auto sm:px-4 lg:px-4 h4">
Carrera: {{ auth()->user()->student[0]->career->title }}
</div>
@if (auth()->user()->student[0]->status == 'Aprobado')
    <div class="col-12 col-lg-7 text-left">
        <b class="text-grey h4">Su solicitud ha sido Aprobada</b>
        <i class="fas fa-check-circle fa-2x text-success ml-2"></i>
    </div>
    <div class="col-12 text-left mt-2">
        <b class="text-grey h6">Para completar el proceso de inscripción debe realizar el pago de la matrícula, en el mismo día en que genera el cupón de pago.</br>
    </div>
@endif
<br><br>
<div class="card-deck">
    <div class="card border-danger mb-3" >
        <a href="{{ route('student.orders', auth()->user()->student[0]->id ) }}" class="text-decoration-none">
            <div class="card-header">PAGOS</div>
            <div class="card-body text-danger">
                <p class="card-title">Sistema Arancelario</p>                
            </div>
        </a>
    </div>

    @if (auth()->user()->student[0]->status != 'Aprobado')
        <div class="card border-danger mb-3" >
            <a href="/estudiantes/exams" class="text-decoration-none">
                <div class="card-header">INSCRIPCIÓN A EXAMEN</div>
                <div class="card-body text-danger">
                    <p class="card-title">Exámenes Finales</p>
                </div>
            </a>
        </div>

        <div class="card border-danger mb-3" >
            <a href="/estudiantes/re-registrations" class="text-decoration-none">
                <div class="card-header">REINSCRIPCIÓN</div>
                <div class="card-body text-danger">
                    <p class="card-text">Texto.</p>
                </div>
            </a>
        </div>
    @endif
</div>

@if (auth()->user()->student[0]->status != 'Aprobado')
    {{--<div class="card-deck">
        <div class="card border-danger mb-3" >
            <a href="#" class="text-decoration-none">
                <div class="card-header">HISTORIAL ACADÉMICO</div>
                <div class="card-body text-danger">
                    <p class="card-text">Texto.</p>
                </div>
            </a>
        </div>

        <div class="card border-danger mb-3" >
            <a href="#" class="text-decoration-none">
                <div class="card-header">PLAN DE ESTUDIO</div>
                <div class="card-body text-danger">
                    <p class="card-title">Exámenes Finales</p>
                </div>
            </a>
        </div>

        <div class="card border-danger mb-3" >
            <a href="#" class="text-decoration-none">
                <div class="card-header">CRONOGRAMA DE EXÁMENES FINALES</div>
                <div class="card-body text-danger">
                    <p class="card-text">Texto.</p>
                </div>
            </a>
        </div>
    </div>--}}
@endif