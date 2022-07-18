<tr>
    <td>{{ $ticket->id }}</td>
    <td>{{ $ticket->title }}</td>
    <td>{{ $ticket->status->name ?? '--' }}</td>
    <td> {{ $ticket->priority->name ?? '' }}</td>
    <td>{{ $ticket->service->name ?? '--' }}</td>
    <td>{{ $ticket->user->name }}</td>
    <td>{{ $ticket->assigned_to_user->name ?? '--' }}</td>
    <td>
        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            <span><strong>{{ trans('global.view') }}</strong></span>
        </a>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-xs btn-primary">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>{{ trans('global.edit') }}</strong></span>
        </a>
        @role('Admin')
            <form class="d-inline" action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    <span><strong>{{ trans('global.delete') }}</strong></span>
                </button>
            </form>
        @endrole
    </td>
</tr>
