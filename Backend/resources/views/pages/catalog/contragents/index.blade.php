@extends('layouts.app')

@section('content')

    @php( $title = __( 'Контрагенты' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.contragents.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.contragents.*') ? route('catalog.edit') : route('b2b.edit'),
                'active'    => false
            ],
            'catalog-contragents' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
                ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-md-12">

            @include('pages.catalog.tabs')

        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-md-12 grid-margin stretch-card">

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <div class="card-body-headpanel">

                        <!-- Title -->
                        <h6 class="card-title">
                            {{ $title }}
                        </h6>
                        <!-- End Title -->

                        @permission('catalog_create')
                            <a href="{{ request()->routeIs('catalog.contragents.*') ? route('catalog.contragents.create') : route('b2b.contragents.create') }}" type="button" class="btn btn-primary">
                                {{ __( 'Создать запись' ) }}
                            </a>
                        @endpermission

                    </div>

                @if( count($items) <> 0 )
                    <!-- Table Responsive -->
                        <div class="table-responsive pt-3">
                            <!-- Table -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        {{ __( 'Код' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Наименование' ) }}
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
                                            #{{ $item->id }}
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            @if ($item->published_at)
                                                {{$item->published_at->format('d.m.Y')}}
                                            @endif
                                        </td>
                                        <td>

                                            <!-- group btn -->
                                            <div class="d-flex">

                                                @permission('catalog_destroy')
                                                <form
                                                        action="{{ request()->routeIs('catalog.contragents.*') ? route('catalog.contragents.destroy', $item) : route('b2b.contragents.destroy', $item) }}"
                                                        method="post"
                                                        onsubmit="return confirm('Вы уверены?')"
                                                        class="mr-2"
                                                >
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                </form>
                                                @endpermission

                                                @permission('catalog_update')
                                                <a href="{{ request()->routeIs('catalog.contragents.*') ? route('catalog.contragents.edit', $item) : route('b2b.contragents.edit', $item) }}" class="btn btn-primary btn-xs">
                                                    {{ __( 'Изменить' ) }}
                                                </a>
                                                @endpermission

                                            </div>
                                            <!-- end group btn -->

                                        </td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table -->

                            {{ $items->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}

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
                <!-- End Body -->

            </div>
            <!-- End Card -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
