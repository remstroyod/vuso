@extends('layouts.app')

@section('content')

    @php( $title = (isset($item)) ? __( 'Элементы блока: редактирование' ) : __( 'Элементы блока: создание записи' ) )

    @if( request()->routeIs('blocks.default.elements.*') )

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
                    'elements' => [
                      'title'     => __( 'Элементы' ),
                        'url'       => route('blocks.default.elements.index', ['page' => $page, 'block' => $block]),
                        'active'    => false,
                    ],
                    'element' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.static.elements.*') )

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                    'static-pages' => [
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
                        'url'       => route('blocks.static.index', $page),
                        'active'    => false,
                    ],
                    'elements' => [
                      'title'     => __( 'Элементы' ),
                        'url'       => route('blocks.static.elements.index', ['page' => $page, 'block' => $block]),
                        'active'    => false,
                    ],
                    'element' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.catalog.category.elements.*') )

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'catalog' => [
                    'title'     => __( 'Каталог' ),
                    'url'       => route('catalog.edit'),
                    'active'    => false,
                ],
                'categories' => [
                    'title'     => __( 'Категории' ),
                    'url'       => route('catalog.categories.index'),
                    'active'    => false,
                ],
                'category' => [
                    'title'     => $category->name,
                    'url'       => route('catalog.categories.edit', ['category' => $category]),
                    'active'    => false,
                ],
                'blocks' => [
                        'title'     => __( 'Блоки' ),
                        'url'       => route('blocks.catalog.category.index', ['page' => 'catalog', 'category' => $category]),
                        'active'    => false,
                ],
                'elements' => [
                        'title'     => __( 'Элементы' ),
                        'url'       => route('blocks.catalog.category.elements.index', ['page' => 'catalog', 'category' => $category, 'block' => $block]),
                        'active'    => false,
                ],
                'element' => [
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
                    @if( request()->routeIs('blocks.default.elements.*') )
                        action="{{ route(((isset($item)) ? 'blocks.default.elements.update' : 'blocks.default.elements.store'), isset($item) ? ['page' => $page, 'block' => $block, 'element' => $item] : ['page' => $page, 'block' => $block]) }}"
                    @elseif( request()->routeIs('blocks.static.elements.*') )
                        action="{{ route(((isset($item)) ? 'blocks.static.elements.update' : 'blocks.static.elements.store'), isset($item) ? ['page' => $page, 'block' => $block, 'element' => $item] : ['page' => $page, 'block' => $block]) }}"
                    @elseif( request()->routeIs('blocks.catalog.category.elements.*') )
                        action="{{ route(((isset($item)) ? 'blocks.catalog.category.elements.update' : 'blocks.catalog.category.elements.store'), isset($item) ? ['page' => $page, 'category' => $category, 'block' => $block, 'element' => $item] : ['page' => $page, 'category' => $category, 'block' => $block]) }}"
                    @endif
                    method="post"
                    enctype="multipart/form-data"
            >
            @csrf

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __( 'Заголовок' ) }}
                                            </label>
                                            {!! html_input('text', 'title', (isset($item)) ? $item->title : '', ['class' => 'form-control', 'id' => 'title']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="subtitle">
                                                {{ __( 'Заголовок второго уровня' ) }}
                                            </label>
                                            {!! html_input('text', 'subtitle', (isset($item)) ? $item->subtitle : '', ['class' => 'form-control', 'id' => 'subtitle']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="link">
                                                {{ __( 'Ссылка' ) }}
                                            </label>
                                            {!! html_input('text', 'link', (isset($item)) ? $item->link : '', ['class' => 'form-control', 'id' => 'link']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="linktext">
                                                {{ __( 'Текст ссылки' ) }}
                                            </label>
                                            {!! html_input('text', 'linktext', (isset($item)) ? $item->linktext : '', ['class' => 'form-control', 'id' => 'linktext']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="excerpt">
                                        {{ __( 'Отрывок' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', (isset($item)) ? $item->excerpt : '', ['class' => 'form-control', 'id'=>'excerpt', 'rows' => 7]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Текст' ) }}
                                    </label>
                                    {!! html_textarea('description', (isset($item)) ? $item->description : '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
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

                                    @if( request()->routeIs('blocks.default.elements.*') )
                                        <a href="{{ route('blocks.default.elements.index', ['page' => $page, 'block' => $block]) }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>
                                    @elseif( request()->routeIs('blocks.static.elements.*') )
                                        <a href="{{ route('blocks.static.elements.index', ['page' => $page, 'block' => $block]) }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>
                                    @elseif( request()->routeIs('blocks.catalog.category.elements.*') )
                                        <a href="{{ route('blocks.catalog.category.elements.index', ['page' => $page, 'category' => $category, 'block' => $block]) }}" type="button" class="btn btn-secondary">
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
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($item)) ? $item->order : 0, ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-5">
                                    <label for="published_at">
                                        {{ __( 'Дата' ) }}
                                    </label>
                                    <div class="input-group date datepicker" id="datePicker">
                                        {!! html_input('text', 'published_at', (isset($item)) ? $item->published_at->format('Y-m-d') : Date::now()->format('Y-m-d'), ['class' => 'form-control', 'id' => 'published_at']) !!}
                                        <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Загрузки' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

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
                                            data-default-file="{{ ($item->image) ? url('storage' . '/images/blocks/elements/' . $item->image) : '' }}"
                                            @endisset
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- File -->
                                    <p class="card-description">
                                        {{ __( 'Иконка' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="iconUpload"
                                            name="icon"
                                            class="border"
                                            data-max-file-size="3M"
                                            data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                            @isset( $item )
                                            data-default-file="{{ ($item->icon) ? url('storage' . '/images/blocks/elements/' . $item->icon) : '' }}"
                                            @endisset
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

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
