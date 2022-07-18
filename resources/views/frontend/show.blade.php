@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col">
                    <div style="display: none" id="msg" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @if (session()->has('comment'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('comment') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Ticket #{{ $ticket->id }}</div>
                    {{-- Start Rating Block --}}

                    @include('frontend.ratings.over_all_ratings')
                    {{-- End Rating --}}
                    <div class="card-body">


                        <div class="col-lg-12">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $ticket->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.created_at') }}
                                        </th>
                                        <td>
                                            {{ date(config('ticket.output_date_format'), strtotime($ticket->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.title') }}
                                        </th>
                                        <td>
                                            {{ $ticket->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.content') }}
                                        </th>
                                        <td>
                                            {!! $ticket->content !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.attachments') }}
                                        </th>
                                        <td>
                                            <a href="{{ $ticket->getFirstMedia('attachment') ? $ticket->getFirstMedia('attachment')->getFullUrl() : '' }}"
                                                target="_blank">{{ $ticket->getFirstMedia('attachment') ? $ticket->getFirstMedia('attachment')->getFullUrl() : '---' }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.status') }}
                                        </th>
                                        <td>
                                            {{ $ticket->status->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.priority') }}
                                        </th>
                                        <td>
                                            {{ $ticket->priority->name ?? '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.author_name') }}
                                        </th>
                                        <td>
                                            {{ $ticket->user->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.author_email') }}
                                        </th>
                                        <td>
                                            {{ $ticket->user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.ticket.fields.comments') }}
                                        </th>
                                        <td>
                                            <div style="display: none" id="reply"
                                                class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @forelse ($ticket->comments as $comment)
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="font-weight-bold"><a
                                                                href="mailto:{{ $comment->user->name }}">{{ $comment->user->name }}</a>
                                                            ({{ $comment->created_at }})
                                                        </p>

                                                        <p>{{ $comment->comment }}</p>
                                                    </div>

                                                    @if (Auth::check() && auth()->user()->name !== $comment->user->name)
                                                        <div class="col">
                                                            <form method="POST" id="reply_rating">
                                                                <label
                                                                    for="comment">{{ trans('global.reply_rating') }}</label>
                                                                <div class="rates">
                                                                    <input type="radio" class="reply" name="rating"
                                                                        value="5" data="{{ $comment->id }}"
                                                                        {{ !empty($comment->rating) && $comment->rating == 5 ? 'checked' : '' }}
                                                                        id="5"><label for="5">☆</label>

                                                                    <input type="radio" class="reply" name="rating"
                                                                        value="4" data="{{ $comment->id }}"
                                                                        {{ !empty($comment->rating) && $comment->rating == 4 ? 'checked' : '' }}
                                                                        id="4"><label for="4">☆</label>
                                                                    <input type="radio" class="reply" name="rating"
                                                                        value="3" data="{{ $comment->id }}"
                                                                        {{ !empty($comment->rating) && $comment->rating == 3 ? 'checked' : '' }}
                                                                        id="3"><label for="3">☆</label>
                                                                    <input type="radio" class="reply" name="rating"
                                                                        value="2"
                                                                        {{ !empty($comment->rating) && $comment->rating == 2 ? 'checked' : '' }}
                                                                        id="2" data="{{ $comment->id }}"><label
                                                                        for="2">☆</label>
                                                                    <input type="radio" class="reply" name="rating"
                                                                        value="1"
                                                                        {{ !empty($comment->rating) && $comment->rating == 1 ? 'checked' : '' }}
                                                                        id="1" data="{{ $comment->id }}"><label
                                                                        for="1">☆</label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr />
                                            @empty
                                                <div class="row">
                                                    <div class="col">
                                                        <p>{{ trans('global.no_comment') }}</p>
                                                    </div>
                                                </div>
                                                <hr />
                                            @endforelse
                                            <form action="{{ url('store/comment', $ticket->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="comment">{{ trans('global.leave_comment') }}</label>
                                                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-primary">{{ trans('global.save') }}</button>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script type="text/javascript" src="{{ asset('js/custom/rating.js') }}"></script>
@endsection
