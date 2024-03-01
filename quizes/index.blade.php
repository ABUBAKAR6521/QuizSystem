@extends('layout.secure')
@section('page_title')
    Menage Quiz
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
        <h3 class="page-title"> Menage Quiz </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item">Menage Quiz</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="head pb-2">
        <h4 class="card-title">Menage Quiz's List</h4>
        <a class="btn btn-card  btn-lg btn-gradient-primary mt-4" href="{{ route('quizes.create') }}">+ Add a Quiz</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Catagory </th>
                <th> Title </th>
                <th> Duration </th>
                <th> Allowed Questions </th>
                <th> Status </th>
                <th> Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($Quizez) && count($Quizez) > 0 )
            @foreach ($Quizez as $key => $Quiz)
            <tr>
                <td> {{ ++$key }} </td>
                <td> {{ $Quiz->category->catagory_name }} </td>
                <td> {{ $Quiz->title }} </td>
                <td> {{ $Quiz->duration }}</td>
                <td> {{ $Quiz->no_questions }}</td>
                <td> {{ $Quiz->status == '1' ? 'Active' : 'InActive' }} </td>
                <td>
                    <a href="{{ route('quizes.edit', $Quiz->id) }}"class="btn btn-warning btn-sm">Edit <i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('quizes.destroy', $Quiz->id) }}"onclick="return confirm('Are you sure to delete this record?');"
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
