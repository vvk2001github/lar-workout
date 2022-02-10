@extends('layouts.layout', ['title' => Lang::get('exmessages.Exercises')])
@section('content')
    <div class="container mt-2">
        <div class="row">
            <form action="{{ route('exercise.update', ['exercise' => $exercise->ex_id]) }}" method="post">
                @csrf
                @method('PATCH')
                <h3>Изменить упражнение</h3>
                @include('exercise.parts.form')
                <input type="submit" value="Изменить упражнение" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
@endsection
