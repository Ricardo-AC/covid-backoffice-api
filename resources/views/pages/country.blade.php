@extends('master.main')

@section('content')
    <div class="text-center my-3 ">
        <a href="/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Flag_of_Europe.svg/640px-Flag_of_Europe.svg.png" style="height: 50px;width: 75px"></a>
        <img src="{{$country->flag_url}}" style="height: 50px;width: 75px">
        <span style="font-size:xx-large  ">{{$country->name}}</span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12  col-sm-12">
                @component('components.chart',['array'=>$dailyCases,'title'=>"Daily cases",'type'=>'bar'])
                @endcomponent
            </div>
            <div class="col-lg-6 col-sm-12">
                @component('components.chart',['array'=>$cases,'title'=>"Cases",'type'=>'line'])
                @endcomponent
            </div>
            <div class="col-lg-6  col-sm-12">
                @component('components.chart',['array'=>$deaths,'title'=>"Deaths",'type'=>'line'])
                @endcomponent
            </div>
            <div class="col-lg-6  col-sm-12">
                @component('components.chart',['array'=>$recovered,'title'=>"Recovered",'type'=>'line'])
                @endcomponent
            </div>
            <div class="col-lg-6  col-sm-12">
                @component('components.chart',['array'=>$dailyRecovered,'title'=>"Daily recovered",'type'=>'bar'])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
