@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container featured-area-default padding-30">
                    @if (isset($article))
                        <div class="row">
                            <div class="col-md-8 padding-20">
                                <div class="row">

                                    <div class="panel panel-default">
                                        <div class="article-heading margin-bottom-5">
                                            <a href="#">
                                                <i class="fa fa-pencil-square-o"></i> {{ $article->question ?? '' }}</a>
                                        </div>
                                        <div class="article-info">
                                            <div class="art-date">
                                                <a href="#">
                                                    <i class="fa fa-calendar-o"></i>

                                                    {{ date(config('ticket.list_date_format'), strtotime($article->created_at)) }}
                                                </a>
                                            </div>
                                            <div class="art-category">
                                                <a href="#">
                                                    <i class="fa fa-folder"></i>{{ $article->service->name }} </a>
                                            </div>
                                            <div class="art-comments">
                                                <a href="#">
                                                    <i class="fa fa-comments-o"></i> {{ $commnetCount }} Comments </a>
                                            </div>
                                        </div>
                                        <div class="article-content">
                                            <p>
                                                {{ $article->answer }}
                                            </p>
                                            <hr class="style-transparent">
                                        </div>


                                    </div>

                                    <div class="panel panel-default">
                                        <div class="article-heading">
                                            <i class="fa fa-comments-o"></i> Comments ({{ $commnetCount }})
                                        </div>
                                        <!-- FIRST LEVEL COMMENT 3 -->
                                        @foreach ($comments as $comment)
                                            <div class="article-content">
                                                <div class="article-comment-top">
                                                    <div class="comments-user">
                                                        <img src="https://stablehelpdesk.faveodemo.com/themes/default/common/images/contacthead.png"
                                                            alt="{{ $comment->user->name }}">
                                                        <div class="user-name">{{ $comment->user->name }}</div>
                                                        <div class="comment-post-date"> <strong>Posted On </strong>
                                                            <span class="italics">
                                                                <strong>{{ date(config('ticket.list_date_format'), strtotime($comment->created_at)) }}</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="comments-content">
                                                        <p>
                                                            {{ strip_tags($comment->comment) }}

                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                        <hr class="style-three">
                                        @if (session()->has('comment'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session()->get('comment') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <!-- LEAVE A REPLY SECTION -->
                                        <div class="panel-transparent">
                                            <div class="article-heading">
                                                <i class="fa fa-comment-o"></i> Leave a Reply
                                            </div>
                                            <form class="comment-form" action="{{ route('knowledges.store.comment') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id"
                                                    value="{{ Auth::check() ? auth()->user()->id : '' }}">
                                                <input type="hidden" name="knowledge_id" value="{{ $article->id }}">
                                                <input type="text" name="name" disabled hidden
                                                    value="{{ Auth::check() ? auth()->user()->name : '' }}">
                                                <input type="text" name="email" disabled hidden
                                                    value="{{ Auth::check() ? auth()->user()->email : '' }}">
                                                <br>
                                                <label>Comment:</label>
                                                <textarea rows="5" cols="2" name="comment"required>{{ old('comment', isset($comment) ? $article->comment : '') }}</textarea>
                                                @if ($errors->has('comment'))
                                                    <em class="text-danger">
                                                        {{ $errors->first('comment') }}
                                                    </em>
                                                @endif
                                                <button type="submit" value="Submit" class="btn btn-wide btn-primary">Post
                                                    Comment</button>
                                            </form>
                                        </div>

                                    </div>
                                    <!-- END COMMENTS -->
                                </div>

                            </div>

                            <!-- SIDEBAR STUFF -->
                            <div class="col-md-4 padding-20">

                                <div class="row margin-top-20">
                                    @include('frontend.knowledgebase.categories')
                                </div>

                            </div>
                            <!-- END SIDEBAR STUFF -->
                        </div>
                    @else
                        <p>No records found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
