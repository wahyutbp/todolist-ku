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

                
            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Detail</a>
                


                    
                    
                    <!-- Tombol Edit -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus task ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>


                    <!-- Tombol Pindahkan ke Sudah Dikerjakan -->
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin sudah menyelesaikan task ini?')">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Mark as Done</button>
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
                    <!-- Tombol Pindahkan ke Belum Dikerjakan -->

                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Detail</a>
                    
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin memindahkan task ini ke belum dikerjakan?')">
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
