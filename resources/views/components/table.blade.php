<table class="table table-bordered table-dark">
    <thead>
    <tr>
        <th scope="col">Country</th>
        <th scope="col">Cases</th>
        <th scope="col">Deaths</th>
        <th scope="col">Recovered</th>
    </tr>
    </thead>
    <tbody>
    @foreach($countries as $country)
        <tr onclick="location.href='/country/{{$country->id}}'" class="grow">
            <td class="py-auto">
                <img src="{{$country->flag_url}}" style="height: 30px;width: 45px" class="me-5">
                {{$country->name}}
            </td>
            <td class="py-auto">{{$country->cases}}</td>
            <td class="py-auto">{{$country->deaths}}</td>
            @if($country->recovered!=0)
                <td class="py-auto">{{$country->recovered}}</td>
            @else
                <td class="py-auto">not available</td>
            @endif
            @if(isset(Auth::user()->id))
                <td class="py-auto" style="width: 50px">
                    <form method="GET" action="/country/{{$country->id}}/edit">
                        <input type="hidden" name="date" value="{{$day}}">
                        <button type="submit" class="btn btn-danger mx-1" >Edit</button>
                    </form>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
