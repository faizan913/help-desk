@extends('layouts.admin.master')
@section('title', trans('global.show'))
@section('content')

    <div class="card">
        <div class="card-header">
            Ticket Merge
        </div>

        <div class="container">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    @if (session()->has('choose_another'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('choose_another') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title m-0">#{{ $ticket->id }}
                            </h3><br>
                            <strong>{{ date(config('ticket.list_date_format'), strtotime($ticket->created_at)) }}</strong>
                            <br>
                            <strong>{{ $ticket->title }}</strong>

                        </div>

                        <div class="card-body">
                            <form action="{{ route('tickets.merge.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h6 class="card-title">Enter ticket ID to merge into</h6>
                                <input class="form-control" type="hidden" name="cuur_ticket_id"
                                    value="{{ $ticket->id }}">
                                <input class="form-control" type="number" name="ticket_id"
                                    placeholder="Enter ticket ID to merge into" value="{{ old('ticket_id') }}" required>
                                @if ($errors->has('ticket_id'))
                                    <em class="text-danger">
                                        {{ $errors->first('ticket_id') }}
                                    </em>
                                @endif
                                <div>
                                    <a class="btn btn-default my-2" href="{{ route('tickets.index') }}">
                                        {{ trans('global.back_to_list') }}
                                    </a>
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.merge') }}">
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

        </div>
    </div>
@endsection
