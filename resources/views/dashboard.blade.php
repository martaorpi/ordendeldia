<x-app-layout>
    <x-slot name="header"></x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!empty(auth()->user()->student[0]))
                        <div class="row">
                            <div class="col-12 col-lg-7 text-left">
                                <b class="text-grey h2">Su solicitud está siendo procesada</b>
                                <i class="fas fa-check-circle fa-2x text-success ml-2"></i>
                            </div>
                            <div class="col-12 col-lg-5 text-right">
                                <form action="{{url('/form_pdf')}}" method="post" target="_blank">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{auth()->user()->id}}">
                                    <button type="submit" class="btn btn-md login-submit-cs text-white" style="background: #881f1f"><i class="fas fa-file-pdf fa-lg"></i> <b class="h5">Formulario de Inscripción</b></button>
                                </form>
                                {{--<a href="form_pdf" target="_blank" class="btn btn-md login-submit-cs text-white" style="background: #881f1f">Formulario de Inscipción</a>--}}
                            </div>
                        </div>
                        @if(!empty(auth()->user()->student[0]->status == 'Solicitado') || !empty(auth()->user()->student[0]->status == 'Revision'))
                            @include('pre-inscription')
                        @endif
                    @else
                        @include('pre-inscription')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
