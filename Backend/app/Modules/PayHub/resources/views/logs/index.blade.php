@extends('layouts.app')

@section('content')

  @php( $title = __( 'История' ) )

  @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'modules' => [
                  'title'     => __( 'Модули' ),
                  'url'       => '',
                  'active'    => true,
          ],
          'payhub' => [
                  'title'     => __( 'Модуль: PayHub' ),
                  'url'       => route('payhub.index'),
                  'active'    => false,
          ],
          'payhub-logs' => [
                  'title'     => $title,
                  'url'       => '',
                  'active'    => true,
          ],
      ]
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

          </div>
          <!-- end headpanel -->

          @if( $logs->count() )
            <!-- Table Responsive -->
            <div class="table-responsive pt-3">
              <!-- Table -->
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>#</th>
                  <th>
                    {{ __( 'Система' ) }}
                  </th>
                  <th>
                    {{ __( 'Дата' ) }}
                  </th>
                  <th>
                    {{ __( 'Продукт' ) }}
                  </th>
                  <th>
                    {{ __( 'Статус' ) }}
                  </th>
                  <th>
                    {{ __( 'Клиент' ) }}
                  </th>
                  <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($logs as $item)

                  <tr>
                    <td>
                      {{ $item->id }}
                    </td>
                    <td>
                      {{ $item->system->name }}
                    </td>
                    <td>
                      {{ $item->published_at->format('d.m.Y H:s') }}
                    </td>
                    <td>
                      {{ isset($item->document->product) ? $item->document->product->name : '' }}
                    </td>
                    <td>
                      @if( $item->status === \Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum::paid )
                        <span class="badge badge-success">
                                                    {{ __( 'success' ) }}
                                                </span>
                      @elseif( $item->status === \Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum::errorpaid )
                        <span class="badge badge-danger">
                                                    {{ __( 'error' ) }}
                                                </span>
                      @endif
                    </td>
                    <td>
                      {{ isset($item->document->user->detail) ? $item->document->user->detail->fullname : '' }}
                    </td>
                    <td>

                      @php( $information = '<div class="table-responsive pt-3"><table class="table table-bordered"><tbody>' )

                      @foreach( $item->request as $key => $value )
                        @php( $information .= '<tr>' )
                        @php( $information .= '<td>' . $key . '</td>' )
                        @php( $information .= '<td>' . $value . '</td>' )
                        @php( $information .= '</tr>' )
                      @endforeach

                      @php( $information .= '</tbody></table></div>' )
                      <button
                              type="button" class="btn btn-info btn-xs btn-icon"
                              onclick="showSwalPayHubLogInfo('{{ $information }}')"
                      >
                        <i data-feather="info"></i>
                      </button>
                    </td>
                  </tr>

                @endforeach
                </tbody>
              </table>
              <!-- End Table -->

              {{ $logs->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}

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

@push('custom-scripts')
  @include( 'PayHub::script' )
@endpush
