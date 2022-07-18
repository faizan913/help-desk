@extends('layouts.admin.master')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('global.dashboard') }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @foreach ($data as $key => $cnt)
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $cnt }}</h3>
                                <p> {{ $key }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- ./col -->
                <!-- div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{-- {{ $data['openTickets'] }} --}}</h3>
                                    <p>{{ trans('global.open_tickets') }}
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div-->

                <!-- ./col -->
                <!--div class="col-lg-4 col-6">
                                
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{-- {{ $data['closedTickets'] }} --}}</h3>
                                        <p>{{ trans('global.closed_tickets') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                </div>
                            </div -->
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
