@extends('layouts.main')

@section('title', 'Edit {{$task -> title}}')

@section('content')

    <div class="container mt-5 animate-fade-in">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="minimal-card shadow-sm">
                    <h2 class="h4 fw-bold mb-4">Editing task</h2>
                    <form id="taskForm"  action="/task/{{$task -> id}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="idTask" value="{{$task -> id}}">
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-medium">TITLE</label>
                            <input type="text" id="taskTitle" name="title" class="form-control form-control-minimal"
                                value="{{$task -> title}}" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-medium">DESCRIPTION</label>
                            <textarea id="taskDesc" name="description" class="form-control form-control-minimal" rows="3">{{$task -> description}}</textarea>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-medium">PRIORITY</label>
                                <select id="taskPriority" name="priority" class="form-select form-control-minimal">
                                    @switch($task->priority)
                                        @case (1)
                                            <option value="1" selected>Low</option>
                                            <option value="2">Medium</option>
                                            <option value="3">high</option>
                                        @break
                                        @case (2)
                                            <option value="1">Low</option>
                                            <option value="2" selected>Medium</option>
                                            <option value="3">high</option>
                                        @break
                                        @case (3)
                                            <option value="1">Low</option>
                                            <option value="2">Medium</option>
                                            <option value="3" selected>High</option>
                                        @break
                                    @endswitch
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted small fw-medium">DEADLINE</label>
                                <input type="date" id="taskDeadline" name="deadline" class="form-control form-control-minimal" value="{{$task -> deadline -> format('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-minimal flex-grow-1">Update task</button>
                            <a href="/" class="btn btn-outline-minimal">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="app.js{{ asset('js/app.js') }}"></script>
    <script>
        document.getElementById('taskForm').addEventListener('submit', async function (e) {
            //e.preventDefault();
            const task = {
                title: document.getElementById('taskTitle').value,
                desc: document.getElementById('taskDesc').value,
                priority: document.getElementById('taskPriority').value,
                deadline: document.getElementById('taskDeadline').value,
                completed: false,
                createdAt: new Date().toISOString()
            };
            await addTask(task);
            window.location.href = 'index.html';
        });
    </script>

@endsection('content')