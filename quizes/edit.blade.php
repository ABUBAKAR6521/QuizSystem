@extends('layout.secure')
@section('page_title') Add Quiz @endsection
@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> Edit Quiz </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('quizes.index') }}">Menage Quiz</a></li>
                <li class="breadcrumb-item">Edit Quiz</li>


            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form class="forms-sample" action="{{ route('quizes.update', $Quiz->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control form-control-lg">
                    <option value=""> Select Category </option>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"{{ old('category_id', $Quiz->catagory_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->catagory_name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('category_id'))
                    <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputName1">Quiz Title</label>
                <input type="text" name="quiz_title" id="quiz_title" class="form-control"  value="{{ old('quiz_title', $Quiz->title) }}" placeholder="Quiz Title">
                @if ($errors->has('quiz_title'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_title') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="duration">Quiz Duration</label>
                <input type="text" name="quiz_duration" id="quiz_duration" class="form-control"  value="{{ old('quiz_duration', $Quiz->duration) }}" placeholder="Quiz Duration">
                @if ($errors->has('quiz_duration'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_duration') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="status">Select Status</label>
                <select  name="quiz_status"  id="quiz_status" class="form-control form-control-lg">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('quiz_status', $Quiz->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('quiz_status', $Quiz->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if ($errors->has('quiz_status'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_status') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="no_questions">No of Questions</label>
                <input type="text" name="no_questions" id="no_questions"  class="form-control" value="{{ old('no_questions',$Quiz->no_questions )}}"/>
                @if ($errors->has('no_questions'))
                    <div class="alert alert-danger">{{ $errors->first('no_questions') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="description">Description</label>
                <textarea name="quiz_description" id="quiz_description" class="form-control"  rows="4">{{ $Quiz->description }}</textarea>
                @if ($errors->has('quiz_description'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_description') }}</div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        <button class="btn btn-light" onclick="confirmCancel()">Cancel</button>
    </form>
    </div>
    </div>
@endsection
@section('page_scripts')
<script>
    function confirmCancel() {
            window.location.href = '{{ route('quizes.index') }}';
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
