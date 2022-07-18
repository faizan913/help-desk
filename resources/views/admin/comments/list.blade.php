<tr>
    <td>
        {{ $comment->id ?? '' }}
    </td>
    <td>
        {{ $comment->ticket->title ?? '' }}
    </td>
    <td>
        {{ $comment->user->name ?? '' }}
    </td>
    <td>
        {{ $comment->user->email ?? '' }}
    </td>
    <td>
        {{ $comment->comment ?? '' }}
    </td>
    <td>
        {{ $comment->rating ?? '' }}
    </td>
    <td>
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>

</tr>
