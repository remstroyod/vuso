@extends('layouts.app')

@section('content')

    @php( $title = __( 'E-Documents' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'catalog' => [
                    'title'     => __( 'Каталог' ),
                    'url'       => route('catalog.edit'),
                    'active'    => false,
                ],
                'catalog-products' => [
                    'title'     => __( 'Продукты' ),
                    'url'       => route('catalog.products.index'),
                    'active'    => false,
                ],
                'catalog-products-product' => [
                    'title'     => $product->name,
                    'url'       => route('catalog.products.edit', $product),
                    'active'    => false,
                ],
                'catalog-products-product-edocuments' => [
                    'title'     => __( 'E-Documents' ),
                    'url'       => '',
                    'active'    => true,
                ],
            ]
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

            @includeWhen($product, 'pages.catalog.products.tabs', ['product' => $product, 'model' => $page])

            <!-- Form -->
            <form action="{{ route('catalog.edocuments.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
            @csrf

                <!-- stretch -->
                <div class="stretch-card">

                    <!-- card -->
                    <div class="card">

                        <!-- card-body -->
                        <div class="card-body">

                            <h6 class="card-title mb-2 pt-3">
                                {{ __( 'Документы' ) }}
                            </h6>

                            <p class="card-description">
                                {{ __( 'Список электронных документов, которые будут использоваться для этого продукта. Для этого, Вам необходимо, привязать к товару соответствующий документ, который предварительно добавлен в модуль.' ) }}
                                {{ __( 'Создать все необходимые документы, Вы можете в специальном разделе электронных документов: ' ) }} <a href="{{ route('edocuments.index') }}">{{ __( 'E-Documents' ) }}</a>
                            </p>

                            @if( count($documents_type) <> 0 )
                                <!-- Table Responsive -->
                                <div class="table-responsive pt-3">
                                    <!-- Table -->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="50%">
                                                {{ __( 'Тип документа' ) }}
                                            </th>
                                            <th width="300">
                                                {{ __( 'Документ' ) }}
                                            </th>
                                            <th>

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($documents_type as $item)

                                            <tr>

                                                <td class="text-wrap">

                                                    <h6>
                                                        {{ $item->name }}
                                                    </h6>

                                                    @if( !empty($item->description) )
                                                        <div class="pt-2">
                                                            <p class="card-description mb-0">
                                                                {{ strip_tags($item->description) }}
                                                            </p>
                                                        </div>
                                                    @endif

                                                </td>

                                                <td>

                                                    <!-- form group -->
                                                    <div class="form-group mb-0">

                                                        @php( $select = $product->document($item->id)->first() )

                                                        {!! html_select('document['.$item->id.']', (isset($select->id)) ? $select->id : 0, [ 0 => ($item->use === 1) ? __('Переопределить') : __('Выбрать') ] + list_data($item->documents), ['class' => 'js-example-basic-single w-100']) !!}

                                                    </div>
                                                    <!-- end form group -->

                                                </td>

                                                <td>

                                                    {{ $use->{$item->use} }}

                                                </td>

                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table -->

                                </div>
                                <!-- End Table Responsive -->
                            @else
                                <!-- Message -->
                                <div class="alert alert-warning" role="alert">
                                    {{ __( 'Список пуст' ) }}
                                </div>
                                <!-- End Message -->
                            @endif

                            <!-- form group -->
                            <div class="form-group pt-4">

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route('catalog.products.edit', $product) }}" type="button" class="btn btn-secondary">
                                    {{ __( 'Отмена' ) }}
                                </a>

                            </div>
                            <!-- end form group -->

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>
                <!-- end stretch -->

            </form>
            <!-- End Form -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
