@php
    $titleTrimSpace=str_replace(' ', '', $title);

@endphp
<canvas id="{{$titleTrimSpace}}">11</canvas>

<script>
    var ctx{{$titleTrimSpace}} = document.getElementById('{{$titleTrimSpace}}');

    const labels{{$titleTrimSpace}} = [
        @foreach($array as $x => $y)
            '{{$x}}',
        @endforeach
    ];

    const data{{$titleTrimSpace}} = {
        labels: labels{{$titleTrimSpace}},
        datasets: [{
            label: "{{$title}}",
            data: [
                @foreach($array as $x => $y)
                    '{{$y}}',
                @endforeach
            ],
            fill: true,
            @if($type=='line')
            borderColor: 'rgb(0,0,0)',
            @endif
            backgroundColor: 'rgb(0,51,153)',
            borderWidth: 2,
            stepped: false,
            pointRadius:0
        }]
    };

    var {{$titleTrimSpace}} = new Chart(ctx{{$titleTrimSpace}}, {
        type: '{{$type}}',
        data: data{{$titleTrimSpace}}
    });

</script>
