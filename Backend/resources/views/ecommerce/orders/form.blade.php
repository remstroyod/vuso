@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? __( 'Заказ №: ' ) . $model->order_id : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'orders' => [
                'title'     => __( 'Заказы' ),
                'url'       => route('ecommerce.order.index'),
                'active'    => false
            ],
            'orders-form' => [
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

            @includeWhen($model->id, 'ecommerce.orders.tabs', ['model' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'ecommerce.order.update' : 'ecommerce.order.store'), $model) }}" method="post" enctype="multipart/form-data">
            @csrf

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
                                    {{ __( 'Информация о заказе' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive mb-5">

                                    <!-- table -->
                                    <table class="table table-dark">

                                        <tbody>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Номер заказа' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    {{ $model->order_id }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Дата заказа' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    {{ $model->published_at->format('d.m.Y') }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Клиент' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    {{ $model->user->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Сумма без скидки' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    {{ $model->subtotal }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Промокоды' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    Нет
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Скидка' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6>
                                                        {{ __( 'Сумма к оплате' ) }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    {{ $model->total }}
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Продукты' ) }}
                                </h6>
                                <!-- End Title -->

                                @if( $model->products->count() )

                                    <!-- responsive -->
                                        <div class="table-responsive">

                                            <!-- table -->
                                            <table class="table table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>
                                                        {{ __( 'Продукт' ) }}
                                                    </th>
                                                    <th>
                                                        {{ __( 'Сумма' ) }}
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>

                                                @foreach( $model->products as $product )
                                                <tr>
                                                    <td>
                                                        <h6>
                                                            {{ $product->name }}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        {{ $product->price * $product->quantity }}
                                                    </td>
                                                </tr>
                                                @endforeach

                                                </tbody>

                                            </table>
                                            <!-- end table -->

                                        </div>
                                        <!-- end responsive -->

                                @else

                                    {{ __( 'Продуктов нет' ) }}

                                @endif

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
                                    <label for="status">
                                        {{ __( 'Статус' ) }}
                                    </label>
                                    {!! html_select('status', $model->status, $status, ['class' => 'custom-select', 'id' => 'status']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-5">

                                    <!-- fieldset -->
                                    <fieldset>

                                        <button type="submit" class="btn btn-primary">
                                            {{ __( 'Сохранить' ) }}
                                        </button>

                                        <a href="{{ route('ecommerce.order.index') }}" type="button" class="btn btn-secondary">
                                            {{ __( 'Отмена' ) }}
                                        </a>

                                        <a href="{{ route('ecommerce.order.cancel', [$model->user, $model->document]) }}" type="button" class="btn btn-warning" title="Кнопка не работает">
                                            {{ __( 'Возврат' ) }}
                                        </a>

                                    </fieldset>
                                    <!-- end fieldset -->

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

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
