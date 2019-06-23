@extends('welcome')

@section('css')
    <style>
        .content-title { font-size: 1.25rem; }
        .book-name { font-size: 2rem}
    </style>
@stop


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="content-title">
                    <i class="fa fa-book"></i> {{ __('View book') }}
                </span> &nbsp; &nbsp;
                <a href="{{ route('books.list') }}" class="btn btn-outline-secondary fa fa-list mr-3"> Book list</a>
                <a href="{{ route('book.edit', [$book->id]) }}" class="btn btn-outline-info fa fa-pencil"> Edit</a>
            </div>

            <div class="text-center">@include('flash-message')</div>

            <div id="book" class="row p-5">
                <div id="wrapper" class="row col-12 pt-3 pl-4 d-flex">
                    @if(isset($book))
                        <div class="col-5">
                            <img src="{{ asset($book->avatar) }}" style="width: 300px;" alt="">
                        </div>

                        <div class="col-6 text-left">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="book-name">{{ ucfirst($book->name) }}</span>
                                <span class="book-date ">{{ $book->created_at }}</span>
                            </div>
                            <div class="bg-light rounded p-3">{{ $book->context }}</div>
                        </div>
                    @else
                        <div class="row p-5">
                            <h4>There is no book with the requested id</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
