@extends('layouts.app')

@section('content')

    @php( $title = __( 'Промокоды' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'ecommerce' => [
                    'title'     => __( 'E-commerce' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'promocodes' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
                ],
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin stretch-card">

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <!-- headpanel -->
                    <div class="card-body-headpanel">

                        <!-- Title -->
                        <h6 class="card-title">
                            {{ __( 'Записи' ) }}
                        </h6>
                        <!-- End Title -->

                        @permission('ecommerce_promocodes_create')
                        <a href="{{ route('ecommerce.promocodes.create') }}" type="button" class="btn btn-primary">
                            {{ __( 'Создать запись' ) }}
                        </a>
                        @endpermission

                    </div>
                    <!-- end headpanel -->

                    @include('template-parts.message')

                    @if( count($items) <> 0 )
                    <!-- Table Responsive -->
                        <div class="table-responsive pt-3">
                            <!-- Table -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        {{ __( 'Имя' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Промокод' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Скидка' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Статус' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Истекает' ) }}
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $item)

                                    <tr>

                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->code }}
                                        </td>
                                        <td>
                                            {{ $item->reward }} {{ $item->data->reward_type == 'fixed' ? 'грн.' : '%' }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->getStatusClass() }}">
                                                {{ $item->getStatus() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->expires_at)
                                                {{$item->expires_at->format('d.m.Y')}}
                                            @else
                                                {{ __( 'Бессрочный' ) }}
                                            @endif
                                        </td>
                                        <td>

                                            <!-- group btn -->
                                            <div class="d-flex">

                                                @permission('ecommerce_promocodes_destroy')
                                                    <form
                                                            action="{{ route('ecommerce.promocodes.destroy', $item) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Вы уверены?')"
                                                            class="mr-2"
                                                    >
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                    </form>
                                                @endpermission

                                                @permission('ecommerce_promocodes_update')
                                                    <a href="{{ route('ecommerce.promocodes.edit', $item) }}" class="btn btn-primary btn-xs">
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
