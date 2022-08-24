@extends('layouts.app')

@section('content')

    @php( $title = __( 'Изображения' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
                ],
                'edocuments' => [
                    'title'     => __( 'EDocuments' ),
                    'url'       => '',
                    'active'    => true,
                ],
                'edocuments-docs' => [
                    'title'     => __( 'Документы' ),
                    'url'       => route('edocuments.index'),
                    'active'    => false
                ],
                'edocuments-docs-form' => [
                    'title'     => $document->name,
                    'url'       => route('edocuments.edit', $document),
                    'active'    => false
                ],
                'edocuments-docs-form-images' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true
                ]
            ]
        ])

    @include('template-parts.message')

    @include('EDocuments::tabs', ['model' => $document])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin stretch-card">

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <div class="card-body-headpanel">

                        <!-- Title -->
                        <h6 class="card-title">
                            {{ $title }}
                        </h6>
                        <!-- End Title -->

                        @permission('modules_edocuments_documents_create')
                            <a href="{{ route('edocuments.images.create', $document) }}" type="button" class="btn btn-primary">
                                {{ __( 'Добавить изображение' ) }}
                            </a>
                        @endpermission

                    </div>

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
                                        {{ __( 'Превью' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Наименование' ) }}
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
                                        <td class="py-1">

                                            @if ( Storage::disk('public')->exists('images/modules/edocuments/images/' . $item->image) )
                                                <img
                                                        src="{{ $item->getThumbnail() }}"
                                                        class="img-fluid"
                                                >
                                            @else
                                                <img src="https://via.placeholder.com/36x36" alt="image">
                                            @endif

                                        </td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            @if ($item->published_at)
                                                {{$item->published_at->format('d.m.Y')}}
                                            @endif
                                        </td>
                                        <td>

                                            <!-- group btn -->
                                            <div class="d-flex">

                                                @permission('modules_edocuments_type_destroy')

                                                        <form
                                                                action="{{ route('edocuments.images.destroy', ['document' => $document, 'image' => $item]) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Вы уверены?')"
                                                                class="mr-2"
                                                        >
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                        </form>

                                                @endpermission

                                                <a href="javascript:;" class="btn btn-primary btn-xs copyUrl" data-url="{{ settings('site_url') }}/storage/images/modules/edocuments/images/{{ $item->image }}">
                                                    {{ __( 'Копировать URL' ) }}
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

@include( 'EDocuments::template-parts.script' )
