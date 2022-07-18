@extends('layouts.admin.master')
@section('title', trans('global.show'))
@section('content')

    <div class="card">
        <div class="card-header">
            View
        </div>

        <div class="container">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    @if (session()->has('choose_another'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('choose_another') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title m-0">#{{ $article->id }}
                            </h3><br>
                            <strong>Created at:
                            </strong><span>{{ date(config('ticket.list_date_format'), strtotime($article->created_at)) }}</span>
                            <br>
                            <strong>Category: </strong>
                            <span>{{ $article->service->name }}</span>
                            <br>
                            <strong>Question: </strong><span>{{ strip_tags($article->question) }}</span><br>
                            <strong>Answer:</strong>
                            <span>{{ strip_tags($article->answer) }}</span>
                        </div>
                    </div>

                    <a class="btn btn-default my-2" href="{{ route('knowledges.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

        </div>
    </div>
@endsection
