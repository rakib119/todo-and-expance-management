@extends('layouts.layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Add Expance</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item  "><a href="{{ route('expense.index') }}">Expances</a>
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
                                        <h2>Add Expance</h2>
                                        <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
                                    </div>
                                    <div class="container form py-3 ">
                                        <form action="{{ route('expense.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Category<span
                                                                class="text-danger">*</span> </label>
                                                        <select class="form-select select" name="exp_cat_id"
                                                            aria-label="Default select example">
                                                            <option value="">
                                                                <--choose one-->
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('exp_cat_id')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Purpose
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('purpose') }}" name="purpose">
                                                        @error('purpose')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Amount<span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" name="spend_amount" id="spend_amount"
                                                            value="{{ old('spend_amount') }}" class="form-control">
                                                        @error('spend_amount')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Receipt </label>
                                                        <input type="file" name="receipt" accept=".jpg,.png,.JPG,.PNG"
                                                            id="receipt" value="{{ old('receipt') }}"
                                                            class="form-control">
                                                        @error('receipt')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Time</label>
                                                        <input type="datetime-local" name="created_at" id="created_at"
                                                            value="{{ old('created_at') }}" class="form-control">
                                                        @error('created_at')
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
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
@endsection
