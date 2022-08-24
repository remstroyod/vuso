@extends('layouts.app')

@section('content')

    @php( $title = __( 'Блоки' ) )

    @if( request()->routeIs('blocks.default.index') )

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                    'page' => [
                        'title'     => $model->name,
                        'url'       => route($model->page . '.edit'),
                        'active'    => false,
                    ],
                    'blocks' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.static.index') )

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                    'static-pages' => [
                        'title'     => __( 'Статические страницы' ),
                        'url'       => route('static-pages.index'),
                        'active'    => false,
                    ],
                    'page' => [
                        'title'     => $model->name,
                        'url'       => route('static-pages.edit', $model),
                        'active'    => false,
                    ],
                    'blocks' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.catalog.category.index') )

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

            @if( request()->routeIs('blocks.default.index') )

                @if( $model->page === 'b2b' )
                    @includeWhen($model, 'pages.catalog.tabs', ['pages' => $model])
                @else
                    @includeWhen($model, 'pages.' . $model->page . '.tabs', ['pages' => $model])
                @endif

            @elseif( request()->routeIs('blocks.static.index') )

                @includeWhen($model, 'pages.static-pages.tabs', ['pages' => $model])

            @elseif( request()->routeIs('blocks.catalog.category.index') )

                @includeWhen($model, 'pages.catalog.categories.tabs', ['pages' => $model, 'category' => $category])

            @endif

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- headpanel -->
                        <div class="card-body-headpanel">

                            <!-- Title -->
                            <h6 class="card-title">
                                {{ __( 'Записи' ) }}
                            </h6>
                            <!-- End Title -->

                            @permission('pages_blocks_create')
                                @if( request()->routeIs('blocks.default.index') )
                                    <a href="{{ route('blocks.default.create', $model) }}" type="button" class="btn btn-primary">
                                        {{ __( 'Создать запись' ) }}
                                    </a>
                                @elseif( request()->routeIs('blocks.static.index') )
                                    <a href="{{ route('blocks.static.create', $model) }}" type="button" class="btn btn-primary">
                                        {{ __( 'Создать запись' ) }}
                                    </a>
                                @elseif( request()->routeIs('blocks.catalog.category.index') )
                                    <a href="{{ route('blocks.catalog.category.create', ['page' => $model, 'category' => $category]) }}" type="button" class="btn btn-primary">
                                        {{ __( 'Создать запись' ) }}
                                    </a>
                                @endif
                            @endpermission

                        </div>
                        <!-- end headpanel -->

                        @if( count($items) <> 0 )

                            <!-- Table Responsive -->
                            <div class="table-responsive pt-3">
                                <!-- Table -->
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{ __( 'Компонент' ) }}
                                        </th>
                                        <th>
                                            {{ __( 'Позиция' ) }}
                                        </th>
                                        <th>
                                            {{ __( 'Статус' ) }}
                                        </th>
                                        <th>
                                            {{ __( 'Дата' ) }}
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($items as $item)

                                        <tr>
                                            <td>
                                                {{ $item->getTemplateName() }}
                                            </td>
                                            <td>
                                                {{ $item->order }}
                                            </td>
                                            <td>
                                                @if( $item->is_active == 1 )
                                                    <span class="badge badge-success">
                                                        {{ __( 'Активный' ) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        {{ __( 'Скрытый' ) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->published_at)
                                                    {{$item->published_at->format('d.m.Y')}}
                                                @endif
                                            </td>
                                            <td>

                                                <!-- group btn -->
                                                <div class="d-flex">

                                                    @permission('pages_blocks_destroy')
                                                    <form
                                                            @if( request()->routeIs('blocks.default.index') )
                                                                action="{{ route('blocks.default.destroy', ['page' => $model, 'block' => $item]) }}"
                                                            @elseif( request()->routeIs('blocks.static.index') )
                                                                action="{{ route('blocks.static.destroy', ['page' => $model, 'block' => $item]) }}"
                                                            @elseif( request()->routeIs('blocks.catalog.category.index') )
                                                                action="{{ route('blocks.catalog.category.destroy', ['page' => $model, 'category' => $category, 'block' => $item]) }}"
                                                            @endif
                                                            method="post"
                                                            onsubmit="return confirm('Вы уверены?')"
                                                            class="mr-2"
                                                    >
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                    </form>
                                                    @endpermission

                                                    @permission('pages_blocks_update')
                                                    @if( request()->routeIs('blocks.default.index') )
                                                        <a href="{{ route('blocks.default.edit', ['page' => $model, 'block' => $item]) }}" class="btn btn-primary btn-xs">
                                                            {{ __( 'Изменить' ) }}
                                                        </a>
                                                    @elseif( request()->routeIs('blocks.static.index') )
                                                        <a href="{{ route('blocks.static.edit', ['page' => $model, 'block' => $item]) }}" class="btn btn-primary btn-xs">
                                                            {{ __( 'Изменить' ) }}
                                                        </a>
                                                    @elseif( request()->routeIs('blocks.catalog.category.index') )
                                                        <a href="{{ route('blocks.catalog.category.edit', ['page' => $model, 'category' => $category, 'block' => $item]) }}" class="btn btn-primary btn-xs">
                                                            {{ __( 'Изменить' ) }}
                                                        </a>
                                                    @endif
                                                    @endpermission

                                                </div>
                                                <!-- end group btn -->

                                            </td>

                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table -->

                            </div>
                            <!-- End Table Responsive -->

                        @else

                            <!-- Message -->
                            <div class="alert alert-warning" role="alert">
                                {{ __( 'Список пуст' ) }}
                            </div>
                            <!-- End Message -->

                        @endif

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- end stretch -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
