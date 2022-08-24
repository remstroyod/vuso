@extends('layouts.app')

@section('content')

    @php( $title = __( 'Список документов' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'edocuments' => [
                    'title'     => 'EDocuments',
                    'url'       => '',
                    'active'    => true,
            ],
            'edocuments-docs' => [
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
                            <a href="{{ route('edocuments.create') }}" type="button" class="btn btn-primary">
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
                                        {{ __( 'Тип' ) }}
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
                                            {{ $extensions[$item->extension] }}
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

                                                @permission('modules_edocuments_documents_destroy')
                                                    <form
                                                            action="{{ route('edocuments.destroy', ['document' => $item]) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Вы уверены?')"
                                                            class="mr-2"
                                                    >
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                    </form>
                                                @endpermission

                                                @permission('modules_edocuments_documents_update')
                                                    <a href="{{ route('edocuments.edit', ['document' => $item]) }}" class="btn btn-primary btn-xs">
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

    </div>
    <!-- End Row -->

@endsection
