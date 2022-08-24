@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'edocuments' => [
                'title'     => __( 'EDocuments' ),
                'url'       => '',
                'active'    => true,
            ],
            'edocuments-docs' => [
                'title'     => __( 'Документы' ),
                'url'       => route('edocuments.index'),
                'active'    => false
            ],
            'edocuments-docs-form' => [
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

            @includeWhen($model->id, 'EDocuments::tabs', ['model' => $model])

            <!-- Form -->
            <form
                    action="{{ route(($model->id ? 'edocuments.update' : 'edocuments.store'), $model) }}"
                    method="post"
                    enctype="multipart/form-data"
                    class="EDocumentsForm"
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

                                <!-- panel -->
                                <div class="mb-4">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Тип документа' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    @if( count($extensions) )
                                        <div class="d-flex align-items-center justify-content-between">

                                            <!-- tabs -->
                                            <div
                                                    class="btn-group btn-group-toggle nav nav-tabs template-extension-tabs d-inline-flex"
                                                    id="template-extension-tab"
                                                    role="tablist"
                                                    data-toggle="buttons"
                                            >

                                                @foreach( $extensions as $key => $extension )

                                                    @if($model->extension)
                                                        @if($model->extension === $key)
                                                            @php($class_active = 'active')
                                                            @php($checked = ['checked' => ''])
                                                        @else
                                                            @php($class_active = '')
                                                            @php($checked = [])
                                                        @endif
                                                    @else
                                                        @if( $loop->iteration === 1 )
                                                            @php($class_active = 'active')
                                                            @php($checked = ['checked' => ''])
                                                        @else
                                                            @php($class_active = '')
                                                            @php($checked = [])
                                                        @endif
                                                    @endif

                                                    <label
                                                            class="btn btn-lg btn-primary {{ $class_active }} changeExtensionTemplate"
                                                            data-toggle="tab"
                                                            role="tab"
                                                            aria-controls="template-{{ $loop->iteration }}"
                                                            aria-selected="false"
                                                            target="#template-{{ $loop->iteration }}"
                                                            href="#template-{{ $loop->iteration }}"
                                                            data-id="{{ $key }}"
                                                    >
                                                        {!! html_radio('extension_option[]', 0, ['class' => 'form-check-input'] + $checked) !!}
                                                        <small>{{ $extension }}</small>
                                                    </label>
                                                @endforeach

                                                {!! html_hidden('extension', ($model->extension) ? $model->extension : 1, ['class' => 'input-extension form-check-input']) !!}

                                            </div>
                                            <!-- end tabs -->

                                            <!-- preview -->
                                            <div>

                                                <a class="btn btn-lg btn-outline-primary edocumentsBtnPlaceholders" @if( $model->id && $model->extension <> $extension_rule->pdf) style="display: none" @endif href="javascript:;" role="button">
                                                    <small>{{ __( 'Placeholders' ) }}</small>
                                                </a>

                                            </div>
                                            <!-- end preview -->

                                        </div>
                                    @endif

                                    <hr>

                                </div>
                                <!-- end panel -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Шаблон' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- content -->
                                <div
                                        class="tab-content edocuments__tabs"
                                        id="template-content"
                                >

                                    @foreach( $extensions as $key => $extension )

                                        @if($model->extension)
                                            @if($model->extension === $key)
                                                @php($class_active = 'show active')
                                            @else
                                                @php($class_active = '')
                                            @endif
                                        @else
                                            @if( $loop->iteration === 1 )
                                                @php($class_active = 'show active')
                                            @else
                                                @php($class_active = '')
                                            @endif
                                        @endif

                                        <!-- Pane -->
                                        <div
                                                class="tab-pane fade {{ $class_active }}"
                                                id="template-{{ $loop->iteration }}"
                                                role="tabpanel"
                                                aria-labelledby="template-{{ $loop->iteration }}"
                                        >

                                            @switch($key)

                                                {{--PDF документ--}}
                                                @case($extension_rule->pdf)

                                                    <!-- form group -->
                                                    <div class="form-group">

                                                        <!-- Real Textarea -->
                                                        <div class="hidden">
                                                            {!! html_textarea('template', ($model->template) ?? '', ['class' => 'EDocumentsHtmlTextarea']) !!}
                                                        </div>
                                                        <!-- End Real Textarea -->

                                                        <!-- Editor -->
                                                        <div class="ui-widget-header ace-editor w-100" id="edocuments_html_editor">{{(trim($model->template)) ?? ''}}</div>
                                                        <!-- End Editor -->

                                                    </div>
                                                    <!-- end form group -->

                                                    @if( $model->id )

                                                        <!-- Information -->
                                                        <div class="alert alert-warning mt-4" role="alert">

                                                            {{ __( 'Важно знать, что перед просмотром документа, его необходимо сохранить.' ) }}

                                                        </div>
                                                        <!-- End Information -->

                                                        <!-- Btn Group -->
                                                        <div class="d-flex">

                                                            <a
                                                                    class="btn btn-lg btn-secondary btn-icon-text edocumentsBtnPreview"
                                                                    href="{{ route('edocuments.preview', ['extension' => 'pdf', 'document' => $model]) }}"
                                                                    role="button"
                                                                    target="_blank"
                                                                    style="margin-right: 10px"
                                                            >
                                                                <i class="btn-icon-prepend" data-feather="eye"></i>
                                                                <small>{{ __( 'Посмотреть .pdf' ) }}</small>
                                                            </a>

                                                            <a href="javascript:;" class="btn btn-lg btn-primary edocumentsTriggerSubmit">
                                                                <small>{{ __( 'Сохранить' ) }}</small>
                                                            </a>

                                                        </div>
                                                        <!-- End Btn Group -->

                                                    @endif

                                                    @break

                                                {{--DOC документ--}}
                                                @case($extension_rule->doc)

                                                    <input
                                                            type="file"
                                                            id="templateDocUpload"
                                                            name="input_file"
                                                            class="border"
                                                            data-show-loader="true"
                                                            data-max-file-size="30M"
                                                            data-allowed-file-extensions="docx"
                                                            data-default-file="{{ ($model->file) ? url('storage' . '/files/modules/edocuments/docx/' . $model->filename) : '' }}"
                                                    />

                                                    @if( count($placeholders) )

                                                        <!-- Informations -->
                                                        <div class="pt-5">

                                                            <!-- Title -->
                                                            <h6 class="card-title">
                                                                {{ __( 'Информация' ) }}
                                                            </h6>
                                                            <!-- End Title -->

                                                            <p class="card-description">
                                                                {{ __( 'Перед загрузкой документа, Вам необходимо в самом документе, в нужных местах, проставить плейсхолдеры. Плейсхолдеры, это самозаменяемые значения, которые в процессе формирования документа, будут преобразованы в реальные данные клиента. Ниже предоставлен полный список доступных плейсхолдеров.' ) }}
                                                            </p>

                                                        </div>
                                                        <!-- End Informations -->

                                                        <!-- List -->
                                                        <ul class="list-unstyled d-flex flex-wrap edocuments__type-placeholders-list">

                                                            @foreach( $placeholders as $placeholder )
                                                                <li>
                                                                    <span class="badge badge-info">{{ '${' . $placeholder->slug . '}' }}</span>
                                                                </li>
                                                            @endforeach

                                                            @if( count($systems_placeholders) )
                                                                @foreach( $systems_placeholders as $placeholder )
                                                                    <li>
                                                                        <span class="badge badge-info">{{ '${' . $placeholder->slug . '}' }}</span>
                                                                    </li>
                                                                @endforeach
                                                            @endif

                                                        </ul>
                                                        <!-- End List -->

                                                        <!-- description -->
                                                        <p class="card-description">
                                                            {{ __( 'Также, еще, Вы можете в специальном разделе добавить свои плейсхолдеры. Добавить плейсхолдеры можно в этом разделе: ' ) }} <a href="{{ route('edocuments.placeholders.index') }}">{{ __( 'Плейсхолдеры' ) }}</a>
                                                        </p>
                                                        <!-- end description -->

                                                    @endif

                                                    @if( $model->id )

                                                        <!-- Information -->
                                                        <div class="alert alert-warning mt-4" role="alert">

                                                            {{ __( 'Важно знать, что перед просмотром документа, его необходимо сохранить.' ) }}

                                                        </div>
                                                        <!-- End Information -->

                                                        <!-- Btn Group -->
                                                        <div class="d-flex">

                                                            <a
                                                                    class="btn btn-lg btn-secondary btn-icon-text edocumentsBtnPreview"
                                                                    href="{{ route('edocuments.preview', ['extension' => 'docx', 'document' => $model]) }}"
                                                                    role="button"
                                                                    target="_blank"
                                                                    style="margin-right: 10px"
                                                            >
                                                                <i class="btn-icon-prepend" data-feather="eye"></i>
                                                                <small>{{ __( 'Посмотреть .docx' ) }}</small>
                                                            </a>

                                                            <a href="javascript:;" class="btn btn-lg btn-primary edocumentsTriggerSubmit">
                                                                <small>{{ __( 'Сохранить' ) }}</small>
                                                            </a>

                                                        </div>
                                                        <!-- End Btn Group -->

                                                    @endif

                                                    @break

                                                @default

                                            @endswitch

                                        </div>
                                        <!-- End Pane -->

                                    @endforeach

                                </div>
                                <!-- end content -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-lg-4 grid-margin stretch-card">

                        <!-- Placeholders card -->
                        <div class="card edocuments__placeholders hidden edocumentsListPlaceholders">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- inner -->
                                <div class="edocuments__placeholders-inner">

                                    <!-- Headpanel -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <!-- Title -->
                                        <h6 class="card-title mb-0">
                                            {{ __( 'Плейсхолдеры' ) }}
                                        </h6>
                                        <!-- End Title -->

                                        <a href="javascript:;" class="edocuments__placeholders-close edocumentsBtnPlaceholders">
                                            <span aria-hidden="true" class="close">×</span>
                                        </a>

                                    </div>
                                    <!-- End Headpanel -->

                                    @if( count($placeholders) )

                                            <!-- description -->
                                            <p class="card-description">
                                                {{ __( 'Перетащите нужный плейсхолдер в документ.' ) }}
                                            </p>
                                            <!-- end description -->

                                            <!-- List -->
                                            <div>

                                                <!-- list -->
                                                <ul class="list-unstyled d-flex flex-wrap edocuments__placeholders-list edocumentsPlaceholdersList">

                                                    @foreach( $placeholders as $placeholder)
                                                    <li>
                                                        <button
                                                                type="button"
                                                                class="btn btn btn-light btnDraggable"
                                                                data-paceholder="{{ '${' . $placeholder->slug . '}' }}"
                                                                draggable=true
                                                        >
                                                            {{ $placeholder->name }}
                                                        </button>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                                <!-- end list -->

                                            </div>
                                            <!-- End List -->

                                            <!-- description -->
                                            <p class="card-description">
                                                {{ __( 'Это предустановленный набор плейсхолдеров, по умолчанию. Вы можете в шаблоне указывать свои плейсхолдеры в формате: ${example_placeholder}. Важно знать, что, все плейсхолдеры должны быть на латиннице и без пробелов. Также, еще, Вы можете создать свои плейсхолдеры в специальном разделе: ' ) }} <a href="{{ route('edocuments.placeholders.index') }}">{{ __( 'Плейсхолдеры' ) }}</a>
                                            </p>
                                            <!-- end description -->

                                        @endif

                                    @if( count($systems_placeholders) )

                                        <!-- Title -->
                                        <h6 class="card-title mb-3 pt-2">
                                            {{ __( 'Системные плейсхолдеры' ) }}
                                        </h6>
                                        <!-- End Title -->

                                        <!-- List -->
                                        <ul class="list-unstyled d-flex flex-wrap edocuments__placeholders-list">

                                            @foreach( $systems_placeholders as $placeholder )

                                                <li>
                                                    <button
                                                            type="button"
                                                            class="btn btn btn-light btnDraggable"
                                                            data-paceholder="{{ '${' . $placeholder->slug . '}' }}"
                                                            draggable=true
                                                    >
                                                        {{ $placeholder->name }}
                                                    </button>
                                                </li>

                                            @endforeach

                                        </ul>
                                        <!-- End List -->

                                    @endif

                                </div>
                                <!-- end inner -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end Placeholders card -->

                        <!-- General card -->
                        <div class="card edocumentsGeneralPanel">

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
                                    @error('name')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="documents_id">
                                        {{ __( 'Тип документа' ) }}
                                    </label>
                                    {!! html_select('documents_id', $model->documents_id, ['0' => __( 'Тип документа' )] + list_data($types), ['class' => 'custom-select', 'id' => 'documents_id']) !!}
                                    @error('name')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Описание' ) }}
                                    </label>
                                {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control', 'id'=>'description', 'rows' => 8]) !!}

                                <!-- description -->
                                    <p class="card-description pt-2">
                                        {{ __( 'Опишите кратко ваш документ. Это необязательный параметр.' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', $model->is_active, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('edocuments.index') }}" type="button" class="btn btn-secondary">
                                        {{ __( 'Отмена' ) }}
                                    </a>

                                </fieldset>
                                <!-- end fieldset -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end General card -->

                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Row -->

            </form>
            <!-- End Form -->

        </div>
        <!-- End Col -->

        @if( $model->id )
            <!-- Col Images List -->
            <div class="col-lg-12 grid-margin stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title">
                            {{ __( 'Изображения' ) }}
                        </h4>
                        <!-- End Title -->

                        @if( $images->count() )

                            <!-- responsive -->
                            <div class="table-responsive">

                                <!-- table -->
                                <table class="table table-striped">
                                    <thead>

                                    <tr>
                                        <th>
                                            {{ __( 'Превью' ) }}
                                        </th>
                                        <th>
                                            {{ __( 'Наименование' ) }}
                                        </th>
                                        <th>

                                        </th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                    @foreach( $images as $image )

                                        <tr>
                                            <td class="py-1">

                                                @if ( Storage::disk('public')->exists('images/modules/edocuments/images/' . $image->image) )
                                                    <img
                                                            src="{{ $image->getThumbnail() }}"
                                                            class="img-fluid"
                                                    >
                                                @else
                                                    <img src="https://via.placeholder.com/36x36" alt="image">
                                                @endif

                                            </td>
                                            <td>
                                                {{ $image->name }}
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-primary btn-xs copyUrl" data-url="{{ settings('site_url') }}/storage/images/modules/edocuments/images/{{ $image->image }}">
                                                    {{ __( 'Копировать URL' ) }}
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>
                                <!-- end table -->

                            </div>
                            <!-- end responsive -->

                        @else

                            <!-- Message -->
                            <div class="alert alert-warning" role="alert">
                                {{ __( 'Список пуст' ) }}
                            </div>
                            <!-- End Message -->

                        @endif

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- End Col Images List -->
        @endif

    </div>
    <!-- End Row -->

@endsection

@include( 'EDocuments::template-parts.script' )
