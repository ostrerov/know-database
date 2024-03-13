<div class="table-responsive">
    <table class="table  table-bordered table-hover text-center" id="users-all">
        <thead>
        <tr>
            <th>
                Имя
            </th>
            <th>
                Логин
            </th>
            <th>
                Роль
            </th>
            <th>
                Регистрация
            </th>
            <th>
                Последние изменения
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($usersList as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->login }}
                </td>
                <td>
                    <select id="roles" class="form-select @error('status') is-invalid @enderror"
                            wire:change="editRole({{ $user->id }}, $event.target.value); $wire.$refresh">
                        @foreach($rolesList as $role)
                            @if($user->role->id === $role->id)
                                <option value="" selected disabled>{{ $user->role->name }}</option>
                            @else
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                <span class="tf-format" tf-unix="{{ strtotime($user->created_at) }}">
                    {{ $user->created_at }}
                </span>
                </td>
                <td>
                <span class="tf-format" tf-unix="{{ strtotime($user->updated_at) }}">
                    {{ $user->updated_at }}
                </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
