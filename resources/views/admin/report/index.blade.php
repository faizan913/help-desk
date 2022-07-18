@extends('layouts.admin.master')
@section('title', trans('global.reports'))
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('global.reports') }}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @include('admin.common.alert-message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    @include('admin.report.header')
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                        <tr>
                                            <td>
                                                {{ $report->id }}
                                            </td>

                                            <td>
                                                {{ $report->name ?? '' }}
                                            </td>
                                            <td>

                                                <p>{{ trans('global.assigned_ticket') }}:
                                                    {{ count($report->tickets) ?? '' }} </p>
                                                <p>{{ trans('global.open_ticket') }}:
                                                    {{ \App\Models\Ticket::whereHas('status', function ($query) {
                                                        $query->whereName('Open');
                                                    })->where('assigned_to_user_id', $report->id)->count() }}
                                                </p>

                                                <p>{{ trans('global.close_ticket') }}:
                                                    {{ \App\Models\Ticket::whereHas('status', function ($query) {
                                                        $query->whereName('Closed');
                                                    })->where('assigned_to_user_id', $report->id)->count() }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>{{ trans('global.creator') }}:
                                                    {{ count($report->ticketCreators) ?? '' }}</p>
                                                <p>{{ trans('global.open_ticket') }}:
                                                    {{ \App\Models\Ticket::whereHas('status', function ($query) {
                                                        $query->whereName('Open');
                                                    })->where('created_by', $report->id)->count() }}
                                                </p>
                                                <p>{{ trans('global.close_ticket') }}:
                                                    {{ \App\Models\Ticket::whereHas('status', function ($query) {
                                                        $query->whereName('Closed');
                                                    })->where('created_by', $report->id)->count() }}
                                                </p>

                                            </td>

                                        </tr>
                                    @empty
                                        @include('admin.common.no-record-found')
                                    @endforelse
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
