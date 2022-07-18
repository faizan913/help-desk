<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    @foreach ($user->roles as $role)
        <td>{{ $role->name }}</td>
    @endforeach
    <td>{{ $user->departments->name }}</td>
    <td>
        @if ($user->status == \App\Models\User::STATUS_ACTIVE)
            <a href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => \App\Models\User::STATUS_INACTIVE]) }}"
                class="btn btn-success m2" title="Click to de-active">
                <i class="fa fa-check"></i>
            </a>
        @else
            <a href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => \App\Models\User::STATUS_ACTIVE]) }}"
                class="btn btn-danger m2" title="Click to active">
                <i class="fa fa-ban"></i>
            </a>
        @endif
    </td>
    <td>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>{{ trans('global.edit') }}</strong></span>
        </a>
        <form class="d-inline" action="{{ route('users.destroy', $user->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('sure want to delete?')" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <span><strong>{{ trans('global.delete') }}</strong></span>
            </button>
        </form>
    </td>
</tr>
