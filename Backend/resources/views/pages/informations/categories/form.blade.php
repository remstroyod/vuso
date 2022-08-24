@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'informations' => [
                'title'     => __( 'Информация' ),
                'url'       => route('informations.edit'),
                'active'    => false
            ],
            'informations-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('informations.categories.index'),
                'active'    => false
            ],
            'informations-categories-form' => [
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

            @includeWhen($model->id, 'pages.informations.categories.tabs', ['categories' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'informations.categories.update' : 'informations.categories.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                    {{ __( 'Основное' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="name">
                                        {{ __( 'Наименование' ) }}
                                    </label>
                                    {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                                <!-- end form group -->

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
                                <div class="form-group mb-5">
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($model->order)) ? $model->order : '', ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title mb-3">
                                    {{ __( 'Категория' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group">

                                    <ul class="list-unstyled" style="padding-left: 20px">
                                        <li>

                                            <div class="form-check">
                                                <input
                                                        type="radio"
                                                        id="category-0"
                                                        name="parent_id"
                                                        value=""
                                                        @if( is_null($model->parent_id)) checked @endif
                                                        class="form-check-input"
                                                >
                                                <label for="category-0" class="mb-0">{{ __( 'Родительская' ) }}</label>
                                            </div>
                                        </li>
                                        @foreach( $categories as $category )

                                            @if( $model->id <> $category->id )
                                                <li>

                                                    <div class="form-check">
                                                        <input
                                                                type="radio"
                                                                id="category-{{ $category->id }}"
                                                                name="parent_id"
                                                                value="{{ $category->id }}"
                                                                @if( $model->parent_id == $category->id ) checked @endif
                                                                class="form-check-input"
                                                        >
                                                        <label for="category-{{ $category->id }}" class="mb-0">{{ $category->name }}</label>
                                                    </div>
                                                    @if(count($category->subcategory))
                                                        @include('pages.informations.categories.subcategory',['subcategories' => $category->subcategory, 'model' => $model])
                                                    @endif
                                                </li>
                                            @endif

                                        @endforeach
                                    </ul>

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
