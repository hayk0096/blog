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
                    <i class="fa fa-user"></i> {{ __('Edit author "' . $author->full_name . '"')  }}
                </span> &nbsp; &nbsp;
                <form action="{{ route('author.destroy', [$author->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-outline-danger"> Delete author</button> &nbsp; &nbsp;
                </form>
                <a href="{{ route('author.show', [$author->id]) }}" class="btn btn-xs btn-outline-info"> View author</a>
            </div>

            <div class="text-center">@include('flash-message')</div>
            <div class="card-body d-flex">
                <div class="w-25">
                    <img src="{{ asset($author->avatar) }}" alt="" class="w-100">
                </div>

                <form method="post" class="w-75" action="{{ route('author.update', [$author->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name *') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" name="full_name" value="{{ old('full_name') ?? $author->full_name}}" required
                                   class="form-control @error('full_name') is-invalid @enderror" autofocus>

                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="bio" rows="5">{{ old('bio') ?? $author->bio }}</textarea>
                            <div class="error-message"> {{ $errors->first('bio') }} </div>
                            @error('bio')
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
