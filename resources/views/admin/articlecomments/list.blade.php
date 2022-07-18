<tr>
    <td>
        {{ $comment->id ?? '' }}
    </td>
    <td>
        {{ Str::limit(strip_tags($comment->knowledge->question), 30, $end = '.') }}
    </td>
    <td>
        {{ Str::limit(strip_tags($comment->comment), 50, $end = '.') }}
    </td>
    <td>
        {{ $comment->user->name ?? '' }}
    </td>
    <td>

        {{ date(config('ticket.list_date_format'), strtotime($comment->created_at)) }}
    </td>
    <td>
        <form action="{{ route('articlecomments.destroy', $comment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>

</tr>
