<tr>
    <td>
        {{ $rating->id ?? '' }}
    </td>
    <td>
        # {{ $rating->ticket->id ?? '' }}
    </td>
    <td>
        {{ $rating->user->name ?? '' }}
    </td>

    <td>
        {{ $rating->rating ?? '--' }}
    </td>
    <td>
        <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>

</tr>
