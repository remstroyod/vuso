@extends('layouts.app')

@section('content')

    @php( $title = __( 'Список записей' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'menu' => [
                'title'     => __( 'Меню' ),
                'url'       => route('menu.index'),
                'active'    => false
            ],
            'menu-form' => [
                'title'     => $model->name,
                'url'       => route('menu.edit', $model),
                'active'    => false
            ],
            'menu-elements' => [
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

            @include('template-parts.message')

            @includeWhen($model->id, 'menu.tabs', ['menu' => $model])

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

                        @permission('menu_create')
                            <a href="{{ route('menu.elements.create', ['menu' => $model]) }}" type="button" class="btn btn-primary">
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
                                            #{{ $item->id }}
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

                                                @permission('menu_destroy')
                                                <form
                                                        action="{{ route('menu.elements.destroy', ['menu' => $model, 'element' => $item]) }}"
                                                        method="post"
                                                        onsubmit="return confirm('Вы уверены?')"
                                                        class="mr-2"
                                                >
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                </form>
                                                @endpermission

                                                @permission('menu_update')
                                                <a href="{{ route('menu.elements.edit', ['menu' => $model, 'element' => $item]) }}" class="btn btn-primary btn-xs">
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
