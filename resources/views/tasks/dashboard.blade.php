@extends('layouts.main')

@section('title', 'Tasks')

@section('content')


    <div class="container animate-fade-in">
        <div class="row"
            <div class="col-lg-7 mx-auto">
                <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
                    <div>
                        <h1 class="h3 fw-bold mb-1">Tasks</h1>
                        <p class="text-muted small mb-0" id="taskCounter">
                            @if($pending > 0)
                                {{$pending}} Pending tasks
                            @else 
                                There is't pending tasks
                            @endif
                        </p>
                    </div>
                    <form method="get" action="/">
                        <select name="filter" class="form-select-minimal" onchange="this.form.submit()">
                            <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
                            <option value="0" {{ request('filter') == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </div>

                <div id="taskList" class="task-list-container">
                    @if(count($tasks) >=1)
                    <!-- Tasks injected here -->
                       @foreach ($tasks as $task)
                            <div class="task-item d-flex align-items-start gap-3">
                                <form action="/task/complete/{{$task -> id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="pt-1">
                                        <button class="form-check-input"  name="completed" style="width: 1.25rem; height: 1.25rem; cursor: pointer; border-radius: 0.25rem;"></button>
                                    </div>
                                </form>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1" style="font-size: 1rem; font-weight: 500;">
                                                @if($task->completed)
                                                    <s>{{$task -> title}}</s>
                                                @else
                                                    {{$task -> title}}
                                                @endif
                                            </h5>
                                            <div class="d-flex gap-2 align-items-center">
                                                @if($task->completed)
                                                    <span class="badge text-bg-success">Completed</span>
                                                @else    
                                                    @switch($task->priority)
                                                        @case (1)
                                                            <span class="status-badge badge-low">Low</span>
                                                        @break
                                                        @case (2)
                                                            <span class="status-badge badge-medium">Medium</span>
                                                        @break
                                                        @case (3)
                                                            <span class="status-badge badge-high">High</span>
                                                        @break
                                                    @endswitch
                                                @endif
                                                <span class="text-muted" style="font-size: 0.75rem;">• {{$task -> deadline -> format('d/m/Y')}}</span>
                                            </div>
                                            <p class="text-muted small mt-2 mb-0">{{$task -> description}}</p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <!--button edit-->
                                            <a href="/task/edit/{{$task -> id}}" class="btn btn-sm text-muted"><i class="bi bi-pencil"></i></a>
                                            <!--Button trash-->
                                            <form action="/task/{{$task -> id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm text-muted"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="text-center py-5">
                        <p class="text-muted">All clear here.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection('content')

