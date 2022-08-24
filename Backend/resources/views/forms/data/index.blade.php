@extends('layouts.app')

@section('content')

  @php( $title = __( 'Все формы' ) )

  @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'forms' => [
              'title'     => __( 'Данные форм' ),
              'url'       => '',
              'active'    => true
          ],
          'forms-data-reviews-list' => [
                  'title'     => $title,
                  'url'       => '',
                  'active'    => true,
          ],
      ],
  ])

  <!-- Row -->
  <div class="row">

    <!-- Col -->
    <div class="col-md-12 grid-margin stretch-card">

      <!-- Card -->
      <div class="card">

        <!-- Body -->
        <div class="card-body">

          <!-- form -->
          <form action="" class="row">

            <!-- col -->
            <div class="col-md-3">
              {!! html_select('type', (int)request('type', ''), ['' => __( 'Тип формы' )] + $type, ['onchange' => '$(this).closest("form").submit()']) !!}
            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-md-9">

              <!-- group -->
              <div class="input-group">
                {!! html_input('search', 'q', request('q', ''), ['class' => 'form-control']) !!}
                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="submit">
                                    {{ __( 'Найти' ) }}
                                </button>
                                </span>
              </div>
              <!-- end group -->

            </div>
            <!-- end col -->

          </form>
          <!-- end form -->

        </div>
        <!-- End Body -->

      </div>
      <!-- End Card -->

    </div>
    <!-- End Col -->

    <!-- Col -->
    <div class="col-md-12 grid-margin stretch-card">

      <!-- Card -->
      <div class="card">

        <!-- Body -->
        <div class="card-body">

          <!-- headpanel -->
          <div class="card-body-headpanel">

            <!-- Title -->
            <h6 class="card-title">
              {{ $title }}
            </h6>
            <!-- End Title -->

            <a href="#" type="button" class="btn btn-primary">
              {{ __( 'Экспорт Excel' ) }}
            </a>

          </div>
          <!-- end headpanel -->

          @if( count($items) <> 0 )
            <!-- Table Responsive -->
            <div class="table-responsive pt-3">
              <!-- Table -->
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>
                    {{ __( 'Форма' ) }}
                  </th>
                  <th>
                    {{ __( 'Имя' ) }}
                  </th>
                  <th>
                    {{ __( 'E-mail' ) }}
                  </th>
                  <th>
                    {{ __( 'Телефон' ) }}
                  </th>
                  <th>
                    {{ __( 'Дата' ) }}
                  </th>
                  <th>

                  </th>
                </tr>
                </thead>
                <tbody>

                @foreach($items as $item)

                  <tr>
                    <td>
                      {{ $item->type ? $type[$item->type] : '' }}
                    </td>
                    <td>
                      {{ $item->name }}
                    </td>
                    <td>
                      {{ $item->email }}
                    </td>
                    <td>
                      {{ $item->phone }}
                    </td>
                    <td>
                      @if ($item->published_at)
                        {{ $item->published_at->format('d.m.Y') }}
                      @endif
                    </td>
                    <td>
                      <form action="{{ route('forms.data.destroy', ['formsdata' => $item]) }}" method="post" onsubmit="return confirm('Вы уверены?')">
                        @method('delete')
                        @csrf
                        <a href="{{ route('forms.data.show', $item) }}" class="btn btn-primary btn-xs">
                          {{ __( 'Подробнее' ) }}
                        </a>
                        <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                      </form>
                    </td>

                  </tr>

                @endforeach
                </tbody>
              </table>
              <!-- End Table -->

              {{ $items->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}

            </div>
            <!-- End Table Responsive -->
        @else
          <!-- Message -->
            <div class="alert alert-warning" role="alert">
              {{ __( 'Список пуст' ) }}
            </div>
            <!-- End Message -->
          @endif

        </div>
        <!-- End Body -->

      </div>
      <!-- End Card -->

    </div>
    <!-- End Col -->

  </div>
  <!-- End Row -->

@endsection
