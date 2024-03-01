@extends('layout.secure')
@section('page_title')
    Menage Questions
@endsection
@section('table_header')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('msg') !!}</li>
            </ul>
        </div>
    @endif
    <div class="page-header mt-3">
        <h3 class="page-title"> Menage Questions </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menage Questions</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="head pb-2">
        <h4 class="card-title">Menage Question's List</h4>
        <a class="btn btn-card  btn-lg btn-gradient-primary mt-4" href="{{ route('questions.create') }}">+ Add Questions</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th>Catagory</th>
                <th>Quiz</th>
                <th>Title</th>
                <th>Allowed Awnsers</th>
                <th>Status </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($Questions) && count($Questions) > 0 )
            @foreach ($Questions as $key => $Question)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $Question->catagory->catagory_name }}</td>
                <td>{{ $Question->quizes->title }}</td>
                <td>{{ $Question->question_title }}</td>
                <td>{{ $Question->no_awnsers }}</td>
                <td>{{ $Question->question_status == '1' ? 'Active' : 'InActive' }}</td>
                <td>
                    <a href="{{ route('questions.edit', $Question->id) }}"class="btn btn-warning btn-sm">Edit <i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('questions.destroy', $Question->id) }}"onclick="return confirm('Are you sure to delete this record?');"
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
