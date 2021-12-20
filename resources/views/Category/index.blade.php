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
                                <h4> List of Categories </h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active "> List of Categories </li>
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
                                        <h2>Categories list</h2>
                                        <a href="{{ route('category.create') }}" class="btn btn-success">Add Category</a>
                                    </div>

                                    @if ($total_category != 0)
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between  py-3">
                                                <div>
                                                    <h5> Total task:&nbsp;{{ $total_category }}</h5>
                                                </div>
                                            </div>
                                            <table class="table text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Category Name</th>
                                                        <th>Created By</th>
                                                        <th>status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($categories as $category)
                                                        <tr class="">
                                                            <td>{{ $loop->index + 1 }} </td>
                                                            <td>{{ ucfirst($category->category_name) }}</td>
                                                            <td> {{ App\Models\User::find($category->created_by)->name }}
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-{{ $category->status == 0 ? 'secondary' : 'success' }}">{{ $category->status == 0 ? 'Deactive' : 'Active' }}</span>
                                                            </td>
                                                            <td class="d-flex justify-content-center">
                                                                <div class="mx-2">
                                                                    <form
                                                                        action="{{ route('category.status', $category->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-{{ $category->status == 0 ? 'success' : 'warning' }}">{{ $category->status == 0 ? 'Active' : 'Deactive' }}</button>
                                                                    </form>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                                        class="btn btn-primary">Edit </a>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <form
                                                                        action="{{ route('category.destroy', $category->id) }}"
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
