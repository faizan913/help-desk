@extends('layouts.admin.master')
@section('title', 'Edit Comment')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comments.update', [$comment->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <div class="form-group {{ $errors->has('ticket_id') ? 'has-error' : '' }}">
                    <label for="ticket">{{ trans('cruds.comment.fields.ticket') }}</label>
                    <select name="ticket_id" id="ticket" class="form-control select2">
                        @foreach ($tickets as $id => $ticket)
                            <option value="{{ $id }}"
                                {{ (isset($comment) && $comment->ticket ? $comment->ticket->id : old('ticket_id')) == $id ? 'selected' : '' }}>
                                {{ $ticket }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('ticket_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('ticket_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('author_name') ? 'has-error' : '' }}">
                    <label for="author_name">{{ trans('cruds.comment.fields.author_name') }}*</label>
                    <input type="text" id="author_name" name="author_name" class="form-control"
                        value="{{ old('author_name', isset($comment) ? $comment->author_name : '') }}" required>
                    @if ($errors->has('author_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('author_name') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('author_email') ? 'has-error' : '' }}">
                    <label for="author_email">{{ trans('cruds.comment.fields.author_email') }}*</label>
                    <input type="text" id="author_email" name="author_email" class="form-control"
                        value="{{ old('author_email', isset($comment) ? $comment->author_email : '') }}" required>
                    @if ($errors->has('author_email'))
                        <em class="invalid-feedback">
                            {{ $errors->first('author_email') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                    <label for="user">{{ trans('cruds.comment.fields.user') }}</label>
                    <select name="user_id" id="user" class="form-control select2">
                        @foreach ($users as $id => $user)
                            <option value="{{ $id }}"
                                {{ (isset($comment) && $comment->user ? $comment->user->id : old('user_id')) == $id ? 'selected' : '' }}>
                                {{ $user }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('user_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    <label for="comment">{{ trans('cruds.comment.fields.comment') }}*</label>
                    <textarea id="comment" name="comment" class="form-control " required>{{ old('comment_text', isset($comment) ? $comment->comment_text : '') }}</textarea>
                    @if ($errors->has('comment'))
                        <em class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </em>
                    @endif

                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
