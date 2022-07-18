@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="fb-heading">
                                Create Ticket
                            </div>
                            <form action="{{ url('ticket') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group {{ $errors->has('system') ? 'has-error' : '' }}">
                                    <label for="system_name">{{ trans('cruds.ticket.fields.system') }}*</label>
                                    <input type="text" id="system_name" name="system_name" class="form-control"
                                        value="{{ old('system_name', isset($ticket) ? $ticket->system_name : '') }}"
                                        required>
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
                </div>
            </div>
        </div>
    </div>
@endsection
