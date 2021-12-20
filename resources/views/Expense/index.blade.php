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
                                <h4> Expances </h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active ">Expances </li>
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
                                        <h2>List of your Expances</h2>
                                        <a href="{{ route('expense.create') }}" class="btn btn-success">Add Expance</a>
                                    </div>
                                    @if ($noOfExpense != 0)
                                        <div class="mt-3 row">
                                            <div class="col-10 d-flex justify-content-between  py-3">
                                                <div>
                                                    <h5>Total Expanse: &nbsp ৳ {{ $total_spend_amount }} </h5>
                                                </div>

                                                <div class="sorting">
                                                    <form id="filter" method="post">
                                                        @csrf
                                                        <select class="form-select select" onchange="sortByCategory()"
                                                            id="cat_id" name="exp_cat_id"
                                                            aria-label="Default select example">
                                                            <option value="">
                                                                All
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </form>
                                                </div>
                                            </div>
                                            <table class="table text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Purpose</th>
                                                        <th>Receipt</th>
                                                        <th>Amount</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($expenses as $expense)
                                                        <tr class="">
                                                            <td>{{ $loop->index + 1 }} </td>
                                                            <td>{{ ucfirst($expense->purpose) }}</td>

                                                            <td>
                                                                @if ($expense->receipt)
                                                                    <img src="{{ asset("assets/uploads/receipt/$expense->receipt") }}"
                                                                        height="40" alt="">
                                                                @else
                                                                    N/A
                                                                @endif

                                                            </td>
                                                            <td>
                                                                ৳ {{ $expense->spend_amount }}
                                                            </td>
                                                            <td class="d-flex justify-content-center">

                                                                <div class="mx-2">
                                                                    <a href="{{ route('expense.edit', $expense->id) }}"
                                                                        class="btn btn-primary">Edit </a>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <form
                                                                        action="{{ route('expense.destroy', $expense->id) }}"
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
@section('script')
    <script>
        // $.ajaxSetup({
        //     header: {
        //         'X-CSRF-TOKEN': $('meta [name="csrf-token"]').attr('content')
        //     }
        // });

        function sortByCategory() {
            $.ajax({
                url: '{{ route('expense.cat_sort') }}',
                type: "post",
                data: $('#filter').serialize(),
                success: function(results) {
                    location.reload();
                    console.log(results);
                }
            })
        }

        // $('#filter').submit((e) => {
        //     e.preventDefault();
        //     $.ajax({
        //         url: '{{ route('expense.cat_sort') }}',
        //         type: "post",
        //         data: $('#filter').serialize(),
        //         success: function(results) {
        //             location.reload();
        //             console.log(results);
        //         }
        //     })
        // })
    </script>

@endsection
