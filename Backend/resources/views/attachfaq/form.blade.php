@extends('layouts.app')

@section('content')

    @php( $title = __( 'Вопросы и ответы' ) )

    @if( request()->routeIs('attach.faq.form') )

        @include('template-parts.breadcrumbs', [
                'breadcrumbsList' => [
                    'pages' => [
                        'title'     => $model->name,
                        'url'       => ($model->type == 3) ? route('static-pages.edit', $model) : route($model->page . '.edit'),
                        'active'    => false,
                    ],
                    'pages-faq-form' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ]
                ]
            ])

    @elseif( request()->routeIs('attach.faq.catalog.category.form') )

        @include('template-parts.breadcrumbs', [
                'breadcrumbsList' => [
                    'catalog' => [
                        'title'     => ($model->page === 'b2b') ? __( 'Каталог B2B' ) : __( 'Каталог' ),
                        'url'       => route($model->page . '.edit'),
                        'active'    => false,
                    ],
                    'categories' => [
                        'title'     => __( 'Категории' ),
                        'url'       => route($model->page . '.categories.index'),
                        'active'    => false,
                    ],
                    'category' => [
                        'title'     => $category->name,
                        'url'       => route($model->page . '.categories.edit', ['category' => $category]),
                        'active'    => false,
                    ],
                    'pages-faq-form' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ]
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

            @if( request()->routeIs('attach.faq.form') )

                @if( $model->page === 'b2b' )
                    @includeWhen($model, 'pages.catalog.tabs', ['pages' => $model])
                @else
                    @includeWhen($model, 'pages.' . (($model->type == 3) ? 'static-pages' : $model->page) . '.tabs', ['pages' => $model])
                @endif

            @elseif( request()->routeIs('attach.faq.catalog.category.form') )

                @includeWhen($model, 'pages.catalog.categories.tabs', ['pages' => $model, 'category' => $category])

            @endif

            <!-- Form -->
            <form
                    @if( request()->routeIs('attach.faq.form') )
                        action="{{ route('attach.faq.update', ['page' => $model]) }}"
                    @elseif( request()->routeIs('attach.faq.catalog.category.form') )
                        action="{{ route('attach.faq.catalog.category.update', ['page' => $model, 'category' => $category]) }}"
                    @endif
                    method="post"
                    enctype="multipart/form-data"
            >
            @csrf

                <!-- stretch -->
                <div class="stretch-card">

                    <!-- card -->
                    <div class="card">

                        <!-- card-body -->
                        <div class="card-body">

                            <h6 class="card-title">
                                {{ __( 'Записи' ) }}
                            </h6>

                            <p class="card-description">
                                {{ __( 'Прикрепите к странице необходимые записи' ) }} {{ __( 'Создать записи вы можете здесь' ) }}: <a href="{{ route('faq.list.index') }}">{{ __( 'Вопросы и ответы' ) }}</a>
                            </p>

                            <!-- form group -->
                            <div class="form-group">

                                {!! html_select('faqs[]', $items, list_data($faqs), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'faqs']) !!}

                            </div>
                            <!-- end form group -->

                            <!-- form group -->
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ ($model->type == 3) ? route('static-pages.edit', $model) : route($model->page . '.edit') }}" type="button" class="btn btn-secondary">
                                    {{ __( 'Отмена' ) }}
                                </a>

                            </div>
                            <!-- end form group -->

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>
                <!-- end stretch -->

            </form>
            <!-- End Form -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
