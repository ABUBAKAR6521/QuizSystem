@extends('layout.secure')
@section('page_title') Edit Qestion @endsection
@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> Edit Question </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Menage Questions</a></li>
                <li class="breadcrumb-item">Edit Question</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form class="forms-sample" action="{{ route('questions.update', $Question->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control form-control-lg">
                    <option value="">Select Catagory</option>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $Question->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->catagory_name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('category_id'))
                    <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="quiz_id">Quiz</label>
                <select name="quiz_id" id="quiz_id" class="form-control form-control-lg">
                    <option value="">Select Quiz</option>
                    @if (count($quizes) > 0)
                        @foreach ($quizes as $quiz)
                            <option value="{{ $quiz->id }}"
                                {{ old('quiz_id', $Question->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('quiz_id'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_id') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="title">Title</label>
                <input type="text" name="question_title" id="question_title" class="form-control"
                    value="{{ old('question_title', $Question->question_title) }}" placeholder="Enter Title" />
                @if ($errors->has('question_title'))
                    <div class="alert alert-danger">{{ $errors->first('question_title') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="status">Select Status</label>
                <select  name="question_status" id="status" class="form-control form-control-lg">
                    <option value="">Select Status</option>
                    <option value="1" {{ $Question->question_status  == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $Question->question_status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if ($errors->has('status'))
                    <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="no_questions">No of Awnsers</label>
                <input type="text" name="no_awnsers" id="no_awnsers" class="form-control"  value="{{ old('no_awnsers',$Question->no_awnsers) }}"/>
                @if ($errors->has('no_awnsers'))
                    <div class="alert alert-danger">{{ $errors->first('no_awnsers') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="description">Description</label>
                <textarea name="question_description" id="question_description" class="form-control" rows="4">{{ $Question->question_description }}</textarea>
                @if ($errors->has('question_description'))
                    <div class="alert alert-danger">{{ $errors->first('question_description') }}</div>
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
        $('#category_id').change(function(event) {
            var category_id = $(this).val();
            if (category_id != '' && category_id != undefined) {
                $('#quiz_id').find('option').not(':first').remove();
                var url = "{{ url('category-quizes') }}/" + category_id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        if (response.status == 'success') {
                            if (response.data.length > 0) {
                                response.data.forEach(function(item) {
                                    $('#quiz_id').append('<option value="' + item.id + '">' +
                                        item.title + '</option>');
                                });
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(response) {
                        //
                    }
                });
            }
        });

    function confirmCancel() {
            window.location.href = '{{ route('questions.index') }}';
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
