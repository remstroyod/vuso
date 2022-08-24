@extends('layouts.app')

@section('content')

  @php( $title = \Backend\Enums\ConstructorDinamycEnum::$name[request()->shortcode] )

  @if( request()->routeIs('b2b.constructor.dinamyc.*') )

    @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
        'catalog' => [
            'title'     => __( 'Каталог B2B' ),
            'url'       => route($page->page . '.edit'),
            'active'    => false
        ],
        'catalog-products' => [
            'title'     => __( 'Продукты' ),
            'url'       => route($page->page . '.products.index'),
            'active'    => false
        ],
        'catalog-products-form' => [
            'title'     => $model->name,
            'url'       => route('b2b.products.edit', $model),
            'active'    => false
        ],
        'constructor-dinamyc' => [
          'title'     => __( 'Шорткоды' ),
          'url'       => route('b2b.constructor.dinamyc.index', ['product' => $model]),
          'active'    => false,
      ],
      'constructor-dinamyc-items' => [
          'title'     => $title,
          'url'       => '',
          'active'    => true,
      ],
    ]
    ])

  @else

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'constructor' => [
                'title'     => __( 'Конструктор' ),
                'url'       => route('constructor.index'),
                'active'    => false
            ],
            'constructor-general' => [
                'title'     => $model->name,
                'url'       => route('constructor.edit', $model),
                'active'    => false
            ],
            'constructor-dinamyc' => [
                'title'     => __( 'Шорткоды' ),
                'url'       => route('constructor.dinamyc.index', $model),
                'active'    => false
            ],
            'constructor-dinamyc-shortcode' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true
            ],
        ],
    ])

  @endif

  <!-- Row -->
  <div class="row">

    <!-- Col -->
    <div class="col-md-12">

      <!-- Title -->
      <h4 class="card-title">
        {{ $title }}
      </h4>
      <!-- End Title -->

      @include('template-parts.message')

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
            <h6 class="card-title mb-3">
              {{ __( 'Шорткод' ) }}
            </h6>
            <!-- End Title -->

          </div>
          <!-- end headpanel -->

          <!-- form -->
          @if( request()->routeIs('b2b.constructor.dinamyc.*') )
            @php( $route = route('b2b.constructor.shortcode.update', ['product' => $model, 'pages' => $page, 'shortcode' => request()->shortcode]) )
          @else
            @php( $route = route('constructor.shortcode.update', ['pages' => $model, 'shortcode' => request()->shortcode]) )
          @endif
          <form method="post" action="{{ $route }}" class="row">
            @csrf

            <!-- col -->
            <div class="col-md-4">

              <!-- form group -->
              <div class="form-group">
                <label for="title">
                  {{ __( 'Title' ) }}
                </label>
                {!! html_input('text', 'title', isset($shortcode->title) ? $shortcode->title : '', ['class' => 'form-control', 'id' => 'title']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-md-4">

              <!-- form group -->
              <div class="form-group">
                <label for="subtitle">
                  {{ __( 'Subtitle' ) }}
                </label>
                {!! html_input('text', 'subtitle', isset($shortcode->subtitle) ? $shortcode->subtitle : '', ['class' => 'form-control', 'id' => 'subtitle']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-md-2">

              <!-- form group -->
              <div class="form-group">
                <label for="limit">
                  {{ __( 'Limit' ) }}
                </label>
                {!! html_input('text', 'limit', isset($shortcode->limit) ? $shortcode->limit : '', ['class' => 'form-control', 'id' => 'limit']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-md-2">

              <!-- form group -->
              <div class="form-group">

                <label for="save">
                  {{ __( 'Save' ) }}
                </label>
                <button type="submit" class="btn btn-primary btn-block" id="save">
                  {{ __( 'Сохранить' ) }}
                </button>

              </div>
              <!-- end form group -->

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
              {{ __( 'Элементы' ) }}
            </h6>
            <!-- End Title -->

            @permission('constructor_create')

              @if( request()->routeIs('b2b.constructor.dinamyc.*') )
                @php( $route = route('b2b.constructor.dinamyc.shortcode.create', ['product' => $model, 'shortcode' => request()->shortcode]) )
              @else
                @php( $route = route('constructor.dinamyc.shortcode.create', ['pages' => $model, 'shortcode' => request()->shortcode]) )
              @endif

              <a href="{{ $route }}" type="button" class="btn btn-primary text-nowrap">
                {{ __( 'Создать запись' ) }}
              </a>

            @endpermission

          </div>
          <!-- end headpanel -->

          @if( $items->count() )
            <!-- Table Responsive -->
            <div class="table-responsive pt-3">
              <!-- Table -->
              <table class="table table-bordered" id="tblLocations">
                <thead>
                <tr>
                  <th>
                    {{ __( 'Код' ) }}
                  </th>
                  <th>
                    {{ __( 'Наименование' ) }}
                  </th>
                  <th>
                    {{ __( 'Статус' ) }}
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
                      #{{ $item->id }}
                    </td>
                    <td class="text-wrap">
                      {{ $item->name }}
                    </td>
                    <td>
                      @if( $item->is_active == 1 )
                        <span class="badge badge-success">
                                                        {{ __( 'Активный' ) }}
                                                    </span>
                      @else
                        <span class="badge badge-secondary">
                                                        {{ __( 'Скрытый' ) }}
                                                    </span>
                      @endif
                    </td>
                    <td>
                      @if ($item->published_at)
                        {{$item->published_at->format('d.m.Y')}}
                      @endif
                    </td>
                    <td>

                      <!-- group btn -->
                      <div class="d-flex">

                        @permission('catalog_destroy')

                          @if( request()->routeIs('b2b.constructor.dinamyc.*') )
                            @php( $route = route('b2b.constructor.dinamyc.shortcode.destroy', ['product' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                          @else
                            @php( $route = route('constructor.dinamyc.shortcode.destroy', ['pages' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                          @endif

                          <form
                                  action="{{ $route }}"
                                  method="post"
                                  onsubmit="return confirm('Вы уверены?')"
                                  class="mr-2"
                          >
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                          </form>

                        @endpermission

                        @permission('catalog_update')

                          @if( request()->routeIs('b2b.constructor.dinamyc.*') )
                            @php( $route = route('b2b.constructor.dinamyc.shortcode.edit', ['product' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                          @else
                            @php( $route = route('constructor.dinamyc.shortcode.edit', ['pages' => $model, 'shortcode' => request()->shortcode, 'item' => $item]) )
                          @endif
                          <a href="{{ $route }}" class="btn btn-primary btn-xs">
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
