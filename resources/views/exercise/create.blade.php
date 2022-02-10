@extends('layouts.layout', ['title' => Lang::get('exmessages.Exercises')])
@section('content')
    <div class="container mt-2">
        <div class="row">
            <form action="{{ route('exercise.store') }}" method="post">
                @csrf
                <h3>Добавить упражнение</h3>
                @include('exercise.parts.form')
                <input type="submit" value="Добавить упражнение" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
@endsection
