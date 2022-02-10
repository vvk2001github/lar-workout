@extends('layouts.layout', ['title' => Lang::get('exmessages.Exercises')])
@section('content')

    <div class="container">
        @can('create', \App\Models\Exercise::class)
        <div class="row mt-2">
            <div class="col-11"></div>
            <div class="col-1"><a class="btn btn-success" href="{{ route('exercise.create') }}" role="button"><i class="bi bi-plus-square"></i></a></div>
        </div>
        @endcan
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
                        <td>{{ exTypeToString($exercise->ex_type) }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('exercise.edit', ['exercise' => $exercise->ex_id]) }}" role="button"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="{{ route('exercise.destroy', ['exercise' => $exercise->ex_id]) }}" role="button"
                               onclick="if(confirm('Точно удалить упражнение: {{ $exercise->ex_descr }}')) {
                                   event.preventDefault();
                                   document.getElementById('delete-form-{{ $exercise->ex_id }}').submit();
                               } else {
                                   return false
                               }">
                                <i class="bi bi-x-square"></i>
                            </a>

                            <form style="display: none;" id="delete-form-{{ $exercise->ex_id }}" action="{{ route('exercise.destroy', ['exercise' => $exercise->ex_id]) }}" method="post" >
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
            {{ $exercises->links() }}
        </div>
    </div>

@endsection
