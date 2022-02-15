@extends('layouts.layout', ['title' => 'Главная страница'])
@section('content')

<div class="container-fluid">
<div class="chart-container" style="position: relative; height:40vh; width:80vw">
    <canvas id="myChart"></canvas>
</div>
</div>
@endsection

@push('head-script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" ></script>
@endpush

@push('foot-script')
<script>
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    $(document).ready(function(){
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    });
</script>
@endpush
