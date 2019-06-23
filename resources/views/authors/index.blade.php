@extends('welcome')

@section('css')

@stop


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="content-title">
                    <i class="fa fa-user"></i> {{ __('Author list') }}
                </span> &nbsp; &nbsp;
                <a href="{{ route('author.create') }}" class="btn btn-xs btn-outline-success font-weight-bold fa fa-plus"> New author </a>
            </div>

            <div class="text-center">@include('flash-message')</div>

            <div id="authors-list" class="row pb-5">
                <div id="wrapper" class="row col-12 pt-5 pl-4 d-flex">
                    @if(isset($authors) && count($authors) > 0)
                        @foreach($authors as $author)
                            <div class="col-md-2">
                                <a href="{{ route('author.show', [$author->id]) }}">
                                    <img src="{{ asset($author->avatar) }}" style="width: 150px; height: 200px; object-fit: cover" alt="">
                                    <p>{{ $author->full_name }}</p>
                                </a>
                            </div>
                        @endforeach

                        <div class="container-fluid">{{ $authors->links() }} </div>
                    @else
                        <div class="row p-5">
                            <h4>Not authors yet</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@stop
