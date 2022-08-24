@extends('layouts.app')

@section('content')

  @php( $title = __( 'Конструктор страниц' ) )

  @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'constructor' => [
              'title'     => __( 'Конструктор' ),
              'url'       => '',
              'active'    => true
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

          <!-- headpanel -->
          <div class="card-body-headpanel">

            <!-- Title -->
            <h6 class="card-title">
              {{ $title }}
            </h6>
            <!-- End Title -->

            <a href="{{ route('constructor.create') }}" type="button" class="btn btn-primary">
              {{ __( 'Новая страница' ) }}
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
                    {{ __( 'Код' ) }}
                  </th>
                  <th>
                    {{ __( 'Наименование' ) }}
                  </th>
                  <th>
                    {{ __( 'URL' ) }}
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
                      {{ $item->id }}
                    </td>
                    <td>
                      {{ $item->name }}
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                      <a href="{{ $item->getPreviewUrl() }}" target="_blank">{{ $item->getPreviewUrl() }}</a>
                    </td>
                    <td>
                      {{ $item->published_at->format('d.m.Y') }}
                    </td>
                    <td>
                      <form action="{{ route('constructor.destroy', $item) }}" method="post" onsubmit="return confirm('Вы уверены?')">
                        @method('delete')
                        @csrf
                        <a href="{{ route('constructor.edit', $item) }}" class="btn btn-primary btn-xs">
                          {{ __( 'Изменить' ) }}
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
