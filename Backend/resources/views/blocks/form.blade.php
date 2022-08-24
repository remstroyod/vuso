@extends('layouts.app')

@section('content')

    @php( $title = (isset($item)) ? __( 'Блоки: Редактирование записи' ) : __( 'Блоки: Создание записи' ) )

    @if( request()->routeIs('blocks.default.*') )

        @include('template-parts.breadcrumbs', [
                'breadcrumbsList' => [
                    'page' => [
                        'title'     => $page->name,
                        'url'       => route($page->page . '.edit'),
                        'active'    => false,
                    ],
                    'blocks' => [
                        'title'     => __( 'Блоки' ),
                        'url'       => route('blocks.default.index', ['page' => $page]),
                        'active'    => false,
                    ],
                    'history-form' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ]
                ]
        ])

    @elseif( request()->routeIs('blocks.static.*') )

            @include('template-parts.breadcrumbs', [
                    'breadcrumbsList' => [
                        'static-page' => [
                            'title'     => __( 'Статические страницы' ),
                            'url'       => route('static-pages.index'),
                            'active'    => false,
                        ],
                        'page' => [
                            'title'     => $page->name,
                            'url'       => route('static-pages.edit', $page),
                            'active'    => false,
                        ],
                        'blocks' => [
                            'title'     => __( 'Блоки' ),
                            'url'       => route('blocks.static.index', ['page' => $page]),
                            'active'    => false,
                        ],
                        'history-form' => [
                            'title'     => $title,
                            'url'       => '',
                            'active'    => true,
                        ]
                    ]
            ])

        @elseif( request()->routeIs('blocks.catalog.category.*') )

            @include('template-parts.breadcrumbs', [
                'breadcrumbsList' => [
                    'catalog' => [
                        'title'     => ($page->page === 'b2b') ? __( 'Каталог B2B' ) : __( 'Каталог' ),
                        'url'       => route($page->page . '.edit'),
                        'active'    => false,
                    ],
                    'categories' => [
                        'title'     => __( 'Категории' ),
                        'url'       => route($page->page . '.categories.index'),
                        'active'    => false,
                    ],
                    'category' => [
                        'title'     => $category->name,
                        'url'       => route($page->page . '.categories.edit', ['category' => $category]),
                        'active'    => false,
                    ],
                    'category-blocks' => [
                        'title'     => __( 'Блоки' ),
                        'url'       => route('blocks.catalog.category.index', ['page' => $page, 'category' => $category]),
                        'active'    => false,
                    ],
                    'blocks' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
                ]
            ])

        @endif

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin ">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('template-parts.message')

            @isset( $item )
                @includeWhen($item->id, 'blocks.tabs', ['page' => $page, 'block' => $item])
            @endisset

            <!-- Form -->
            <form
                    @if( request()->routeIs('blocks.default.create') || request()->routeIs('blocks.default.edit') )
                        action="{{ route(((isset($item)) ? 'blocks.default.update' : 'blocks.default.store'), isset($item) ? ['page' => $page, 'block' => $item] : ['page' => $page]) }}"
                    @elseif( request()->routeIs('blocks.static.create') || request()->routeIs('blocks.static.edit') )
                        action="{{ route(((isset($item)) ? 'blocks.static.update' : 'blocks.static.store'), isset($item) ? ['page' => $page, 'block' => $item] : ['page' => $page]) }}"
                    @elseif( request()->routeIs('blocks.catalog.category.create') || request()->routeIs('blocks.catalog.category.edit') )
                        action="{{ route(((isset($item)) ? 'blocks.catalog.category.update' : 'blocks.catalog.category.store'), isset($item) ? ['page' => $page, 'category' => $category, 'block' => $item] : ['page' => $page, 'category' => $category]) }}"
                    @endif
                    method="post"
                    enctype="multipart/form-data"
                    class="blocksForm"
            >
            @csrf

                @if( request()->routeIs('blocks.default.create') )
                    {!! html_hidden('model', 'page') !!}
                    {!! html_hidden('page_id', $page->id) !!}
                @elseif( request()->routeIs('blocks.static.create') )
                    {!! html_hidden('model', 'static') !!}
                    {!! html_hidden('page_id', $page->id) !!}
                @elseif( request()->routeIs('blocks.catalog.category.create') )
                    {!! html_hidden('model', 'catalog.category') !!}
                    {!! html_hidden('page_id', $category->id) !!}
                @endif

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- form group -->
                                <div class="form-group row fieldBlocks @isset($fields) @if( ! array_key_exists('title', $fields) ) hidden @endif @endisset">
                                    <label for="title" class="col-sm-3 col-form-label">
                                        {{ __( 'Заголовок' ) }}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! html_input('text', 'title', (isset($item)) ? $item->title : '', ['class' => 'form-control', 'id' => 'title']) !!}
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group row fieldBlocks @isset($fields) @if( ! array_key_exists('subtitle', $fields) ) hidden @endif @endisset">
                                    <label for="subtitle" class="col-sm-3 col-form-label">
                                        {{ __( 'Подзаголовок' ) }}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! html_input('text', 'subtitle', (isset($item)) ? $item->subtitle : '', ['class' => 'form-control', 'id' => 'subtitle']) !!}
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group row fieldBlocks @isset($fields) @if( ! array_key_exists('link', $fields) ) hidden @endif @endisset">
                                    <label for="link" class="col-sm-3 col-form-label">
                                        {{ __( 'Ссылка' ) }}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! html_input('text', 'link', (isset($item)) ? $item->link : '', ['class' => 'form-control', 'id' => 'link']) !!}
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group row fieldBlocks @isset($fields) @if( ! array_key_exists('linktext', $fields) ) hidden @endif @endisset">
                                    <label for="linktext" class="col-sm-3 col-form-label">
                                        {{ __( 'Текст ссылки' ) }}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! html_input('text', 'linktext', (isset($item)) ? $item->linktext : '', ['class' => 'form-control', 'id' => 'linktext']) !!}
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group fieldBlocks @isset($fields) @if( ! array_key_exists('excerpt', $fields) ) hidden @endif @endisset">
                                    <label for="excerpt">
                                        {{ __( 'Отрывок' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', (isset($item)) ? $item->excerpt : '', ['class' => 'form-control', 'id'=>'excerpt', 'rows' => 7]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group fieldBlocks @isset($fields) @if( ! array_key_exists('description', $fields) ) hidden @endif @endisset">
                                    <label for="description">
                                        {{ __( 'Текст' ) }}
                                    </label>
                                    {!! html_textarea('description', (isset($item)) ? $item->description : '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group fieldBlocks @isset($fields) @if( ! array_key_exists('content', $fields) ) hidden @endif @endisset">
                                    <label for="content">
                                        {{ __( 'Код' ) }}
                                    </label>
                                    <!-- Real Textarea -->
                                    <div style="display: none">
                                        {!! html_textarea('content', isset($item) ? $item->content : '', ['class' => 'BlocksHtmlTextarea']) !!}
                                    </div>
                                    <!-- End Real Textarea -->

                                    <!-- Editor -->
                                    <div class="ui-widget-header ace-editor w-100" id="blocks_html_editor">{{(isset($item)) ? $item->content : ''}}</div>
                                    <!-- End Editor -->
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', (isset($item)) ? $item->is_active : '', ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    @if( request()->routeIs('blocks.default.create') || request()->routeIs('blocks.default.edit') )
                                        <a href="{{ route('blocks.default.index', ['page' => $page]) }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>
                                    @elseif( request()->routeIs('blocks.static.create') || request()->routeIs('blocks.static.edit') )
                                        <a href="{{ route('blocks.static.index', ['page' => $page]) }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>
                                    @elseif( request()->routeIs('blocks.catalog.category.create') || request()->routeIs('blocks.catalog.category.edit') )
                                        <a href="{{ route('blocks.catalog.category.index', ['page' => $page, 'category' => $category]) }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>
                                    @endif

                                </fieldset>
                                <!-- end fieldset -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-lg-4 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="component">
                                        {{ __( 'Компонент' ) }}
                                    </label>

                                    <select name="component" id="component" class="custom-select selectTemplate">
                                        @foreach( $templates['list'] as $key => $option )
                                            <option
                                                    value="{{ $key }}"
                                                    @isset( $item ) @if( $item->component == $key ) selected="selected" @endif @endisset
                                                    data-fields='{{ ($templates['fields'][$key]['fields']) ? $templates['fields'][$key]['fields'] : "" }}'
                                            >
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <p class="card-description pt-3">
                                        <small>{{ __( 'Компоненты размещаются в папке' ) }}: Frontend/resources/views/components</small>
                                    </p>

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-3">
                                    <label for="position">
                                        {{ __( 'Расположение' ) }}
                                    </label>
                                    {!! html_select('position', isset($item) ? $item->position : '', ['' => 'Выбрать', 'top' => 'Сверху', 'left' => 'Слева', 'right' => 'Справа', 'bottom' => 'Снизу'], ['class' => 'custom-select', 'id' => 'position']) !!}

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-3">
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($item)) ? $item->order : 0, ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-5 fieldBlocks">
                                    <label for="published_at">
                                        {{ __( 'Дата' ) }}
                                    </label>
                                    <div class="input-group date datepicker" id="datePicker">
                                        {!! html_input('text', 'published_at', (isset($item)) ? $item->published_at->format('Y-m-d') : Date::now()->format('Y-m-d'), ['class' => 'form-control', 'id' => 'published_at']) !!}
                                        <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- Image -->
                                <div class="fieldBlocks @isset($fields) @if( ! array_key_exists('image', $fields) ) hidden @endif @endisset">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Загрузки' ) }}
                                    </h6>
                                    <!-- End Title -->

                                        <!-- File -->
                                        <p class="card-description">
                                            {{ __( 'Изображение' ) }}
                                        </p>
                                        <input
                                                type="file"
                                                id="imageUpload"
                                                name="image"
                                                class="border"
                                                data-max-file-size="3M"
                                                data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                                @isset( $item )
                                                data-default-file="{{ ($item->image) ? url('storage' . '/images/blocks/' . $item->image) : '' }}"
                                                @endisset
                                        />
                                        <!-- End File -->


                                    <hr>

                                </div>
                                <!-- End Image -->

                                <!-- Video -->
                                <div class="fieldBlocks @isset($fields) @if( ! array_key_exists('video', $fields) ) hidden @endif @endisset">

                                    <!-- Title -->
                                    <h6 class="card-title pt-3">
                                        {{ __( 'Видео' ) }}
                                    </h6>
                                    <!-- End Title -->



                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="video">
                                                {{ __( 'Ссылка на видео' ) }}
                                            </label>
                                            {!! html_input('text', 'video', (isset($item)) ? $item->video : '', ['class' => 'form-control', 'id' => 'video']) !!}
                                        </div>
                                        <!-- end form group -->

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="videotitle">
                                                {{ __( 'Заголовок видео' ) }}
                                            </label>
                                            {!! html_input('text', 'videotitle', (isset($item)) ? $item->videotitle : '', ['class' => 'form-control', 'id' => 'videotitle']) !!}
                                        </div>
                                        <!-- end form group -->

                                        <!-- File -->
                                        <p class="card-description">
                                            {{ __( 'Постер для видео' ) }}
                                        </p>
                                        <input
                                                type="file"
                                                id="videoPoster"
                                                name="videoposter"
                                                class="border"
                                                data-max-file-size="3M"
                                                data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                                @isset( $item )
                                                data-default-file="{{ ($item->videoposter) ? url('storage' . '/images/blocks/' . $item->videoposter) : '' }}"
                                                @endisset
                                        />
                                        <!-- End File -->

                                </div>
                                <!-- End Video -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Row -->

            </form>
            <!-- End Form -->

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection

@push( 'custom-scripts' )

    <script>
        $(function() {
            'use strict';

            /**
             * Hidden and Show Fields
             */
            $(document).on('change', '.selectTemplate', function (e)
            {

                let option = $('option:selected', $(this)).attr('data-fields')

                $( '.fieldBlocks' ).addClass('hidden')

                if( option.length )
                {

                    let fields = JSON.parse(option)

                    if( fields.length )
                    {
                        $.each(fields,function(index, value)
                        {

                            console.log('Индекс: ' + index + '; Значение: ' + value);

                            $('.blocksForm').find('[name="' + value + '"]').parent().removeClass('hidden')
                            $('.blocksForm').find('[name="' + value + '"]').parent().parent().removeClass('hidden')


                        });

                    }

                }else{

                    $( '.fieldBlocks' ).removeClass('hidden')

                }

            })

        });
    </script>

@endpush
