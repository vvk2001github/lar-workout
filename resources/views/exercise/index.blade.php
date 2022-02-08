@extends('layouts.layout', ['title' => 'Exercises'])
@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" style="display: none;">#</th>
                <th scope="col">{{__('exmessages.Exercises')}}</th>
                <th scope="col">{{__('exmessages.Type')}}</th>
                <th scope="col">{{__('exmessages.Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($exercises as $exercise)
                <tr>
                    <td style="display: none;">{{ $exercise->ex_id }}</td>
                    <td>{{ $exercise->ex_descr }}</td>
                    <td>{{ $exercise->ex_type }}</td>
                    <td>@###</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
