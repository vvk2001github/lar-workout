@extends('layouts.layout', ['title' => Lang::get('wmessages.Title')])

@section('content')
    <div class="container mt-2">
        <div class="row">
            <form action="{{ route('workout.update', ['workout' => $workout->w_id]) }}" method="post">
                @csrf
                @method('PATCH')
                <h3>{{ __('wmessages.EditWorkout') }}</h3>
                @include('workout.parts.form')
                <input type="submit" value="{{__('wmessages.EditWorkout')}}" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
@endsection

@push('head-script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <script src="{{ asset('js/workout/form.js') }}" ></script>
@endpush
