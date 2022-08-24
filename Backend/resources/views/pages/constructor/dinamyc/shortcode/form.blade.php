@extends('layouts.app')

@section('content')

    @php( $title = ($item->id) ? $item->name : __( 'Создание записи' ) )

    @if( request()->routeIs('b2b.constructor.dinamyc.*') )

        @include('template-parts.breadcrumbs', [
          'breadcrumbsList' => [
            'catalog' => [
                'title'     => __( 'Каталог B2B' ),
                'url'       => route($page->page . '.edit'),
                'active'    => false
            ],
            'catalog-products' => [
                'title'     => __( 'Продукты' ),
                'url'       => route($page->page . '.products.index'),
                'active'    => false
            ],
            'catalog-products-form' => [
                'title'     => $model->name,
                'url'       => route('b2b.products.edit', $model),
                'active'    => false
            ],
            'constructor-dinamyc' => [
              'title'     => __( 'Шорткоды' ),
              'url'       => route('b2b.constructor.dinamyc.index', ['product' => $model]),
              'active'    => false,
          ],
          'constructor-dinamyc-shortcode' => [
                    'title'     => \Backend\Enums\ConstructorDinamycEnum::$name[request()->shortcode],
                    'url'       => route('b2b.constructor.dinamyc.shortcode.index', ['product' => $model, 'shortcode' => request()->shortcode]),
                    'active'    => false
            ],
              'constructor-dinamyc-shortcode-item' => [
                  'title'     => $title,
                  'url'       => '',
                  'active'    => true,
              ],
        ]
    ])

    @else

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'constructor' => [
                    'title'     => __( 'Конструктор' ),
                    'url'       => route('constructor.index'),
                    'active'    => false
                ],
                'constructor-general' => [
                    'title'     => $model->name,
                    'url'       => route('constructor.edit', $model),
                    'active'    => false
                ],
                'constructor-dinamyc' => [
                    'title'     => __( 'Шорткоды' ),
                    'url'       => route('constructor.dinamyc.index', $model),
                    'active'    => false
                ],
                'constructor-dinamyc-shortcode' => [
                    'title'     => \Backend\Enums\ConstructorDinamycEnum::$name[request()->shortcode],
                    'url'       => route('constructor.dinamyc.shortcode.index', ['pages' => $model, 'shortcode' => request()->shortcode]),
                    'active'    => false
                ],
                'constructor-dinamyc-shortcode-form' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true
                ],
            ],
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

            <!-- Form -->
            @if( request()->routeIs('b2b.constructor.dinamyc.*') )

                @if( $item->id )
                    @php( $route = route('b2b.constructor.dinamyc.shortcode.update', ['product' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                @else
                    @php( $route = route('b2b.constructor.dinamyc.shortcode.store', ['product' => $model, 'shortcode' => request()->shortcode]) )
                @endif

            @else

                @if( $item->id )
                    @php( $route = route('constructor.dinamyc.shortcode.update', ['pages' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                @else
                    @php( $route = route('constructor.dinamyc.shortcode.store', ['pages' => $model, 'shortcode' => request()->shortcode]) )
                @endif

            @endif

                <form action="{{ $route }}" method="post" enctype="multipart/form-data" class="ConstructorDinamycForm">
                @csrf

                    {!! html_hidden('shortcode_id', $shortcode->id) !!}

                    <!-- Row -->
                    <div class="row">

                        <!-- Col -->
                        <div class="col-lg-8 grid-margin stretch-card">

                            <!-- card -->
                            <div class="card">

                                <!-- card-body -->
                                <div class="card-body">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Основное' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- row -->
                                    <div class="row">

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="name">
                                                    {{ __( 'Наименование' ) }}
                                                </label>
                                                {!! html_input('text', 'name', $item->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                                <p class="card-description pt-1">
                                                    <small>{{ __( 'Пропишите полное наименование записи' ) }}</small>
                                                </p>
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="excerpt">
                                                    {{ __( 'Краткий текст' ) }}
                                                </label>
                                                {!! html_textarea('excerpt', ($item->excerpt) ?? '', ['class' => 'form-control', 'id' => 'excerpt', 'rows' => 10]) !!}
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="description">
                                                    {{ __( 'Полный текст' ) }}
                                                </label>
                                                {!! html_textarea('description', ($item->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'description']) !!}
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="template">
                                                    {{ __( 'Шаблон' ) }}
                                                </label>

                                                <div style="display: none">
                                                    {!! html_textarea('template', ($item->template) ?? '', ['class' => 'form-control ConstructorDinamycHtmlTextarea', 'id'=>'template']) !!}
                                                </div>

                                                <!-- Editor -->
                                                <div class="ui-widget-header ace-editor w-100" id="constructor_dinamyc_html_editor">{{(trim($item->template)) ?? ''}}</div>
                                                <!-- End Editor -->

                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- form group -->
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    {!! html_hidden('is_active', 0) !!}
                                                    {!! html_checkbox('is_active', ($item->id) ? $item->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                                                    {{ __( 'Активный' ) }}
                                                    <i class="input-frame"></i> </label>
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-12">

                                            <!-- fieldset -->
                                            <fieldset>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __( 'Сохранить' ) }}
                                                </button>

                                                @if( request()->routeIs('b2b.constructor.dinamyc.*') )
                                                    @php( $route = route('b2b.constructor.dinamyc.shortcode.index', ['product' => $model, 'shortcode' => request()->shortcode]) )
                                                @else
                                                    @php( $route = route('constructor.dinamyc.shortcode.index', ['pages' => $model, 'shortcode' => request()->shortcode]) )
                                                @endif

                                                <a href="{{ $route }}" type="button" class="btn btn-secondary">
                                                    {{ __( 'Отмена' ) }}
                                                </a>

                                            </fieldset>
                                            <!-- end fieldset -->

                                        </div>
                                        <!-- end col -->

                                    </div>
                                    <!-- end row -->

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

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Прочее' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="published_at">
                                            {{ __( 'Дата' ) }}
                                        </label>
                                        <div class="input-group date datepicker" id="datePicker">
                                            {!! html_input('text', 'published_at', ($item->id) ? $item->published_at->format('Y-m-d') : Date::now()->format('Y-m-d'), ['class' => 'form-control', 'id' => 'published_at']) !!}
                                            <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                    <!-- end form group -->

                                    <!-- form group -->
                                    <div class="form-group mb-4">
                                        <label for="source">
                                            {{ __( 'Источник' ) }}
                                        </label>
                                        {!! html_input('text', 'source', $item->source, ['class' => 'form-control', 'id' => 'source']) !!}
                                    </div>
                                    <!-- end form group -->

                                    <hr>

                                    <!-- Title -->
                                    <h6 class="card-title pt-3">
                                        {{ __( 'Ссылка №1' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="url_one">
                                            {{ __( 'Ссылка' ) }}
                                        </label>
                                        {!! html_input('text', 'url_one', $item->url_one, ['class' => 'form-control', 'id' => 'url_one']) !!}
                                    </div>
                                    <!-- end form group -->

                                    <!-- form group -->
                                    <div class="form-group mb-5">
                                        <label for="url_one_title">
                                            {{ __( 'Текст ссылки' ) }}
                                        </label>
                                        {!! html_input('text', 'url_one_title', $item->url_one_title, ['class' => 'form-control', 'id' => 'url_one_title']) !!}
                                    </div>
                                    <!-- end form group -->

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Ссылка №2' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="url_two">
                                            {{ __( 'Ссылка' ) }}
                                        </label>
                                        {!! html_input('text', 'url_two', $item->url_two, ['class' => 'form-control', 'id' => 'url_two']) !!}
                                    </div>
                                    <!-- end form group -->

                                    <!-- form group -->
                                    <div class="form-group mb-4">
                                        <label for="url_two_title">
                                            {{ __( 'Текст ссылки' ) }}
                                        </label>
                                        {!! html_input('text', 'url_two_title', $item->url_two_title, ['class' => 'form-control', 'id' => 'url_two_title']) !!}
                                    </div>
                                    <!-- end form group -->

                                    <hr>

                                    <!-- Title -->
                                    <h6 class="card-title pt-3">
                                        {{ __( 'Загрузки' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- Margin -->
                                    <div class="mb-3">

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
                                                data-default-file="{{ ($item->image) ? url('storage' . '/images/constructor/dinamyc/' . $item->image) : '' }}"
                                        />
                                        <!-- End File -->

                                    </div>
                                    <!-- End Margin -->

                                    <!-- form group -->
                                    <div class="form-group mb-5">
                                        <label for="icon">
                                            {{ __( 'Код иконки в SVG' ) }}
                                        </label>
                                        {!! html_textarea('icon', ($item->icon) ?? '', ['class' => 'form-control', 'id' => 'icon', 'rows' => 15]) !!}
                                    </div>
                                    <!-- end form group -->

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
