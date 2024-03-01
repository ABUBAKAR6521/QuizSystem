@extends('layout.secure')
@section('page_title')
    Menage Awnsers
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
        <h3 class="page-title"> Menage Awnsers </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item">Menage Awnsers</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="head pb-2">
        <h4 class="card-title">Menage Awnser's List</h4>
        <a class="btn btn-card  btn-lg btn-gradient-primary mt-4" href="{{ route('awnsers.create') }}">+ Add a Awnser</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Catagory </th>
                <th> Quiz </th>
                <th> Question </th>
                <th> Title </th>
                <th> Is Correct </th>
                <th> Status </th>
                <th> Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($awnsers) && count($awnsers) > 0 )
            @foreach ($awnsers as $key => $awnser)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $awnser->category->catagory_name }}</td>
                <td>{{ $awnser->quizes->title }}</td>
                <td>{{ $awnser->questions->question_title }}</td>
                <td>{{ $awnser->title }}</td>
                <td>{{ $awnser->is_correct == '1' ? 'Correct' : 'InCorrect' }}</td>
                <td>{{ $awnser->status == '1' ? 'Active' : 'InActive' }}</td>

                <td>
                    <a href="{{ route('awnsers.edit', $awnser->id) }}" class="btn btn-warning btn-sm">Edit <i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('awnsers.destroy', $awnser->id) }}"
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
