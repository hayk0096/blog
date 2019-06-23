@extends('welcome')

@section('css')
    <style>
        .content-title { font-size: 1.25rem; }
    </style>
@stop


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="content-title">
                    <i class="fa fa-book"></i> {{ __('Book list') }}
                </span> &nbsp; &nbsp;
                <a href="{{ route('book.create') }}" class="btn btn-xs btn-outline-success font-weight-bold fa fa-plus"> New book </a>
            </div>

            <div class="text-center">@include('flash-message')</div>

            <div id="books-list" class="row pb-5">
                <div id="wrapper" class="row col-12 pt-5 pl-4 d-flex">
                    @if(isset($books) && count($books) > 0)
                        @foreach($books as $book)
                            <div class="col-md-2">
                                <a href="{{ route('book.show', [$book->id]) }}">
                                    <img src="{{ asset($book->avatar) }}" style="width: 150px; height: 200px; object-fit: cover" alt="">
                                    <p>{{ $book->name }}</p>
                                </a>
                            </div>
                        @endforeach

                    <div class="container-fluid">{{ $books->links() }} </div>
                    @else
                        <div class="row p-5">
                            <h4>Not books yet</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
