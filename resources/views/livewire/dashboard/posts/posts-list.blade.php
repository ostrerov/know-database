@push('js')
    <script type="module" src="{{ asset('js/tf.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
    <script type="module">One.helpersOnLoad(['jq-notify']);</script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('post-deleted', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Пост удалён'});
            })
        });
    </script>
@endpush

<div class="table-responsive">
    <table class="table  table-bordered table-hover" id="users-all">
        <thead class="text-center align-middle">
        <tr>
            <th>
                №
            </th>
            <th>
                Автор
            </th>
            <th>
                Категория
            </th>
            <th>
                Краткое описания
            </th>
            <th>
                Дата создания
            </th>
            <th>
                Дата последнего изменения
            </th>
            <th>
                Действие
            </th>
        </tr>
        </thead>
        <tbody class="align-middle">
        @if($posts->count() === 0)
            <tr>
                <td colspan="7" class="text-center">
                    {{ __('Нет ни одного поста') }}
                </td>
            </tr>
        @else
            @foreach($posts as $post)
                <tr>
                    <td class="text-center">
                        {{ $post->id }}
                    </td>
                    <td class="text-center">
                        {{ $post->user->name }}
                    </td>
                    <td class="text-center">
                        {{ $post->category->title }}
                    </td>
                    <td>
                        {!! $post->short_text !!}
                    </td>
                    <td class="text-center">
                <span class="tf-format" tf-unix="{{ strtotime($post->created_at) }}">
                    {{ $post->created_at }}
                </span>
                    </td>
                    <td class="text-center">
                <span class="tf-format" tf-unix="{{ strtotime($post->created_at) }}">
                    {{ $post->updated_at }}
                </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            @if($post->id === Auth::user()->id OR Auth::user()->isAdmin())
                                <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-sm btn-alt-secondary text-warning" data-bs-toggle="tooltip" title="Редактировать">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                            @endif
                            <a href="{{ route('dashboard.posts.preview', $post->id) }}" class="btn btn-sm btn-alt-secondary text-info" data-bs-toggle="tooltip" title="Посмотреть">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            @if($post->id === Auth::user()->id OR Auth::user()->isAdmin())
                                <button type="button" class="btn btn-sm btn-alt-secondary text-danger" wire:click="deletePost({{ $post->id }})" wire:confirm.prompt="Вы уверены, что хотите удалить?\n\nВведите УДАЛИТЬ, чтобы подтвердить ваши действия|Удалить" data-bs-toggle="tooltip" title="Удалить">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
