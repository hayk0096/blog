@extends('welcome')

@section('css')
    <style>
        .content-title { font-size: 1.25rem; }
    </style>
@stop


@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="content-title">
                    <i class="fa fa-book"></i> {{ __('Create new book') }}
                </span>
                <a href="{{ route('books.list') }}" class=""> Book list</a>
            </div>

            <div class="text-center">@include('flash-message')</div>
            <div class="card-body">
                <form method="post" action="{{ route('book.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                   class="form-control @error('name') is-invalid @enderror" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author *') }}</label>

                        <div class="col-md-6">
                            <select class="custom-select @error('author') is-invalid @enderror" name="author" id="author">
                                @if(isset($authors) && count($authors) > 0)
                                    <option value="">Choose </option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author') ? 'selected' : '' }}>{{ $author->full_name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No authors</option>
                                @endif
                            </select>
                            @error('author')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="context" class="col-md-4 col-form-label text-md-right">{{ __('Context') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="context" rows="5">{{ old('context') }}</textarea>
                            <div class="error-message"> {{ $errors->first('context') }} </div>
                            @error('context')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                        <div class="custom-file col-md-6">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
                    </div>


                    <div class="form-group row mb-3 d-flex">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('author.create') }}" class="btn btn-secondary pl-3 fa fa-plus"> New Author </a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-info pl-3"> Create </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
@stop
