<tr>
    <td>{{ $data->service->name }}</td>
    <td>
        {{ Str::limit(strip_tags($data->question), 100, $end = '...') }}
    </td>

    <td>
        {{ Str::limit(strip_tags($data->answer), 100, $end = '...') }}
    </td>
    <td>
        <a href="{{ route('knowledges.edit', $data->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>{{ trans('global.edit') }}</strong></span>
        </a>
        <form class="d-inline" action="{{ route('knowledges.destroy', $data->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
        <a href="{{ route('knowledges.show', $data->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>View</strong></span>
        </a>
    </td>
</tr>
