@extends('layout.secure')
@section('page_title')
    Edit User
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
        <h3 class="page-title"> Edit User </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/menageUsers">Menage User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>

            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form class="forms-sample" action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" name="user_first_name"id="user_first_name" class="form-control" value="{{ old('user_first_name', $user->first_name) }}" placeholder="First Name">
                @if ($errors->has('user_first_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_first_name') }}</div>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" name="user_last_name"  id="user_last_name" class="form-control" value="{{ old('user_last_name',$user->last_name) }}" placeholder="Last Name">
                @if ($errors->has('user_last_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_last_name') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email address</label>
                <input type="email"  name="user_email" id="user_email" class="form-control"  value="{{ old('user_email',$user->email) }}" placeholder="Email" required>
                @if ($errors->has('user_email'))
                    <div class="alert alert-danger">{{ $errors->first('user_email') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="Phone">Phone</label>
                <input type="text" name="user_phone"  id="user_phone" class="form-control" value="{{ old('user_phone',$user->phone) }}"  placeholder="Phone">
                @if ($errors->has('user_phone'))
                    <div class="alert alert-danger">{{ $errors->first('user_phone') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="Adress">Adress</label>
                <input type="text" name="user_adress"   id="user_adress"  class="form-control"  value="{{ old('user_adress',$user->adress) }}" placeholder="Adress">
                @if ($errors->has('user_adress'))
                    <div class="alert alert-danger">{{ $errors->first('user_adress') }}</div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        <button type="button" class="btn btn-light" onclick="confirmCancel()">Cancel</button>
    </form>
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
