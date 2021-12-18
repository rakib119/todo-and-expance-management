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
                                <h4>Add Task</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item  "><a href="{{ route('expance.index') }}">Expances</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Expance</li>
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
                                    <div class="d-flex justify-content-between">
                                        <h2>Add Task</h2>
                                        <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
                                    </div>
                                    <div class="form py-3">
                                        <form action="{{ route('expance.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Expance Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" name="task_name"
                                                            placeholder="Enter your task">
                                                        @error('task_name')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Time
                                                            <span class="text-danger">*</span></label>
                                                        <input type="datetime-local" name="task_time" id="task_time"
                                                            value="" class="form-control">
                                                        @error('task_time')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">Submit </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
