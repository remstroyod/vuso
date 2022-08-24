@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
      'breadcrumbsList' => [
          'forms' => [
              'title'     => __( 'Данные форм' ),
              'url'       => '',
              'active'    => true
          ],
          'forms-data-all-list' => [
                  'title'     => __( 'Все формы' ),
                  'url'       => route('forms.data.index'),
                  'active'    => false,
          ],
          'forms-data-all-show' => [
                  'title'     => $title,
                  'url'       => '',
                  'active'    => true,
          ],
      ],
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

            @include('forms.data.form', ['formsdata' => $model] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
