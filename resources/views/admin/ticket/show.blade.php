@extends('layouts.admin.master')
@section('title', trans('global.show'))
@section('content')

    <div class="card">

        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.ticket.title') }}
            @role('Admin')
                <div class="col">
                    <a href="{{ route('tickets.merge', $ticket->id) }}" class="btn btn-xs btn-danger">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span><strong>Merge into another ticket</strong></span>
                    </a>
                </div>
            @endrole
        </div>

        <div class="card-body">
            @if (session()->has('comment'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('comment') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="mb-2">
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
                                {{ trans('cruds.ticket.fields.assigned_to_user') }}
                            </th>
                            <td>
                                {{ $ticket->assigned_to_user->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.comments') }}
                            </th>
                            <td>
                                @forelse ($ticket->comments as $comment)
                                    <div class="row">
                                        <div class="col">
                                            <p class="font-weight-bold"><a
                                                    href="mailto:{{ $comment->user->email }}">{{ $comment->user->email }}</a>
                                                ({{ $comment->created_at }})
                                            </p>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
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
                                <form action="{{ route('tickets.store.comment', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">{{ trans('global.leave_comment') }}</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                                </form>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <a class="btn btn-default my-2" href="{{ route('tickets.index') }}">
                {{ trans('global.back_to_list') }}
            </a>

            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary">
                @lang('global.edit') @lang('cruds.ticket.title_singular')
            </a>

            <nav class="mb-3">
                <div class="nav nav-tabs">

                </div>
            </nav>
        </div>
    </div>
@endsection
