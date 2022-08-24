<!-- Form -->
@if( isset($pages) )
  <form action="{{ route($route, ['pages' => $pages]) }}" method="post" enctype="multipart/form-data" class="pagesForm">
    @else
      <form action="{{ route($route, ['page' => $page]) }}" method="post" enctype="multipart/form-data" class="pagesForm">
      @endif

      @csrf

        @isset( $page_type )
          {!! html_hidden('type', $page_type) !!}
        @endisset

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

                  <!-- Col -->
                  <div class="col-lg-7">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="name">
                        {{ __( 'Наименование' ) }}
                      </label>
                      {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                      @error('name')
                      <label id="name-error" class="error mt-2 text-danger" for="name">
                        {{ __( 'Обязательное поле' ) }}
                      </label>
                      @enderror
                    </div>
                    <!-- end form group -->

                  </div>
                  <!-- End Col -->

                  <!-- Col -->
                  <div class="col-lg-5">

                    <!-- form group -->
                    <div class="form-group">
                      <label for="parent_id">
                        {{ __( 'Вложенность' ) }}
                      </label>
                      {!! html_select('parent_id', ($model->parent_id) ? $model->parent_id : request()->parent_id, ['' => __( 'Выбрать страницу' )] + list_data($parents), ['class' => 'custom-select', 'id' => 'parent_id']) !!}
                    </div>
                    <!-- end form group -->

                  </div>
                  <!-- End Col -->

                </div>
                <!-- end row -->

                @if( isset($type) )

                  @if ( array_key_exists($model->page, $type) )

                    @include( 'template-parts.pages-general-form-default' )

                  @else

                      <!-- list -->
                      <ul class="nav nav-tabs nav-tabs-line" id="tabListPagesTemplate" role="tablist">

                        <li class="nav-item">

                          <a
                                  class="nav-link @if( $model->is_template == 0 ) active @endif"
                                  id="content-default-tab"
                                  data-toggle="tab"
                                  href="#content-default"
                                  role="tab"
                                  aria-controls="home"
                                  aria-selected="true"
                                  data-type="0"
                          >
                            {{ __( 'По умолчанию' ) }}
                          </a>

                        </li>

                        <li class="nav-item">

                          <a
                                  class="nav-link @if( $model->is_template == 1 ) active @endif"
                                  id="content-template-tab"
                                  data-toggle="tab"
                                  href="#content-template"
                                  role="tab"
                                  aria-controls="profile"
                                  aria-selected="false"
                                  data-type="1"
                          >
                            {{ __( 'Шаблон' ) }}
                          </a>

                        </li>

                      </ul>
                      <!-- end list -->

                      <!-- content -->
                      <div class="tab-content mt-3" id="tabContent">

                        <!-- tab -->
                        <div
                                class="tab-pane fade @if( $model->is_template == 0 ) show active @endif"
                                id="content-default"
                                role="tabpanel"
                                aria-labelledby="content-default-tab"
                        >

                          @include( 'template-parts.pages-general-form-default' )

                        </div>
                        <!-- end tab -->

                        <!-- tab -->
                        <div
                                class="tab-pane fade @if( $model->is_template == 1 ) show active @endif"
                                id="content-template"
                                role="tabpanel"
                                aria-labelledby="content-template-tab"
                        >

                          <!-- Real Textarea -->
                          <div class="hidden">
                            {!! html_textarea('content', isset($template) ? $template : '', ['class' => 'PagesHtmlTextarea']) !!}
                          </div>
                          <!-- End Real Textarea -->

                          <!-- Editor -->
                          <div class="ui-widget-header ace-editor w-100" id="pages_html_editor">{{(isset($template)) ? $template : ''}}</div>
                          <!-- End Editor -->

                        </div>
                        <!-- end end tab -->

                      </div>
                      <!-- end content -->

                  @endif

                @else

                  @include( 'template-parts.pages-general-form-default' )

                @endif

                {!! html_hidden('is_template', ($model->id) ? $model->is_template : 0, ['class' => 'pageTemplate']) !!}

                <!-- fieldset -->
                <fieldset class="pt-3">
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

              @if( $model->id )

                  <!-- Title -->
                  <h6 class="card-title">
                    {{ __( 'Информация' ) }}
                  </h6>
                  <!-- End Title -->

                  <!-- form group -->
                  <div class="form-group mb-5">
                    <label for="slug">
                      {{ __( 'Ссылка на сайте' ) }}
                    </label>

                    <div>
                      @php( $url = $model->getPreviewUrl() )
                      <a href="{{ $url }}" target="_blank">
                        {{ $url }}
                      </a>
                    </div>

                  </div>
                  <!-- end form group -->

                    <hr>

              @endif

              <!-- Title -->
                <h6 class="card-title">
                  {{ __( 'Изображение' ) }}
                </h6>
                <!-- End Title -->

                <!-- Margin -->
                <div class="mb-5">

                  <!-- Image -->
                  <p class="card-description">
                    {{ __( 'Основное изображение' ) }}
                  </p>
                  <input
                          type="file"
                          id="imageUpload"
                          name="image"
                          class="border"
                          data-max-file-size="3M"
                          data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                          data-default-file="{{ ($model->image) ? url('storage' . '/images/pages/' . $model->image) : '' }}"
                  />
                  <!-- End Image -->

                </div>
                <!-- End Margin -->

                <hr>

                <!-- Title -->
                <h6 class="card-title">
                  {{ __( 'Видео' ) }}
                </h6>
                <!-- End Title -->

                <!-- form group -->
                <div class="form-group">
                  <label for="video">
                    {{ __( 'Ссылка на видео' ) }}
                  </label>
                  {!! html_input('text', 'video', $model->video, ['class' => 'form-control', 'id' => 'video']) !!}
                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-group mb-5">
                  <!-- Image -->
                  <p class="card-description">
                    {{ __( 'Постер для видео' ) }}
                  </p>
                  <input
                          type="file"
                          id="videoPoster"
                          name="video_poster"
                          class="border"
                          data-max-file-size="3M"
                          data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                          data-default-file="{{ ($model->video_poster) ? url('storage' . '/images/pages/' . $model->video_poster) : '' }}"
                  />
                  <!-- End Image -->
                </div>
                <!-- end form group -->

                <hr>

                <!-- Title -->
                <h4 class="card-title">
                  {{ __( 'Настройки' ) }}
                </h4>
                <!-- End Title -->

                <!-- form group -->
                <div class="form-check form-check-flat form-check-primary mb-4">

                  <label class="form-check-label">
                    {!! html_hidden('is_active', 0) !!}
                    {!! html_checkbox('is_active', ($model->id) ? $model->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                    {{ __( 'Активный' ) }}
                    <i class="input-frame"></i> </label>

                  <!-- description -->
                  <p class="card-description">
                    {{ __( 'Уберите галочку, если хотите деактивировать эту запись' ) }}
                  </p>
                  <!-- end description -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-check form-check-flat form-check-primary mb-4">

                  <label class="form-check-label">
                    {!! html_hidden('is_header', 0) !!}
                    {!! html_checkbox('is_header', $model->is_header, ['class' => 'form-check-input', 'value' => 1]) !!}
                    {{ __( 'Header' ) }}
                    <i class="input-frame"></i>
                  </label>

                  <!-- description -->
                  <p class="card-description">
                    {{ __( 'Снимите галочку, если Вы хотите отключить Header на этой странице' ) }}
                  </p>
                  <!-- end description -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-check form-check-flat form-check-primary mb-4">

                  <label class="form-check-label">
                    {!! html_hidden('is_footer', 0) !!}
                    {!! html_checkbox('is_footer', $model->is_footer, ['class' => 'form-check-input', 'value' => 1]) !!}
                    {{ __( 'Footer' ) }}
                    <i class="input-frame"></i>
                  </label>

                  <!-- description -->
                  <p class="card-description">
                    {{ __( 'Снимите галочку, если Вы хотите отключить Footer на этой странице' ) }}
                  </p>
                  <!-- end description -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-check form-check-flat form-check-primary mb-4">

                  <label class="form-check-label">
                    {!! html_hidden('is_breadcrumbs', 0) !!}
                    {!! html_checkbox('is_breadcrumbs', $model->is_breadcrumbs, ['class' => 'form-check-input', 'value' => 1]) !!}
                    {{ __( 'Хлебные крошки' ) }}
                    <i class="input-frame"></i>
                  </label>

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
