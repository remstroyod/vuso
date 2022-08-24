@extends('layouts.app')

@section('content')

    @php( $title = __( 'Типы документов' ) )

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
                'edocuments-type' => [
                        'title'     => $title,
                        'url'       => '',
                        'active'    => true,
                ]
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

                    <div class="card-body-headpanel">

                        <!-- Title -->
                        <h6 class="card-title">
                            {{ $title }}
                        </h6>
                        <!-- End Title -->

                        @permission('modules_edocuments_documents_create')
                            <a href="{{ route('edocuments.type.create') }}" type="button" class="btn btn-primary">
                                {{ __( 'Создать запись' ) }}
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
                                        {{ __( 'Наименование' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Endpoint' ) }}
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
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->endpoint }}
                                        </td>
                                        <td>
                                            {{ $item->is_active ? 'Да' : 'Нет' }}
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
                                                    @if( $item->type <> $type->static )
                                                        <form
                                                                action="{{ route('edocuments.type.destroy', ['document' => $item]) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Вы уверены?')"
                                                                class="mr-2"
                                                        >
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                        </form>
                                                    @endif
                                                @endpermission

                                                @permission('modules_edocuments_documents_update')
                                                    <a href="{{ route('edocuments.type.edit', ['document' => $item]) }}" class="btn btn-primary btn-xs">
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

        <!-- Col -->
        <div class="col-md-12 grid-margin stretch-card">

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <!-- Title -->
                    <h4 class="card-title">
                        {{ __( 'Информация' ) }}
                    </h4>
                    <!-- End Title -->

                    <!-- Box -->
                    <div>
                        <ul>
                            <li>
                                {{ __( 'Endpoint - Идентификатор типа документа при запросе через API' ) }}
                            </li>
                        </ul>
                    </div>
                    <!-- End Box -->

                </div>
                <!-- End Body -->

            </div>
            <!-- End Card -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
