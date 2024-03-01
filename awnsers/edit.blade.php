@extends('layout.secure')
@section('page_title') Edit Awnser @endsection
@section('table_header')
    <div class="page-header mt-3">
        <h3 class="page-title"> Edit Awnser </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('awnsers.index') }}">Menage Awnser</a></li>
                <li class="breadcrumb-item">Edit Awnser</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form class="forms-sample" action=" {{ route('awnsers.update', $awnser->id) }} " method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control form-control-lg">
                    <option value=""> Select Category </option>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $awnser->category_id) == $category->id ? 'selected' : '' }}>
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
                    <option value=""> Select Quiz </option>
                    @if (count($quizes) > 0)
                        @foreach ($quizes as $quiz)
                            <option value="{{ $quiz->id }}"
                                {{ old('quiz_id', $awnser->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('quiz_id'))
                    <div class="alert alert-danger">{{ $errors->first('quiz_id') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="question_id">Question</label>
                <select name="question_id" id="question_id" class="form-control form-control-lg">
                    <option value="">Select Question</option>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <option value="{{ $question->id }}"
                                {{ old('question_id', $awnser->question_id) == $question->id ? 'selected' : '' }}>
                                {{ $question->question_title }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('question_id'))
                    <div class="alert alert-danger">{{ $errors->first('question_id') }}</div>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="status">Select Status</label>
                <select  name="status" id="status" class="form-control form-control-lg">
                    <option value="">Select Status</option>
                    <option value="1" {{ $awnser->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $awnser->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if ($errors->has('status'))
                    <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $awnser->title) }}" placeholder="Enter Title" />
                @if ($errors->has('title'))
                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group col-md-6 mt-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="is-correct" id="is-correct" class="form-check-input" value="1" >
                        Is-Correct Awnser <i class="input-helper"></i></label>
                </div>
                @if ($errors->has('is_correct'))
                    <div class="alert alert-danger">{{ $errors->first('is_correct') }}</div>
                @endif
            </div>
            <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{old('description',$awnser->description )}}</textarea>
                @if ($errors->has('question_description'))
                    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
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

        $('#quiz_id').change(function(event) {
            var quiz_id = $(this).val();
            if (quiz_id != '' && quiz_id != undefined) {
                $('#question_id').find('option').not(':first').remove();
                var url = "{{ url('category-questions') }}/" + quiz_id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        if (response.data.length > 0) {
                            response.data.forEach(function(item) {
                                $('#question_id').append('<option value="' + item.id + '">' +
                                    item.question_title + '</option>')
                            });
                        } else {
                            alert(response.message);
                        }

                    },
                    error: function(response) {
                        //
                    }
                })

            }
        })
    function confirmCancel() {
         window.location.href = '{{ route('awnsers.index') }}';
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
