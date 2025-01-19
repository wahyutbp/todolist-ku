@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $task->title }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description ?? 'No description available.' }}</p>
            <p><strong>Status:</strong> {{ $task->is_completed ? 'Completed' : 'Not Completed' }}</p>
        </div>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
