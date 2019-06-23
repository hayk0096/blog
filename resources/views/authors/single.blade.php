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
                    <i class="fa fa-book"></i> {{ __('View author "' . $author->full_name . '"') }}
                </span> &nbsp; &nbsp;
                <a href="{{ route('authors.list') }}" class="btn btn-outline-secondary fa fa-list mr-3"> Author list</a>
                <a href="{{ route('author.edit', [$author->id]) }}" class="btn btn-outline-info fa fa-pencil"> Edit</a>
            </div>

            <div class="text-center">@include('flash-message')</div>

            <div id="book" class="row p-5">
                @if(isset($author))
                    <div id="wrapper" class="row col-12 pt-3 pl-4 d-flex">
                        <div class="col-5">
                            <img src="{{ asset($author->avatar) }}" style="width: 300px;" alt="">
                        </div>

                        <div class="col-6">
                            <div class="bg-light rounded p-3">{{ $author->bio }}</div>
                            <div class="text-right">
                                <span class="book-date ">{{ $author->created_at }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="container pt-5 pb-5 mt-3">
                        <div id="books">
                        @if($author->books && count($author->books) > 0)
                                <h3 class="text-left">Books of {{ ucfirst($author->full_name) }}</h3>
                                <div id="wrapper" class="row col-12 pt-5 pl-4 d-flex">
                                    @foreach($author->books as $book)
                                        <div class="col-md-2">
                                            <a href="{{ route('book.show', [$book->id]) }}">
                                                <img src="{{ asset($book->avatar) }}" style="width: 150px; height: 200px; object-fit: cover" alt="">
                                                <p>{{ $book->name }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h3>{{ $author->full_name }} have not books.</h3>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="row p-5">
                        <h4>There is no author with the requested id</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
