@extends('layouts.app')

@section('content')

    @php( $title = __( 'Элементы блока ' ) . $block->getTemplateName() )

    @if( request()->routeIs('blocks.default.elements.index') )

        @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                    'page' => [
                        'title'     => $model->name,
                        'url'       => route($model->page . '.edit'),
                        'active'    => false,
                    ],
                    'blocks' => [
                        'title'     => __( 'Блоки' ),
                        'url'       => route('blocks.default.index', $model),
                        'active'    => false,
                    ],
                    'elements' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.static.elements.index') )

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
                        'title'     => __( 'Блоки' ),
                        'url'       => route('blocks.static.index', $model),
                        'active'    => false,
                    ],
                    'blockss' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                    ],
            ]
        ])

    @elseif( request()->routeIs('blocks.catalog.category.elements.index') )

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
                    'url'       => route('blocks.catalog.category.index', ['page' => $model, 'category' => $category]),
                    'active'    => false,
                ],
                'elements' => [
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

            @includeWhen($block->id, 'blocks.tabs', ['page' => $model, 'block' => $block])

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
                                @if( request()->routeIs('blocks.default.elements.index') )
                                    <a href="{{ route('blocks.default.elements.create', ['page' => $model, 'block' => $block]) }}" type="button" class="btn btn-primary">
                                        {{ __( 'Создать запись' ) }}
                                    </a>
                                @elseif( request()->routeIs('blocks.static.elements.index') )
                                    <a href="{{ route('blocks.static.elements.create', ['page' => $model, 'block' => $block]) }}" type="button" class="btn btn-primary">
                                        {{ __( 'Создать запись' ) }}
                                    </a>
                                @elseif( request()->routeIs('blocks.catalog.category.elements.index') )
                                    <a href="{{ route('blocks.catalog.category.elements.create', ['page' => $model, 'category' => $category, 'block' => $block]) }}" type="button" class="btn btn-primary">
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
                                            {{ __( 'Заголовок' ) }}
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
                                                {{ $item->title }}
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
                                                            @if( request()->routeIs('blocks.default.elements.index') )
                                                                action="{{ route('blocks.default.elements.destroy', ['page' => $model, 'block' => $block, 'element' => $item]) }}"
                                                            @elseif( request()->routeIs('blocks.static.elements.index') )
                                                                action="{{ route('blocks.static.elements.destroy', ['page' => $model, 'block' => $block, 'element' => $item]) }}"
                                                            @elseif( request()->routeIs('blocks.catalog.category.elements.index') )
                                                                action="{{ route('blocks.catalog.category.elements.destroy', ['page' => $model, 'category' => $category, 'block' => $block, 'element' => $item]) }}"
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
                                                    @if( request()->routeIs('blocks.default.elements.index') )
                                                        <a href="{{ route('blocks.default.elements.edit', ['page' => $model, 'block' => $block, 'element' => $item]) }}" class="btn btn-primary btn-xs">
                                                            {{ __( 'Изменить' ) }}
                                                        </a>
                                                    @elseif( request()->routeIs('blocks.static.elements.index') )
                                                        <a href="{{ route('blocks.static.elements.edit', ['page' => $model, 'block' => $block, 'element' => $item]) }}" class="btn btn-primary btn-xs">
                                                            {{ __( 'Изменить' ) }}
                                                        </a>
                                                    @elseif( request()->routeIs('blocks.catalog.category.elements.index') )
                                                        <a href="{{ route('blocks.catalog.category.elements.edit', ['page' => $model, 'category' => $category, 'block' => $block, 'element' => $item]) }}" class="btn btn-primary btn-xs">
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
