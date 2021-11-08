@php
    $formulario = App\Models\Student::where('user_id',auth()->user()->id)->get();
@endphp
<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!empty($formulario))
                        <b class="text-grey h2">Su solicitud está siendo procesada</b>
                        <i class="fas fa-check-circle fa-2x text-success ml-2"></i>
                    @else
                        @include('pre-inscription')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
