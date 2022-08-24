@extends('layouts.app')

@section('content')

  @php( $title = __( 'Шорткоды' ) )


  @if( request()->routeIs('b2b.constructor.dinamyc.*') )

      @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
          'catalog' => [
              'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
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
            'url'       => '',
            'active'    => true
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

      @if( request()->routeIs('b2b.constructor.dinamyc.*') )

        @includeWhen($model->id, 'pages.catalog.products.tabs', ['product' => $model])

      @else

        @includeWhen($model->id, 'pages.constructor.tabs')

      @endif

    </div>
    <!-- End Col -->

    <!-- Col -->
    <div class="col-md-12 grid-margin stretch-card">

      <!-- Card -->
      <div class="card">

        <!-- Body -->
        <div class="card-body">

          <div class="card-body-headpanel">

            <!-- Title -->
            <h6 class="card-title">
              {{ __( 'Шорткоды' ) }}
            </h6>
            <!-- End Title -->

          </div>

          @if( $shortcodes->count() )

            <!-- Table Responsive -->
            <div class="table-responsive pt-3">
              <!-- Table -->
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>
                    {{ __( 'Наименование' ) }}
                  </th>
                  <th>
                    {{ __( 'Шорткод' ) }}
                  </th>
                  <th>

                  </th>
                </tr>
                </thead>
                <tbody>

                @foreach( $shortcodes as $shortcode )

                  <tr>

                    <td>
                      {{ \Backend\Enums\ConstructorDinamycEnum::$name[$shortcode->shortcode] }}
                    </td>
                    <td>
                      [{{ $shortcode->shortcode }}]
                    </td>
                    <td>

                      <!-- group btn -->
                      <div class="d-flex">

                        @if( request()->routeIs('b2b.constructor.dinamyc.*') )
                          @php( $route = route('b2b.constructor.dinamyc.shortcode.index', ['product' => $model, 'shortcode' => $shortcode->shortcode]) )
                        @else
                          @php( $route = route('constructor.dinamyc.shortcode.index', ['pages' => $model, 'shortcode' => $shortcode->shortcode]) )
                        @endif

                          <a
                                  href="{{ $route }}"
                                  class="btn btn-primary btn-xs"
                          >
                            {{ __( 'Изменить' ) }}
                          </a>

                      </div>
                      <!-- end group btn -->

                    </td>

                  </tr>

                @endforeach

                </tbody>

              </table>
              <!-- End Table -->

            </div>
            <!-- End Table Responsive -->

          @else

            {{ __( 'Шорткодов нет' ) }}

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
