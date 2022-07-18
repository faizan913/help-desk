@extends('layouts.admin.master')
@section('title', trans('global.create_ticket'))
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ trans('global.create_ticket') }}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">

        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('system') ? 'has-error' : '' }}">
                    <label for="system_name">{{ trans('cruds.ticket.fields.system') }}*</label>
                    <input type="text" id="system_name" name="system_name" class="form-control"
                        value="{{ old('system_name', isset($ticket) ? $ticket->system_name : '') }}" required>
                    @if ($errors->has('system_name'))
                        <em class="text-danger">
                            {{ $errors->first('system_name') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">{{ trans('cruds.ticket.fields.title') }}*</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', isset($ticket) ? $ticket->title : '') }}" required>
                    @if ($errors->has('title'))
                        <em class="text-danger">
                            {{ $errors->first('title') }}
                        </em>
                    @endif

                </div>

                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                    <label for="content">{{ trans('cruds.ticket.fields.content') }}*</label>
                    <textarea id="content" name="content" class="form-control " required>{{ old('content', isset($ticket) ? $ticket->content : '') }}</textarea>
                    @if ($errors->has('content'))
                        <em class="text-danger">
                            {{ $errors->first('content') }}
                        </em>
                    @endif

                </div>

                <div class="form-group {{ $errors->has('priority_id') ? 'has-error' : '' }}">
                    <label for="priority">{{ trans('cruds.ticket.fields.priority') }}*</label>
                    <select name="priority" id="priority" class="form-control select2" required>
                        @foreach ($data['priorities'] as $id => $priority)
                            <option value="{{ $id }}"
                                {{ (isset($ticket) && $ticket->priority ? $ticket->priority->id : old('priority_id')) == $id ? 'selected' : '' }}>
                                {{ $priority }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('priority'))
                        <em class="text-danger">
                            {{ $errors->first('priority') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                    <label for="category">{{ trans('cruds.ticket.fields.category') }}*</label>
                    <select name="service" id="category" class="form-control select2" required>
                        @foreach ($data['services'] as $id => $category)
                            <option value="{{ $id }}"
                                {{ (isset($ticket) && $ticket->category ? $ticket->category->id : old('category_id')) == $id ? 'selected' : '' }}>
                                {{ $category }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('service'))
                        <em class="text-danger">
                            {{ $errors->first('service') }}
                        </em>
                    @endif
                </div>

                @if (auth()->user()->hasRole('Admin'))
                    <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                        <label for="status">{{ trans('cruds.ticket.fields.status') }}*</label>
                        <select name="status" id="status" class="form-control select2" required>
                            @foreach ($data['statuses'] as $id => $status)
                                <option value="{{ $id }}"
                                    {{ (isset($ticket) && $ticket->status ? $ticket->status->id : old('status_id')) == $id ? 'selected' : '' }}>
                                    {{ $status }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <em class="text-danger">
                                {{ $errors->first('status') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('assigned_to_user_id') ? 'has-error' : '' }}">
                        <label for="assigned_to_user">{{ trans('cruds.ticket.fields.assigned_to_user') }}</label>
                        <select name="assigned_to_user_id" id="assigned_to_user" class="form-control select2">
                            @foreach ($data['assigned_to_users'] as $id => $assigned_to_user)
                                <option value="{{ $id }}"
                                    {{ (isset($ticket) && $ticket->assigned_to_user ? $ticket->assigned_to_user->id : old('assigned_to_user_id')) == $id ? 'selected' : '' }}>
                                    {{ $assigned_to_user }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('assigned_to_user_id'))
                            <em class="text-danger">
                                {{ $errors->first('assigned_to_user_id') }}
                            </em>
                        @endif
                    </div>
                @endif
                <div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
                    <label for="attachment">{{ trans('cruds.ticket.fields.attachments') }}</label>
                    <div class="needsclick dropzone" id="attachment-dropzone">
                        <input type="file" name="attachment" class="form-control">
                    </div>
                    @if ($errors->has('attachment'))
                        <em class="text-danger">
                            {{ $errors->first('attachment') }}
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
