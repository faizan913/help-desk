@extends('layouts.admin.master')
@section('title', trans('global.tickets'))
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('global.tickets') }}</h1>
                </div>
                @role('Admin')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('tickets.create') }}"
                                    class="btn btn-block btn-primary">{{ trans('global.create_ticket') }}</a></li>
                        </ol>
                    </div>
                @endrole
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                @include('admin.common.alert-message')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        @include('admin.ticket.header')
                                    </thead>
                                    <tbody>
                                        @each('admin.ticket.list', $tickets, 'ticket', 'admin.common.no-record-found')
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
