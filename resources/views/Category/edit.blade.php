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
                                <h4>Edit Category</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item  "><a href="{{ route('category.index') }}">categories
                                            List</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Category</li>
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
                                        <h2>Update your category</h2>
                                        <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
                                    </div>
                                    <div class="form py-3">
                                        <form action="{{ route('category.update', $category_details->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-firstname-input">Category Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $category_details->category_name }}"
                                                            name="category_name" placeholder="Enter your category">
                                                        @error('category_name')
                                                            <small class="text-danger"> {{ $message }}</small>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">Update</button>
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
