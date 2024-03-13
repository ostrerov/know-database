@push('css')
    <style>
        .bootstrap-tagsinput {
            width: 100% !important;
        }
    </style>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('js/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush
@push('js')
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('js/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/llfikl3yop08blt9vfd2sen9vv0f8tx1z8q1308krn4wn09b/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="module">One.helpersOnLoad(['jq-notify']);</script>
    <script type="module">
        let bsModal;
        document.addEventListener('DOMContentLoaded', () => {
            bsModal = new bootstrap.Modal('#createCategoryModal');
            $('#tags')
                .on('itemAdded', function () {
                    @this.
                    set('tags', $('#tags').tagsinput('items'))
                })
                .tagsinput({
                    tagClass: 'badge bg-info',
                    confirmKeys: [13, 32, 44],
                    inputClass: 'form-control'
                });

            tinymce.init({
                selector: 'textarea#content',
                plugins: 'autoresize preview importcss searchreplace autolink autosave directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | insertfile image media link anchor codesample | ltr rtl',
                menubar: false,
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                language: 'ru',
                formats: {
                    // Changes the default format for blockquote to have a class of 'foo'
                    blockquote: { block: 'blockquote', classes: 'blockquote' }
                },
                mobile: {
                    menubar: true
                },
                min_height: 500,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/dashboard/posts/image-post-upload',
                file_picker_types: 'image',
                image_class_list: [
                    { title: 'img-fluid', value: 'img-fluid' },
                ],
                file_picker_callback: function (cb, value, meta) {
                    let input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        let file = this.files[0];

                        let reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            let id = 'blobid' + (new Date()).getTime();
                            let blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            let base64 = reader.result.split(',')[1];
                            let blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                },
                setup: function (editor) {
                    editor.on('change', function () {
                        @this.
                        set('content', editor.getContent());
                    });
                }
            });
        })

        document.addEventListener('livewire:init', () => {
            Livewire.on('category-created', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Категория создана'});
                bsModal.toggle()
            })
        });
    </script>
@endpush
<div class="h-auto">
    <form class="row g-0 flex-md-grow-1" wire:submit="save">
        <div class="col-md-4 col-lg-5 col-xl-3 order-md-1">
            <div class="content ps-0">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="d-md-none p-3">
                            <button type="button" class="btn w-100 btn-alt-info js-class-toggle-enabled"
                                    data-toggle="class-toggle" data-target="#side-content" data-class="d-none">
                                Settings
                            </button>
                        </div>
                        <div id="side-content" class="d-md-block push d-none">
                            <div id="settings-accordion" role="tablist" aria-multiselectable="true">
                                <div class="block mb-0">
                                    <div class="block-header bg-body border-top p-0" role="tab"
                                         id="settings-accordion_h2">
                                        <a class="fw-semibold d-block w-100 p-3" data-bs-toggle="collapse"
                                           data-bs-parent="#settings-accordion" href="#settings-accordion_s2"
                                           aria-expanded="true"
                                           aria-controls="settings-accordion_s2">{{ __('Категория') }}</a>
                                    </div>
                                    <div id="settings-accordion_s2" class="collapse show" role="tabpanel"
                                         aria-labelledby="settings-accordion_h2" data-bs-parent="#settings-accordion"
                                         style="">
                                        <div class="block-content block-content-full">
                                            <div class="mb-4">
                                                <div class="space-y-2">
                                                    @if($categoriesList->count() === 0)
                                                        <p>Нет ни одной категории</p>
                                                    @else
                                                        @foreach($categoriesList as $category)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                       id="category-item-{{ $category->id }}"
                                                                       wire:model="categoryID" name="categoryID"
                                                                       value="{{ $category->id }}"
                                                                       control-id="category-item-{{ $category->id }}">
                                                                <label class="form-check-label"
                                                                       for="category-item-{{ $category->id }}">{{ $category->title }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <a class="link-fx fs-sm" href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#createCategoryModal">{{ __('Создать категорию') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="block mb-0">
                                    <div class="block-header bg-body border-top p-0" role="tab"
                                         id="settings-accordion_h3">
                                        <a class="fw-semibold d-block w-100 p-3 collapsed" data-bs-toggle="collapse"
                                           data-bs-parent="#settings-accordion" href="#settings-accordion_s3"
                                           aria-expanded="false"
                                           aria-controls="settings-accordion_s3">{{ __('Тэги') }}</a>
                                    </div>
                                    <div id="settings-accordion_s3" class="collapse show" role="tabpanel"
                                         aria-labelledby="settings-accordion_h3" data-bs-parent="#settings-accordion"
                                         style="">
                                        <div class="block-content">
                                            <div class="mb-4" wire:ignore>
                                                <input type="text" id="tags" class="form-control"
                                                       data-role="tagsinput"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block mb-0">
                                    <div class="block-header bg-body border-top p-0" role="tab"
                                         id="settings-accordion_h4">
                                        <a class="fw-semibold d-block w-100 p-3 collapsed" data-bs-toggle="collapse"
                                           data-bs-parent="#settings-accordion" href="#settings-accordion_s4"
                                           aria-expanded="false"
                                           aria-controls="settings-accordion_s4">{{ __('Обложка поста') }}</a>
                                    </div>
                                    <div id="settings-accordion_s4" class="collapse show" role="tabpanel"
                                         aria-labelledby="settings-accordion_h4" data-bs-parent="#settings-accordion"
                                         style="">
                                        <div class="block-content block-content-full">
                                            <input class="form-control @error('coverURL') is-invalid @enderror"
                                                   wire:model="coverURL" type="file" id="coverURL">
                                            @error('coverURL')
                                            <div id="coverURLFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-7 col-xl-9 order-md-0">
            <div class="content pe-0">
                <div class="block block-rounded">
                    <div class="block-content block-content-full d-flex justify-content-between border-bottom">
                        <div></div>
                        <div>
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                                <div class="d-flex align-items-center">
                                    {{ __('Редактировать') }}
                                    <div wire:loading class="ms-1 spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden"></span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="mb-4">
                            <input type="text" class="form-control py-4 @error('name') is-invalid @enderror" id="name"
                                   wire:model="name" placeholder="{{ __('Название поста...') }}">
                            @error('name')
                            <div id="nameFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('content')
                            <div id="contentFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('tags')
                            <div id="tagsFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('categoryID')
                            <div id="categoryIDFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4" wire:ignore>
                            <textarea id="content" wire:model="content"
                                      class="@error('content') is-invalid @enderror"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @teleport('body')
    <div wire:ignore class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createCategoryLabel">{{ __('Создание категории') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <livewire:dashboard.posts.create-category />
            </div>
        </div>
    </div>
    @endteleport
</div>
