@extends('layouts.app')

@section('content')
<div class="container">
    <h1>To-Do List</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Task Title" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Task Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

    <h2 class="mt-5">Tasks to Do</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Mark as Done</button>
                    </form>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }}

    <h2 class="mt-5">Completed Tasks</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($completedTasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-warning">Move to Not Done</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $completedTasks->links() }}
</div>
@endsection
