@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col-md-3">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div><a href="{{ url('list') }}">
                                    <p class="mb-0 text-secondary">{{ trans('global.my_tickets') }}
                                        {{ $counts['totalTickets'] }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ url('list/open') }}">
                                    <p class="mb-0 text-secondary">{{ trans('global.open_tickets') }}
                                        {{ $counts['openTickets'] }}</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ url('list/close') }}">
                                    <p class="mb-0 text-secondary">{{ trans('global.close_tickets') }}
                                        {{ $counts['closedTickets'] }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ url('create') }}">
                                    <p class="mb-0 text-secondary">{{ trans('global.submit_tickets') }}</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ url('knowledge/base') }}">
                                    <p class="mb-0 text-secondary">{{ trans('global.knowledge_base') }}</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
