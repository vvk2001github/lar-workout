@extends('layouts.layout', ['title' => Lang::get('wmessages.Title')])

@section('content')
    <div class="container mt-2">
        <div class="row">
            <form action="{{ route('workout.store') }}" method="post">
                @csrf
                <h3>{{ __('wmessages.AddWorkout') }}</h3>
                @include('workout.parts.form')
                <input type="submit" value="{{ __('wmessages.AddWorkout') }}" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
@endsection

@push('head-script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <script src="{{ asset('js/workout/form.js') }}" ></script>
@endpush


