@extends('layout.secure')
@section('page_title')
    Edit Catagory
@endsection
@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> Edit Catagory </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Menage Catagories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Catagory</li>

            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form class="forms-sample" action="{{ route('categories.update', $catagory->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="catagory_name"  id="catagory_name" class="form-control"   value="{{ old('catagory_name',$catagory->catagory_name) }}" placeholder="Name"/>
        </div>
        <div class="form-group">
            <label for="status">Select Status</label>
            <select  name="catagory_status" id="catagory_status" class="form-control form-control-lg">
                    <option value="">Select Status</option>
                    <option value="1" {{ $catagory->catagory_status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $catagory->catagory_status == '0' ? 'selected' : '' }}>Inactive</option>

            </select>
            @if ($errors->has('catagory_status'))
                <div class="alert alert-danger">{{ $errors->first('catagory_status') }}</div>
            @endif
            <button type="submit" class="btn btn-gradient-primary me-2 mt-2">Submit</button>
            <button class="btn btn-light" onclick="confirmCancel()">Cancel</button>
    </form>
    </div>
    </div>
@endsection
@section('page_scripts')
<script>
    function confirmCancel() {
            window.location.href = '{{ route('categories.index') }}';
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
