@extends('welcome')

@section('css')
    <style>
        .content-title { font-size: 1.25rem; }
        .book-name { font-size: 24px; }
        .book-date { font-size: 14px; }
    </style>
@stop


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="content-title">
                    <i class="fa fa-book"></i> {{ __('View author') }}
                </span> &nbsp; &nbsp;
                <a href="{{ route('authors.list') }}" class="btn btn-outline-secondary fa fa-list mr-3"> Author list</a>
                <a href="{{ route('author.edit', [$author->id]) }}" class="btn btn-outline-info fa fa-pencil"> Edit</a>
            </div>

            <div class="text-center">@include('flash-message')</div>

            <div id="book" class="row p-5">
                <div id="wrapper" class="row col-12 pt-3 pl-4 d-flex">
                    @if(isset($author))
                        <div class="col-5">
                            <img src="{{ asset($author->avatar) }}" style="width: 300px;" alt="">
                        </div>

                        <div class="col-6 text-left">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="book-name">{{ ucfirst($author->full_name) }}</span>
                                <span class="book-date ">{{ $author->created_at }}</span>
                            </div>
                            <div class="bg-light rounded p-3">{{ $author->bio }}</div>
                        </div>
                    @else
                        <div class="row p-5">
                            <h4>There is no author with the requested id</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
