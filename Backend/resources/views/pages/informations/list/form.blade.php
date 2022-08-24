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
            'informations-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('informations.list.index'),
                'active'    => false
            ],
            'informations-list-form' => [
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

            @includeWhen($model->id, 'pages.informations.list.tabs', ['informations' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'informations.list.update' : 'informations.list.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                    {!! html_textarea('name', $model->name, ['class' => 'form-control', 'id'=>'name', 'rows' => 5]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="file">
                                        {{ __( 'Ссылка на файл' ) }}
                                    </label>
                                    {!! html_input('text', 'file', $model->file, ['class' => 'form-control', 'id' => 'file']) !!}
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

                                    <a href="{{ route('informations.list.index') }}" type="button" class="btn btn-secondary">
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

                                <ul class="list-unstyled" style="padding-left: 20px">
                                    @foreach( $categories as $category )

                                        <li>

                                            <div class="form-check">
                                                <input
                                                        type="radio"
                                                        id="category-{{ $category->id }}"
                                                        name="category_id"
                                                        value="{{ $category->id }}"
                                                        @if( $model->category_id == $category->id ) checked @endif
                                                        class="form-check-input"
                                                >
                                                <label for="category-{{ $category->id }}" class="mb-0">{{ $category->name }}</label>
                                            </div>
                                            @if(count($category->subcategory))
                                                @include('pages.informations.categories.subcategory-list',['subcategories' => $category->subcategory, 'model' => $model])
                                            @endif
                                        </li>

                                    @endforeach
                                </ul>

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

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
