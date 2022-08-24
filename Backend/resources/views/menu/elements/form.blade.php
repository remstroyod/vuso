@extends('layouts.app')

@section('content')

    @php( $title = ($item->id) ? $item->title : __( 'Создание записи' ) )

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
                'title'     => __( 'Элементы' ),
                'url'       => route('menu.elements.index', $model),
                'active'    => false
            ],
            'menu-elements-form' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
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

{{--            @includeWhen($model->id, 'menu.tabs', ['menu' => $model])--}}

            <!-- Form -->
            <form
                    action="{{ route(($item->id ? 'menu.elements.update' : 'menu.elements.store'), $item->id ? ['menu' => $model, 'element' => $item] : ['menu' => $model]) }}"
                    method="post"
                    enctype="multipart/form-data"
            >
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

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __( 'Заголовок' ) }}
                                            </label>
                                            {!! html_input('text', 'title', $item->title, ['class' => 'form-control', 'id' => 'title']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="parent_id">
                                                {{ __( 'Вложенность' ) }}
                                            </label>
                                            {!! html_select('parent_id', $item->parent_id, ['' => __( 'Выбрать' )] + list_data($parents, 'id', 'title'), ['class' => 'custom-select', 'id' => 'parent_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="url">
                                        {{ __( 'Ссылка' ) }}
                                    </label>
                                    {!! html_input('text', 'url', $item->url, ['class' => 'form-control', 'id' => 'url']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="attrclass">
                                                {{ __( 'CSS: Class' ) }}
                                            </label>
                                            {!! html_input('text', 'attrclass', $item->attrclass, ['class' => 'form-control', 'id' => 'attrclass']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="attrid">
                                                {{ __( 'CSS: ID' ) }}
                                            </label>
                                            {!! html_input('text', 'attrid', $item->attrid, ['class' => 'form-control', 'id' => 'attrid']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="attrtitle">
                                                {{ __( 'CSS: Title' ) }}
                                            </label>
                                            {!! html_input('text', 'attrtitle', $item->attrtitle, ['class' => 'form-control', 'id' => 'attrtitle']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="attrtarget">
                                                {{ __( 'Attribute: target' ) }}
                                            </label>
                                            {!! html_select('attrtarget', $item->attrtarget, ['' => __( 'Выбрать' ), '_blank' => '_blank', '_self' => '_self', '_parent' => '_parent', '_top' => '_top'], ['class' => 'custom-select', 'id' => 'attrtarget']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="attrrel">
                                                {{ __( 'Attribute: rel' ) }}
                                            </label>
                                            {!! html_input('text', 'attrrel', $item->attrrel, ['class' => 'form-control', 'id' => 'attrrel']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', ($item->id) ? $item->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('menu.elements.index', $model) }}" type="button" class="btn btn-secondary">
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
                                    {!! html_input('text', 'order', ($item->id) ? $item->order : 0, ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Загрузки' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- File -->
                                    <p class="card-description">
                                        {{ __( 'Иконка' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="iconUpload"
                                            name="icon"
                                            class="border"
                                            data-max-file-size="3M"
                                            data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                            data-default-file="{{ ($item->icon) ? url('storage' . '/images/menu/' . $item->icon) : '' }}"
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

                                <!-- form group -->
                                <div class="form-group mb-5">
                                    <label for="iconsvg">
                                        {{ __( 'Код SVG иконки' ) }}
                                    </label>
                                    {!! html_textarea('iconsvg', $item->iconsvg, ['class' => 'form-control', 'id'=>'iconsvg', 'rows' => 10]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="iconposition">
                                        {{ __( 'Позиция иконки' ) }}
                                    </label>
                                    {!! html_select('iconposition', $item->iconposition, ['left' => __( 'Слева' ), 'right' => __( 'Справа' )], ['class' => 'custom-select', 'id' => 'iconposition']) !!}
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

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
