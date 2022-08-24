@extends('layouts.app')

@section('content')

    @php( $title = isset($model) ? __( 'Промокод №: ' ) . $model->code : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'ecommerce' => [
                    'title'     => __( 'E-commerce' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'promocodes' => [
                'title'     => __( 'Промокоды' ),
                'url'       => route('ecommerce.promocodes.index'),
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

            <!-- Form -->
            <form action="{{ isset($model) ? route('ecommerce.promocodes.update', $model) : route('ecommerce.promocodes.store') }}" method="post" enctype="multipart/form-data">
            @csrf

                {!! html_hidden('reward_type', isset($model) ? $model->data->reward_type : 'percent', ['class' => 'rewardTypeInput']) !!}

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                @if( isset($model) )
                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __( 'Наименование' ) }}
                                        </label>
                                        {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                        @error('name')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- end form group -->
                                @else

                                    <!-- row -->
                                    <div class="row">

                                        <!-- Col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="name">
                                                    {{ __( 'Наименование' ) }}
                                                </label>
                                                {!! html_input('text', 'name', '', ['class' => 'form-control', 'id' => 'name']) !!}
                                                @error('name')
                                                <div class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- End Col -->

                                        <!-- Col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="amount">
                                                    {{ __( 'Кол.-во' ) }}
                                                </label>
                                                {!! html_input('text', 'amount', 1, ['class' => 'form-control', 'id' => 'amount']) !!}

                                                <p class="card-description pt-1">
                                                    <small>{{ __( 'Вы можете указать кол.-во генерируемых промокодов' ) }}</small>
                                                </p>

                                                @error('amount')
                                                <div class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror

                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- End Col -->

                                    </div>
                                    <!-- end row -->

                                @endif

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="code">
                                                {{ __( 'Код' ) }}
                                            </label>
                                            {!! html_input('text', 'code', isset($model) ? $model->code : '', ['class' => 'form-control', 'id' => 'code']) !!}
                                            <p class="card-description pt-1">
                                                <small>{{ __( 'Если оставить поле пустым, код будет сгенерирован автоматически' ) }}</small>
                                            </p>
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="expires_at">
                                                {{ __( 'Дата истечения кода' ) }}
                                            </label>
                                            <div class="input-group date datepicker" id="datePicker">
                                                {!! html_input('text', 'expires_at', isset($model) ? !empty($model->expires_at) ? $model->expires_at->format('Y-m-d') : '' : '', ['class' => 'form-control', 'id' => 'expires_at']) !!}
                                                <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                            </div>
                                            <p class="card-description pt-1">
                                                <small>{{ __( 'Укажите дату, до которой промокод будет действителен' ) }}</small>
                                            </p>
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="reward">
                                                {{ __( 'Скидка' ) }}
                                            </label>
                                            {!! html_input('text', 'reward', isset($model) ? $model->reward : 0, ['class' => 'form-control', 'id' => 'reward']) !!}
                                            @error('reward')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <label for="reward_type">
                                            {{ __( 'Тип скидки' ) }}
                                        </label>

                                        <!-- form group -->
                                        <div class="form-group">
                                            <!-- Radio -->
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    {!! html_radio('reward_type_radio[]', isset($model) ? ($model->data->reward_type == 'percent') ? true : false : true, ['class' => 'form-control rewardTypeRadio', 'checked', 'data-value' => 'percent']) !!}
                                                    {{ __( 'Процентная' ) }}
                                                </label>
                                            </div>
                                            <!-- End Radio -->

                                            <!-- Radio -->
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    {!! html_radio('reward_type_radio[]', isset($model) ? ($model->data->reward_type == 'fixed') ? true : false : false, ['class' => 'form-control rewardTypeRadio', 'data-value' => 'fixed']) !!}
                                                    {{ __( 'Фиксированная' ) }}
                                                </label>
                                            </div>
                                            <!-- End Radio -->

                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="quantity">
                                                {{ __( 'Сколько раз можно использовать промокод' ) }}
                                            </label>
                                            {!! html_input('text', 'quantity', isset($model) ? $model->quantity : 1, ['class' => 'form-control', 'id' => 'quantity']) !!}
                                            @error('quantity')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <div style="padding-top: 28px">

                                            <!-- form group -->
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    {!! html_hidden('is_disposable', 0) !!}
                                                    {!! html_checkbox('is_disposable', isset($model) ? $model->is_disposable : 0, ['class' => 'form-check-input', 'value' => 1]) !!}
                                                    {{ __( 'Это одноразовый промокод' ) }}
                                                    <i class="input-frame"></i> </label>
                                            </div>
                                            <!-- end form group -->

                                        </div>

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="products">
                                        {{ __( 'Разрешить только для продуктов' ) }}
                                    </label>
                                    {!! html_select('products[]', isset($model)? $model->products->map->id->toArray() : [], list_data($products), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'products']) !!}
                                    <p class="card-description">
                                        {{ __( 'Выберите продукты, для которых будет применен промокод' ) }}</a>
                                    </p>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Описание' ) }}
                                    </label>
                                    {!! html_textarea('description', isset($model) ? $model->description : '', ['class' => 'form-control', 'id'=>'description', 'rows' => 5]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('ecommerce.promocodes.index') }}" type="button" class="btn btn-secondary">
                                        {{ __( 'Отмена' ) }}
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
                                <div class="form-group">
                                    <label for="status">
                                        {{ __( 'Статус' ) }}
                                    </label>
                                    <div>
                                        <span class="badge {{ isset($model) ? $model->getStatusClass() : 'badge-success' }}">
                                            {{ isset($model) ? $model->getStatus() : __( 'Активный' ) }}
                                        </span>
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="uses">
                                        {{ __( 'Кол.-во использований' ) }}
                                    </label>
                                    <div>
                                        {{ isset($model) ? $model->uses : 0 }}
                                    </div>
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

@push( 'custom-scripts' )

    <script>
        $(function() {
            'use strict';

            $(document).on('change', '.rewardTypeRadio', function (e)
            {

                let $this = $(this),
                    value = $this.data('value')

                $('.rewardTypeInput').val(value)

            })

        });
    </script>

@endpush
