@extends('layouts.layout', ['title' => Lang::get('wmessages.Title')])
@section('content')

    <div class="container">
        @can('create', \App\Models\Workout::class)
            <div class="row mt-2">
                <div class="col-11"></div>
                <div class="col-1"><a class="btn btn-success" href="{{ route('workout.create') }}" role="button"><i class="bi bi-plus-square"></i></a></div>
            </div>
        @endcan

            <div class="row">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th scope="col" style="display: none;">#</th>
                        <th scope="col" class="col-2">{{__('wmessages.Date')}}</th>
                        <th scope="col" class="col-2">{{__('wmessages.Exercise')}}</th>
                        <th scope="col" class="col-2">{{__('wmessages.CountOne')}}</th>
                        <th scope="col" class="col-2">{{__('wmessages.WeightOne')}}</th>
                        <th scope="col" class="col-2">{{__('wmessages.CountTwo')}}</th>
                        <th scope="col" class="col-2">{{__('wmessages.WeightTwo')}}</th>
                        <th scope="col" class="col-1">{{__('exmessages.Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workouts as $workout)
                        <tr class="align-middle">
                            <td style="display: none;">{{ $workout->w_id }}</td>
                            <td>{{ $workout->created_at }}</td>
                            <td>{{ $workout->exercise->ex_descr }}</td>
                            <td>{{ $workout->count1 }}</td>
                            <td>{{ $workout->weight1 }}</td>
                            <td>{{ $workout->count2 }}</td>
                            <td>{{ $workout->weight2 }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('workout.edit', ['workout' => $workout->w_id]) }}" role="button"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger" href="{{ route('workout.destroy', ['workout' => $workout->w_id]) }}" role="button"
                                   onclick="if(confirm('Точно удалить тренировку: {{ $workout->ex_descr }}')) {
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{ $workout->w_id }}').submit();
                                       } else {
                                       return false
                                       }">
                                    <i class="bi bi-x-square"></i>
                                </a>

                                <form style="display: none;" id="delete-form-{{ $workout->w_id }}" action="{{ route('workout.destroy', ['workout' => $workout->w_id]) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                {{ $workouts->links() }}
            </div>
    </div>
@endsection
