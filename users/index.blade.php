@extends('layout.secure')
@section('page_title') Menage Users @endsection
@section('table_header')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('msg') !!}</li>
            </ul>
        </div>
    @endif
    <div class="page-header mt-3">
        <h3 class="page-title"> @lang('users.Manage_Users') </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home"> {{__('users.Home')}}</a></li>
                <li class="breadcrumb-item"> {{__('users.Manage_Users')}} </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="head pb-2">
        <h4 class="card-title">@lang('users.Manage_Users_List')</h4>
        <a class="btn btn-card  btn-lg btn-gradient-primary mt-4" href="{{ route('users.create') }}">+{{__('users.Add_user')}} </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> {{__('users.Name')}} </th>
                <th> {{__('users.Email')}} </th>
                <th> {{__('users.Phone')}} </th>
                <th> {{__('users.Adress')}} </th>
                <th> {{__('users.Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users) && count($users) > 0)
            @foreach ($users as $key => $user)
                <tr>
                    <td> {{ ++$key }} </td>
                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> {{ $user->phone }} </td>
                    <td> {{ $user->adress }} </td>
                    <td>
                        @if (Auth::id() == $user->created_by)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"> {{__('users.Edit')}} <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('users.destroy', $user->id)}}"
                               onclick="return confirm('Are you sure to delete this record?');"
                               class="btn btn-danger btn-sm">{{__('users.Delete')}} <i class="fa-solid fa-trash"></i></a>
                        @endif
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
