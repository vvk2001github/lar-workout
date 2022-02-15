@extends('layouts.layout', ['title' => 'Главная страница'])
@section('content')

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-2">
            <select id="ex_type" name="ex_type">
                <option value="0">Without Weight</option>
                <option value="1">Separated Without Weight</option>
                <option value="2">With Weight</option>
                <option value="3">Separated With Weight</option>
            </select>
        </div>
        <div class="col-2">
            <select id="ex_id" name="ex_id">

            </select>
        </div>
    </div>
    <div class="row">
        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('head-script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

    $('#ex_type').change(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                '_token' : "{{ Session::token() }}",
                'Accept': 'application/json'
            }
        });

        var ex_type = $(this).val();

        $.ajax({
            type:'POST',
            url:"{{ route('api.exercise.list') }}",
            data:{ex_type:ex_type},
            success:function(data){
                $('#ex_id').empty();
                data.data.forEach(function (entry){
                    $('#ex_id').append($('<option>', {
                        value: entry.ex_id,
                        text: entry.ex_descr
                    }));
                });
            }
        });
    });
</script>

@endpush
