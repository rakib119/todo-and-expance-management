@extends('layouts.layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Todo List</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active ">Todo List </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container-fluid">
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between py-3">
                                        <h2>Task List</h2>
                                        <a href="{{ route('todo.create') }}" class="btn btn-success">Add Task</a>
                                    </div>
                                    @if ($total_task != 0)
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between  py-3">
                                                <div>
                                                    <h5> Total task:&nbsp;{{ $total_task }}</h5>
                                                </div>
                                                <div>
                                                    <h5> Done:&nbsp; {{ $finished_item }}</h5>
                                                </div>
                                                <div>
                                                    <h5> Pending:&nbsp; {{ $pending_item }} </h5>
                                                </div>
                                                <div class="d-flex">
                                                    @if ($pending_item != 0)
                                                        <div class="mx-2">
                                                            <form method="post" action="{{ route('todo.markAllDone') }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">All
                                                                    Done</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                    @if ($finished_item != 0)

                                                        <div class="mx-2">
                                                            <form method="post"
                                                                action="{{ route('todo.markAllUndone') }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning">Undone
                                                                    All</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                    @if ($total_task != 0)
                                                        <div class="mx-2">
                                                            <form method="post" action="{{ route('todo.clear') }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Clear
                                                                    All</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <table class="table text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Task Name</th>
                                                        <th>Time</th>
                                                        <th>status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all_task as $task)
                                                        <tr class="">
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="task_id[]" value="{{ $task->id }}"
                                                                    id="taskId">
                                                                <label class="form-check-label" for="taskId">
                                                                    <p> &nbsp;{{ $loop->index + 1 }}</p>
                                                                </label>
                                                            </td>
                                                            <td>{{ ucfirst($task->task_name) }}</td>
                                                            <td>{{ $task->task_time }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-{{ $task->status == 0 ? 'secondary' : 'success' }}">{{ $task->status == 0 ? 'Pending' : 'Done' }}</span>
                                                            </td>
                                                            <td class="d-flex justify-content-center">
                                                                <div class="mx-2">
                                                                    <a href="{{ route('todo.status', Crypt::encrypt($task->id)) }}"
                                                                        class="btn btn-{{ $task->status == 0 ? 'success' : 'warning' }}">{{ $task->status == 0 ? 'Done' : 'Pending' }}</a>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <a href="{{ route('todo.edit', Crypt::encrypt($task->id)) }}"
                                                                        class="btn btn-primary">Edit </a>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <form action="{{ route('todo.destroy', $task->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <h2 class="text-center text-capitalize">information not available</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
