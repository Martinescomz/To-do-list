@extends('layouts.main')

@section('title', 'Tasks')

@section('content')

<nav class="navbar nav-minimal mb-5">
        <div class="container py-3">
            <a class="navbar-brand fw-bold text-dark fs-4" href="/">TaskMaster</a>
            <a href="/task/create" class="btn btn-minimal">
                Nova Tarefa
            </a>
        </div>
    </nav>
@if(session('msg'))
    <div class="alert alert-success" role="alert">
        {{session('msg')}}
    </div>
@endif

    <div class="container animate-fade-in">
        <div class="row"
            <div class="col-lg-7 mx-auto">
                <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
                    <div>
                        <h1 class="h3 fw-bold mb-1">Tarefas</h1>
                        <p class="text-muted small mb-0" id="taskCounter">
                            @if($pending > 0)
                                {{$pending}} tarefas pendentes
                            @else 
                                nenhuma tarefa perndente
                            @endif
                        </p>
                    </div>
                    <form method="get" action="/">
                        <select name="filter" class="form-select-minimal" onchange="this.form.submit()">
                            <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Todas</option>
                            <option value="0" {{ request('filter') == '0' ? 'selected' : '' }}>Pendentes</option>
                            <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Concluídas</option>
                        </select>
                    </form>
                </div>

                <div id="taskList" class="task-list-container">
                    @if(count($tasks) >=1)
                    <!-- Tasks injected here -->
                       @foreach ($tasks as $task) 
                        <div class="task-item d-flex align-items-start gap-3">
                            <div class="pt-1">
                                <input class="form-check-input" type="checkbox" style="width: 1.25rem; height: 1.25rem; cursor: pointer; border-radius: 0.25rem;">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1" style="font-size: 1rem; font-weight: 500;">{{$task -> title}}</h5>
                                        <div class="d-flex gap-2 align-items-center">
                                            @switch($task->priority)
                                                @case ($task->priority == 1)
                                                    <span class="status-badge badge-low">low</span>
                                                @break
                                                @case ($task->priority == 2)
                                                    <span class="status-badge badge-medium">medium</span>
                                                @break
                                                @case ($task->priority == 3)
                                                    <span class="status-badge badge-high">high</span>
                                                @break
                                            @endswitch
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
                        <p class="text-muted">Tudo limpo por aqui.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection('content')

