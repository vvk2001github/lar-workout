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
            <tr>
                <td style="display: none;">1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td style="display: none;">1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
