@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activity Logs</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Action</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->task->title }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
@endsection
