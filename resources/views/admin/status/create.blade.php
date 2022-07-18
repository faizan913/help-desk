@extends('layouts.admin.master')
@section('title', trans('global.create_status'))
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('global.create_status') }}</h1>
                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="{{ route('statuses.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">{{ trans('cruds.status.fields.name') }}</label>
                                    <input type="name" name="name" class="form-control" id="exampleInputName"
                                        value="{{ old('name') }}" placeholder="Enter name">
                                    @if ($errors->has('name'))
                                        <em class="text-danger">
                                            {{ $errors->first('name') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
