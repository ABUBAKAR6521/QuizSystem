@extends('layout.secure')
@section('page_title')
    Menage Catagories
@endsection

@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> Menage Catagories </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menage Catagories</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="head pb-2">
        <h4 class="card-title">Menage Catagorie's List</h4>
        <a class="btn btn-card  btn-lg btn-gradient-primary mt-4" href="{{ route('categories.create') }}">+ Add Catagory</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th>Name </th>
                <th> Status </th>
                <th> Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($catagories) &&  count($catagories) > 0 )
            @foreach ($catagories as $key => $catagory)
                <tr>
                    <td> {{ ++$key }} </td>
                    <td> {{ $catagory->catagory_name }} </td>
                    <td>
                        {{ $catagory->catagory_status == '1' ? 'Active' : 'InActive' }}
                    </td>

                    <td>
                        <a href="{{ route('categories.edit', $catagory->id) }}" class="btn btn-warning btn-sm">Edit <i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ route('categories.destroy', $catagory->id) }}"
                            onclick="return confirm('Are you sure to delete this record?');"
                            class="btn btn-danger btn-sm">Delete <i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" align="center">No records found!</td>
            </tr>
            @endif

        </tbody>
    </table>
@endsection
