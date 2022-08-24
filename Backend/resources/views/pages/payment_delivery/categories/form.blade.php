@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'payment-delivery' => [
                'title'     => __( 'Оплата и доставка' ),
                'url'       => route('payment_delivery.edit'),
                'active'    => false
            ],
            'payment-delivery-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('payment_delivery.categories.index'),
                'active'    => false
            ],
            'payment-delivery-categories-form' => [
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

            @includeWhen($model->id, 'pages.payment_delivery.categories.tabs', ['categories' => $model])

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- Form -->
                        <form action="{{ route(($model->id ? 'payment_delivery.categories.update' : 'payment_delivery.categories.store'), $model) }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <!-- row -->
                            <div class="row">

                                <!-- col -->
                                <div class="col-8">

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __( 'Наименование' ) }}
                                        </label>
                                        {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- end col -->

                                <!-- col -->
                                <div class="col-4">

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="category">
                                            {{ __( 'Категория' ) }}
                                        </label>
                                        {!! html_select('parent_id', $model->parent_id, ['' => 'Без категории'] + list_data($categories), ['class' => 'custom-select', 'id' => 'parent_id']) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- end col -->

                            </div>
                            <!-- end row -->

                            <!-- form group -->
                            <div class="form-group">
                                <label for="description">
                                    {{ __( 'Текст' ) }}
                                </label>
                                {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'description']) !!}
                            </div>
                            <!-- end form group -->

                            <!-- form group -->
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    {!! html_hidden('is_active', 0) !!}
                                    {!! html_checkbox('is_active', ($model->id) ? $model->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                                    {{ __( 'Активный' ) }}
                                    <i class="input-frame"></i> </label>
                            </div>
                            <!-- end form group -->

                            <!-- fieldset -->
                            <fieldset>
                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>
                            </fieldset>
                            <!-- end fieldset -->

                        </form>
                        <!-- End Form -->

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
