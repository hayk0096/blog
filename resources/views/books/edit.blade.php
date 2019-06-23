@extends('welcome')

@section('css')
    <style>
        .content-title { font-size: 1.25rem; }
    </style>
@stop


@section('content')
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="content-title">
                    <i class="fa fa-book"></i> {{ __('Edit book "' . $book->name . '"')  }}
                </span> &nbsp; &nbsp;
                <form action="{{ route('book.destroy', [$book->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-outline-danger"> Delete book</button> &nbsp; &nbsp;
                </form>
                <a href="{{ route('book.show', [$book->id]) }}" class="btn btn-xs btn-outline-info"> View book</a>
            </div>

            <div class="text-center">@include('flash-message')</div>
            <div class="card-body d-flex">
                <div class="w-25">
                    <img src="{{ asset($book->avatar) }}" alt="" class="w-100">
                </div>

                <form method="post" class="w-75" action="{{ route('book.update', [$book->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" name="name" value="{{ old('name') ?? $book->name}}" required
                                   class="form-control @error('name') is-invalid @enderror" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="error-message"> {{ $errors->first('name') }} </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author *') }}</label>

                        <div class="col-md-6">
                            <select class="custom-select" name="author" id="author">
                                @if(isset($authors) && count($authors) > 0)
                                    <option value="0">Choose </option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author') || $author->id == $book->author_id
                                        ? 'selected' : '' }}>{{ $author->full_name }}</option>
                                    @endforeach
                                @else
                                    <option value="0">No authors</option>
                                @endif
                            </select>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="error-message"> {{ $errors->first('author') }} </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="context" class="col-md-4 col-form-label text-md-right">{{ __('Context') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="context" rows="5">{{ old('context') ?? $book->context }}</textarea>
                            <div class="error-message"> {{ $errors->first('context') }} </div>
                            @error('context')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('New Avatar') }}</label>
                        <div class="custom-file col-md-6">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
                    </div>


                    <div class="form-group row mb-3 d-flex">
                        <div class="col-md-6 text-left"></div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-success pl-3"> Save </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
