<tr>
    <td>{{ $service->name }}</td>
    <td>
        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>{{ trans('global.edit') }}</strong></span>
        </a>
        <form class="d-inline" action="{{ route('services.destroy', $service->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>
</tr>
