@extends('layouts.app')

@section('content')

    @php( $title = __( 'Тэги' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => route($page->page . '.edit'),
                'active'    => false
            ],
            'catalog-products' => [
                'title'     => __( 'Продукты' ),
                'url'       => route($page->page . '.products.index'),
                'active'    => false
            ],
            'catalog-product' => [
                'title'     => $model->name,
                'url'       => route($page->page . '.products.edit', $model),
                'active'    => false
            ],
            'catalog-products-form' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

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

            @includeWhen($model->id, 'pages.catalog.products.tabs', ['product' => $model])

            <!-- Form -->
            <form
                    action="{{ route($page->page . '.products.tags.store', ['product' => $model]) }}"
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

                            <!-- form group -->
                            <div class="form-group">

                                <label for="tag">
                                    {{ __( 'Тэги' ) }}
                                </label>

                                {!! html_select('tag[]', $model->tags->map->id->toArray(), list_data($tags), ['class' => 'js-example-basic-multiple-tags w-100', 'multiple' => 'multiple', 'id' => 'tag', 'rows' => 6]) !!}

                                <p class="card-description pt-3 mb-0">
                                    {{ __( 'Что бы создать новый тэг, введите его и нажмите Enter.' ) }}
                                </p>
                                <p class="card-description pt-0">
                                    {{ __( 'Перевод и удаление тегов доступны в следующем разделе' ) }}: <a href="{{ route('tag.index') }}">{{ __( 'Тэги' ) }}</a>
                                </p>

                                <hr>

                            </div>
                            <!-- end form group -->

                            <!-- form group -->
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route($page->page . '.products.edit', ['product' => $model]) }}" type="button" class="btn btn-secondary">
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

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
