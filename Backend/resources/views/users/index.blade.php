@extends('layouts.app')

@section('content')

  @php( $title = __( 'Пользователи' ) )

  @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'users' => [
              'title'     => __( 'Пользователи' ),
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

            @permission('users_create')
              <a href="{{ route('users.list.create') }}" type="button" class="btn btn-primary">
                {{ __( 'Добавить пользователя' ) }}
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
                  <th width="75">
                    {{ __( 'Статус' ) }}
                  </th>
                  <th>
                    {{ __( 'Логин' ) }}
                  </th>
                  <th>
                    {{ __( 'E-mail' ) }}
                  </th>
                  <th>
                    {{ __( 'Роль' ) }}
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
                      @if( $item->isOnline() )
                        <span class="badge badge-success">Online</span>
                      @else
                        <span class="badge badge-secondary">Offline</span>
                      @endif
                    </td>
                    <td>
                      {{ $item->name }}
                    </td>
                    <td>
                      {{ $item->email }}
                    </td>
                    <td>
                      {{ ($item->roles()->first()) ? $item->roles()->first()->name : '' }}
                    </td>
                    <td>

                      <!-- group btn -->
                      <div class="d-flex">

                        @permission('users_destroy')
                          <form
                                  action="{{ route('users.list.destroy', ['user' => $item]) }}"
                                  method="post"
                                  onsubmit="return confirm('Вы уверены?')"
                                  class="mr-2"
                          >
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                          </form>
                        @endpermission

                        @permission('users_update')
                          <a href="{{ route('users.list.edit', ['user' => $item]) }}" class="btn btn-primary btn-xs">
                            {{ __( 'Изменить' ) }}
                          </a>
                        @endpermission

                      </div>
                      <!-- end group btn -->

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
