@extends('layouts.admin.master')
@section('title', trans('global.create_knowledge_base'))
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('global.create_knowledge_base') }}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('knowledges.store') }}" method="POST">
                        @csrf

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label for="category">{{ trans('cruds.ticket.fields.category') }}*</label>
                            <select name="service" id="service" class="form-control select2" required>
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
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label for="question">{{ trans('cruds.question.fields.question') }}*</label>
                            <input type="text" id="question" name="question" class="form-control"
                                value="{{ old('question', isset($question) ? $question->question : '') }}" required>
                            @if ($errors->has('question'))
                                <em class="text-danger">
                                    {{ $errors->first('question') }}
                                </em>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                            <label for="answer">{{ trans('cruds.question.fields.ans') }}*</label>
                            <textarea id="answer" name="answer" class="form-control " required>{{ old('answer', isset($answer) ? $answer->answer : '') }}</textarea>
                            @if ($errors->has('answer'))
                                <em class="text-danger">
                                    {{ $errors->first('answer') }}
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
    </section>
@endsection
