@extends('layout.secure')
@section('page_title')
    Add User
@endsection
@if (Session::has('msg'))
<div class="alert alert-success">
    <ul>
        <li>{!! Session::get('msg') !!}</li>
    </ul>
</div>
@endif
@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> {{__('users.Add_user')}} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home"> {{__('users.Home')}} </a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}"> {{__('users.Manage_Users')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{__('users.Add_user')}} </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form class="forms-sample" action="{{ route('users.store') }}" method="POST" >
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="user_first_name"> {{__('users.FirstName')}} </label>
                <input type="text" name="user_first_name" id="user_first_name" class="form-control" value="{{ old('user_first_name') }}" placeholder=" {{__("users.EnterFirstName")}} " />
                @if ($errors->has('user_first_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_first_name') }}</div>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="lastName">{{__('users.LastName')}}</label>
                <input type="text"  name="user_last_name" id="user_last_name"  class="form-control"  value="{{ old('user_last_name') }}" placeholder=" {{__('users.EnterLastName')}} ">
                @if ($errors->has('user_last_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_last_name') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="email"> {{__('users.Email')}} </label>
                <input type="email" name="user_email"  id="user_email" class="form-control" value="{{ old('user_email') }}" placeholder=" {{__('users.EnterEmail')}} "/>
                @if ($errors->has('user_email'))
                    <div class="alert alert-danger">{{ $errors->first('user_email') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="password"> {{__('users.Password')}} </label>
                <input type="password"  name="user_password" id="password" class="form-control"   value="{{ old('user_password') }}" placeholder=" {{__('users.EnterPassword')}} "/>
                @if ($errors->has('user_password'))
                    <div class="alert alert-danger">{{ $errors->first('user_password') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="Phone"> {{__('users.Phone')}} </label>
                <input type="text" name="user_phone" id="user_phone"  class="form-control" value="{{ old('user_phone') }}" placeholder=" {{__('users.EnterPhone')}} ">
                @if ($errors->has('user_phone'))
                    <div class="alert alert-danger">{{ $errors->first('user_phone') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="Adress"> {{__('users.Adress')}} </label>
                <input type="text" name="user_adress" id="user_adress"  class="form-control"  value="{{ old('user_adress') }}" placeholder=" {{__('users.EnterAdress')}} ">
                @if ($errors->has('user_adress'))
                    <div class="alert alert-danger">{{ $errors->first('user_adress') }}</div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-gradient-primary me-2"> {{__('users.Submit')}} </button>
        <button type="button" class="btn btn-light" onclick="confirmCancel()"> {{__('users.Cancel')}} </button>

    </form>
    </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        function confirmCancel() {
                window.location.href = '{{ route('users.index') }}';
        }
        document.addEventListener('DOMContentLoaded', function () {
            var cancelButton = document.querySelector('.btn-light');
            cancelButton.addEventListener('click', function (event) {
                event.preventDefault();
                confirmCancel();
            });
        });
    </script>
@endsection

