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
                    <i class="fa fa-user-plus"></i> {{ __('Create new author') }}
                </span>
                <a href="{{ route('authors.list') }}" class=""> Author list</a>
            </div>

            <div class="card-body">
                <div class="text-center">@include('flash-message')</div>
                <form method="post" action="{{ route('author.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="full-name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name *') }}</label>

                        <div class="col-md-6">
                            <input id="full-name" type="text" name="full_name" value="{{ old('full_name') }}" required
                                       class="form-control @error('full_name') is-invalid @enderror" autofocus>

                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="error-message"> {{ $errors->first('full_name') }} </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="bio" rows="5">{{ old('bio') }}</textarea>
                            <div class="error-message"> {{ $errors->first('bio') }} </div>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                        <div class="custom-file col-md-6">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar" aria-describedby="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-info"> Create </button>
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
