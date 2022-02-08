@extends('layouts.layout', ['title' => 'Exercises'])
@section('content')

    <div class="container">
        <div class="row mt-2">
            <div class="col-11"></div>
            <div class="col-1"><a class="btn btn-success" href="{{ route('exercise.create') }}" role="button"><i class="bi bi-plus-square"></i></a></div>
        </div>
        <div class="row">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th scope="col" style="display: none;">#</th>
                    <th scope="col" class="col-8">{{__('exmessages.Exercises')}}</th>
                    <th scope="col" class="col-3">{{__('exmessages.Type')}}</th>
                    <th scope="col" class="col-1">{{__('exmessages.Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exercises as $exercise)
                    <tr class="align-middle">
                        <td style="display: none;">{{ $exercise->ex_id }}</td>
                        <td>{{ $exercise->ex_descr }}</td>
                        <td>{{ $exercise->ex_type }}</td>
                        <td>
                            <a class="btn btn-primary" href="#" role="button"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="#" role="button"><i class="bi bi-x-square"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
