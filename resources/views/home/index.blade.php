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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@push('foot-script')
<script>
    let chartData = {
        labels: [],
        datasets: [{
            label: 'Count',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [],
        }]
    };

    let chartConfig = {
        type: 'line',
        data: chartData,
        options: {}
    };

    let myCart;

    //START Load ex_id select
    function getAjaxExerciseByType() {
        var extype = $('#ex_type').val();

        return $.ajax({
            type:'POST',
            beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                request.setRequestHeader('_token', "{{ Session::token() }}");
                request.setRequestHeader('Accept', 'application/json');
            },
            url:"{{ route('api.exercise.list') }}",
            data:{ex_type:extype},
        });
    };

    //END Load ex_id select

    //Load chart data
    function getExerciseData() {
        let exid = $('#ex_id').val();

        return $.ajax({
            type:'POST',
            beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                request.setRequestHeader('_token', "{{ Session::token() }}");
                request.setRequestHeader('Accept', 'application/json');
            },
            url:"{{ route('api.exercise.data') }}",
            data:{ex_id:exid},
        });


    };


    $(document).ready(function(){
        myChart = new Chart(document.getElementById('myChart'), chartConfig);

        // Click on ex_type option 0
        $('#ex_type').val(0);
        $('#ex_type').trigger('change');
    });

    $('#ex_type').change(function () {

        $('#ex_id').empty();

        getAjaxExerciseByType().then(({data}) => {data.forEach(function(entry){
            $('#ex_id').append($('<option>', {
                value: entry.ex_id,
                text: entry.ex_descr
            }))}
        )});

    });

    $('#ex_id').change(function () {
        myChart.data.labels = [];
        myChart.data.datasets[0].data = []
        getExerciseData().then(
            (result) => {
                console.log(result);
                result.data.forEach(
                (entity) => {
                        myChart.data.labels.push(moment(entity.created_at).format('YYYY-MMMM-DD'));
                        myChart.data.datasets[0].data.push(entity.count1);
                    }
                );
                myChart.update();
            }
        );
    });
</script>

@endpush
