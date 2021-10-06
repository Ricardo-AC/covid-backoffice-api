@extends('master.main')

@section('content')

    <div class="text-center mt-5 ">
        <a href="/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Flag_of_Europe.svg/640px-Flag_of_Europe.svg.png" style="height: 80px;width: 120px"></a>
        <span style="font-size: xx-large">COVID-19 CORONAVIRUS PANDEMIC REPORT</span>
    </div>

    <div class="text-center ">
        Last time updated: {{$dateUpdate}}
    </div>

    <div class="container">
        <div class="">
        @component('components.chart',['array'=>$casesByDateEurope,'title'=>"Europe",'type'=>'bar'])
        @endcomponent
        </div>
        <div class="mt-5">
        @component('components.table',['countries'=>$countries,'day'=>$dateUpdate])
        @endcomponent
        </div>
    </div>

@endsection
