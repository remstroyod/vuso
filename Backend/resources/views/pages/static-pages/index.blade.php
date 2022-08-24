@extends('layouts.app')

@section('content')

  @php( $title = __( 'Список страниц' ) )

  @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'static-pages' => [
              'title'     => __( 'Статические страницы' ),
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

            @permission('pages_create')
              <a href="{{ route('static-pages.create') }}" type="button" class="btn btn-primary">
                {{ __( 'Новая страница' ) }}
              </a>
            @endpermission

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
                      @php( $url = $item->getPreviewUrl() )
                      <a href="{{ $url }}" target="_blank">{{ $url }}</a>
                    </td>
                    <td>
                      {{ $item->published_at->format('d.m.Y') }}
                    </td>
                    <td>

                      @if ( array_key_exists($item->page, $type) )

                        @permission('pages_update')
                          <a href="{{ route($item->page . '.edit') }}" class="btn btn-primary btn-xs">
                            {{ __( 'Изменить' ) }}
                          </a>
                        @endpermission

                      @else

                        <!-- group btn -->
                        <div class="d-flex">

                          @permission('pages_destroy')
                            <form
                                    action="{{ route('static-pages.destroy', $item) }}"
                                    method="post"
                                    onsubmit="return confirm('Вы уверены?')"
                                    class="mr-2"
                            >
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                            </form>
                          @endpermission

                          @permission('pages_update')
                            <a href="{{ route('static-pages.edit', $item) }}" class="btn btn-primary btn-xs">
                              {{ __( 'Изменить' ) }}
                            </a>
                          @endpermission

                        </div>
                        <!-- end group btn -->

                      @endif

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
