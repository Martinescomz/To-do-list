@extends('layouts.main')

@section('title', 'Edit Task')

@section('content')
    <div class="container mt-5 animate-fade-in">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="minimal-card shadow-sm">
                                <h2 class="h4 fw-bold mb-4">Editar Tarefa</h2>
                                <form id="editForm">
                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-medium">TITULO</label>
                                        <input type="text" id="taskTitle" class="form-control form-control-minimal" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-medium">DESCRIÇÃO</label>
                                        <textarea id="taskDesc" class="form-control form-control-minimal" rows="3"></textarea>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <label class="form-label text-muted small fw-medium">PRIORIDADE</label>
                                            <select id="taskPriority" class="form-select form-control-minimal">
                                                <option value="low">Baixa</option>
                                                <option value="medium">Média</option>
                                                <option value="high">Alta</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-muted small fw-medium">PRAZO</label>
                                            <input type="date" id="taskDeadline" class="form-control form-control-minimal">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 pt-2">
                                        <button type="submit" class="btn btn-minimal flex-grow-1">Salvar</button>
                                        <a href="index.html" class="btn btn-outline-minimal">Voltar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
                    const urlParams = new URLSearchParams(window.location.search);
                    const taskId = urlParams.get('id');
                    let currentTask = null;

                    window.onload = async function() {
                        const tasks = await getTasks();
                        currentTask = tasks.find(t => t.id == taskId);
                        
                        if (currentTask) {
                            document.getElementById('taskTitle').value = currentTask.title;
                            document.getElementById('taskDesc').value = currentTask.desc;
                            document.getElementById('taskPriority').value = currentTask.priority;
                            document.getElementById('taskDeadline').value = currentTask.deadline || '';
                        } else {
                            window.location.href = 'index.html';
                        }
                    };

                    document.getElementById('editForm').addEventListener('submit', async function(e) {
                        e.preventDefault();
                        const updatedTask = {
                            ...currentTask,
                            title: document.getElementById('taskTitle').value,
                            desc: document.getElementById('taskDesc').value,
                            priority: document.getElementById('taskPriority').value,
                            deadline: document.getElementById('taskDeadline').value
                        };
                        await updateTask(updatedTask);
                        window.location.href = 'index.html';
                    });
    </script>
@endsection('content')