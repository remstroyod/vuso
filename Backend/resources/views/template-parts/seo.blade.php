<!-- Form -->
<form action="{{ $route }}" method="post" enctype="multipart/form-data">
@csrf

{!! html_hidden('seo_id', ($model->seo_id) ?? 0) !!}
{!! html_hidden('id', ($model->id) ?? 0) !!}

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
            <label for="h1">
              {{ __( 'Заголовок на странице' ) }} H1
            </label>
            {!! html_input('text', 'h1', ($model->seo->{'h1'}) ?? '', ['class' => 'form-control', 'id' => 'h1']) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group">
            <label for="title">
              {{ __( 'Meta Title' ) }}
            </label>
            {!! html_input('text', 'title', ($model->seo->title) ?? '', ['class' => 'form-control', 'id' => 'title']) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group">
            <label for="keyword">
              {{ __( 'Meta Keyword' ) }}
            </label>
            {!! html_input('text', 'keyword', ($model->seo->keyword) ?? '', ['class' => 'form-control', 'id' => 'keyword']) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group">
            <label for="description">
              {{ __( 'Meta Description' ) }}
            </label>
            {!! html_textarea('description', ($model->seo->description) ?? '', ['class' => 'form-control', 'id' => 'description', 'rows' => 5]) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group">
            <label for="text">
              {{ __( 'SEO Текст' ) }}
            </label>
            {!! html_textarea('text', ($model->seo->text) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
          </div>
          <!-- end form group -->
          <!-- fieldset -->
          <fieldset>
            <button type="submit" class="btn btn-primary">
              {{ __( 'Сохранить' ) }}
            </button>

            @isset( $model->page )

              @if( isset($constructor) )

                <a href="{{ route('constructor.edit', ['pages' => $model->page]) }}" type="button" class="btn btn-secondary">
                  {{ __( 'Отмена' ) }}
                </a>

              @elseif( isset($static_page) )

                <a href="{{ route('static-pages.edit', ['pages' => $model->page, 'id' => 'edit']) }}" type="button" class="btn btn-secondary">
                  {{ __( 'Отмена' ) }}
                </a>

              @else

                <a href="{{ route($model->page . '.edit') }}" type="button" class="btn btn-secondary">
                  {{ __( 'Отмена' ) }}
                </a>

              @endif

            @endisset

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

          <!-- form group -->
          <div class="form-check form-check-flat form-check-primary mb-4">

            <label class="form-check-label">
              {!! html_hidden('robots', 0) !!}
              {!! html_checkbox('robots', (isset($model->seo->robots)) ? $model->seo->robots : 0, ['class' => 'form-check-input', 'value' => 1]) !!}
              {{ __( 'Индексировать страницу' ) }}
              <i class="input-frame"></i>
            </label>

          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-check form-check-flat form-check-primary mb-4">

            <label class="form-check-label">
              {!! html_hidden('text_active', 0) !!}
              {!! html_checkbox('text_active', (isset($model->seo->text_active)) ? $model->seo->text_active : 0, ['class' => 'form-check-input', 'value' => 1]) !!}
              {{ __( 'Показать блок с текстом' ) }}
              <i class="input-frame"></i>
            </label>

          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group mb-5">
            <label for="canonical">
              {{ __( 'Canonical URL' ) }}
            </label>
            {!! html_input('text', 'canonical', ($model->seo->canonical) ?? '', ['class' => 'form-control', 'id' => 'canonical']) !!}
          </div>
          <!-- end form group -->

          <!-- Title -->
          <h6 class="card-title">
            {{ __( 'Изображение' ) }}
          </h6>
          <!-- End Title -->

          <!-- Margin -->
          <div class="mb-5">

            <!-- Image -->
            <p class="card-description">
              {{ __( 'OGG' ) }}
            </p>
            <input
                    type="file"
                    id="imageUpload"
                    name="image"
                    class="border"
                    data-max-file-size="3M"
                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                      data-default-file="{{ isset($model->seo->image) ? url('storage' . '/images/seo/' . $model->seo->image) : '' }}"
            />
            <!-- End Image -->

          </div>
          <!-- End Margin -->

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
