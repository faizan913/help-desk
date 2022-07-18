<tr>
    <td>{{ $priority->name }}</td>
    <td>
        <a href="{{ route('priorities.edit', $priority->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>{{ trans('global.edit') }}</strong></span>
        </a>
        <form class="d-inline" action="{{ route('priorities.destroy', $priority->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>
</tr>
