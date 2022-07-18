@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-margin">
                    <div class="card-body">
                        <div class="row search-body">
                            <div class="col-lg-12">
                                <div class="search-result">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="result-body">
                                        <div class="table-responsive">
                                            <div class="fb-heading">
                                                Tickets
                                            </div>
                                            <table class="table widget-26">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('global.id') }}</th>
                                                        <th>{{ trans('global.title') }}</th>
                                                        <th>{{ trans('global.content') }}</th>
                                                        <th>{{ trans('global.priority') }}</th>
                                                        <th>{{ trans('global.service') }}</th>
                                                        <th>{{ trans('global.author_name') }}</th>
                                                        {{-- <th>{{ trans('global.author_email') }}</th> --}}
                                                        <th>{{ trans('global.status') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tickets as $ticket)
                                                        <tr>
                                                            <td>{{ $ticket->id }}</td>
                                                            <td><a
                                                                    href="{{ url('ticket', $ticket->id) }}">{{ $ticket->title }}</a>
                                                            </td>
                                                            <td>{{ $ticket->content }}</td>
                                                            <td> {{ $ticket->priority->name ?? '' }}</td>
                                                            <td>{{ $ticket->service->name ?? '--' }}</td>
                                                            <td>{{ $ticket->user->name }}</td>
                                                            {{-- <td> {{ $ticket->user->email }}</td> --}}
                                                            <td>{{ $ticket->status->name ?? '--' }}</td>
                                                        </tr>
                                                    @empty
                                                        @include('admin.common.no-record-found')
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
