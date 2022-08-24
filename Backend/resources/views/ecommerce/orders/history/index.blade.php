@extends('layouts.app')

@section('content')

    @php( $title = __( 'История статусов' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'orders' => [
                'title'     => __( 'Заказы' ),
                'url'       => route('ecommerce.order.index'),
                'active'    => false
            ],
            'orders' => [
                'title'     => __( 'Заказ №: ' ) . $model->order_id,
                'url'       => route('ecommerce.order.edit', $model),
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

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                @if( isset($model->history) && $model->history->count() )

                                    <!-- responsive -->
                                        <div class="table-responsive">

                                            <!-- table -->
                                            <table class="table table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>
                                                        {{ __( 'Статус' ) }}
                                                    </th>
                                                    <th>
                                                        {{ __( 'Дата' ) }}
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>

                                                @foreach( $model->history as $item )
                                                <tr>
                                                    <td>
                                                        <span class="badge {{ $status->class($item->status) }}">
                                                            {{ $status->name($item->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ $item->published_at->format('d.m.Y H:i') }}
                                                    </td>
                                                </tr>
                                                @endforeach

                                                </tbody>

                                            </table>
                                            <!-- end table -->

                                        </div>
                                        <!-- end responsive -->

                                @else

                                    {{ __( 'Статусов нет' ) }}

                                @endif

                                <!-- fieldset -->
                                <fieldset class="pt-4">

                                    <a href="{{ route('ecommerce.order.edit', $model) }}" type="button" class="btn btn-secondary">
                                        {{ __( 'Назад' ) }}
                                    </a>

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

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Информация' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group mb-5">

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'В этом разделе хранится история статусов заказа.' ) }}
                                    </p>
                                    <!-- end description -->

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
        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
