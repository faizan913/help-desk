@extends('layouts.admin.master')
@section('title', trans('global.create_user'))
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('global.create_user') }}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            @if ($errors->has('name'))
                                <em class="text-danger">
                                    {{ $errors->first('name') }}
                                </em>
                            @endif

                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            @if ($errors->has('email'))
                                <em class="text-danger">
                                    {{ $errors->first('email') }}
                                </em>
                            @endif

                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @if ($errors->has('password'))
                                <em class="text-danger">
                                    {{ $errors->first('password') }}
                                </em>
                            @endif

                        </div>
                        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.user.fields.roles') }}*</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                data-select2-id="1" tabindex="-1" aria-hidden="true" name="role">
                                @foreach ($data['roles'] as $id => $role)
                                    <option {{ collect(old('role'))->contains($id) ? 'selected' : '' }}
                                        value="{{ $id }}">{{ $role }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('role'))
                                <em class="text-danger">
                                    {{ $errors->first('role') }}
                                </em>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                            <label for="department">{{ trans('global.department') }}*</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                data-select2-id="1" tabindex="-1" aria-hidden="true" name="department">
                                @foreach ($data['departments'] as $id => $department)
                                    <option {{ collect(old('department'))->contains($id) ? 'selected' : '' }}
                                        value="{{ $id }}">{{ $department }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('department'))
                                <em class="text-danger">
                                    {{ $errors->first('department') }}
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
