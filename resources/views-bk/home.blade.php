@extends('layouts.app')

@section('title') Drug  @stop

@section('content') 
    <div class="row" style="background-color: #fff;">
        <div class="col-md-6 mt-2"><canvas id="diac"></canvas></div>
        <div class="col-md-6 mt-2"><canvas id="drc"></canvas></div>
        <div class="col-md-6 mt-2"><canvas id="drc-local"></canvas></div>
        <div class="col-md-6 mt-2"><canvas id="dlmc"></canvas></div>
        <div class="col-md-6 mt-2"><canvas id="onetime"></canvas></div>
    </div>
@endsection

@section('js')
 @parent
<script src="{{ asset('js/chart.js') }}"></script>
<script>

    function displayChartById(holderId, title, labels, data){

        var data = {
        labels: labels,
        datasets: [{
            label: title,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: data,
        }]
    }; 

    var config = {type: 'bar', data: data, options: {scales: {
        yAxes: [{
            ticks: { 
                count: 1
            }
        }]
    }}};

        var myChart = new Chart(document.getElementById(holderId), config);
    }

    displayChartById('diac', "{{ $diacs['title'] }}", @json($diacs['labels']), @json($diacs['data']));
    displayChartById('drc', "{{ $drcs['title'] }}", @json($drcs['labels']), @json($drcs['data']));
    displayChartById('drc-local', "{{ $drc_locals['title'] }}", @json($drcs['labels']), @json($drcs['data']));
    displayChartById('dlmc', "{{ $dlmcs['title'] }}", @json($dlmcs['labels']), @json($dlmcs['data']));
    displayChartById('onetime', "{{ $onetimes['title'] }}", @json($onetimes['labels']), @json($onetimes['data']));

</script>
@endsection