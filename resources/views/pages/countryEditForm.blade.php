@extends('master.main')
@section('content')
    <div class="text-center mt-5">
        <h3>{{$country["name"]}}</h3>
        <h5>{{$date}}</h5>
    </div>
    <div class="container" style="max-width: 500px" >
        <form class="mt-5" method="POST" action="{{ url('country/' . $country->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cases">Cases</label>
                <input type="number" class="form-control" name="cases" value="{{$countryData[$date]['cases']}}">
            </div>
            <div class="form-group">
                <label for="deaths">Deaths</label>
                <input type="number" class="form-control" name="deaths" value="{{$countryData[$date]['deaths']}}">
            </div>
            <div class="form-group">
                <label for="recovered">Recovered</label>
                <input type="number" class="form-control" name="recovered" value="{{$countryData[$date]['recovered']}}">
            </div>
            <input name="date" type="hidden" value="{{$date}}">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <form method="GET" class="mt-5 form-group wrapper">
            <input name="date" type="date" class="form-control left"  min="2020-01-22" max="{{$dateUpdate}}"  >
            <button type="submit" class="btn btn-primary mx-1">Change date</button>
        </form>
    </div>
@endsection
