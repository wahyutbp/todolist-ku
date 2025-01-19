@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Task Details</h1>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $task->title }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description ?? 'No description available.' }}</p>
            <p>
                <strong>Status:</strong> 
                @if($task->status == 1)
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-danger">Not Completed</span>
                @endif
            </p>
            <p><strong>Created At:</strong> {{ $task->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Last Updated:</strong> {{ $task->updated_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
