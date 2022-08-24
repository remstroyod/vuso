@extends('layouts.app')

@section('content')

    @php( $title = __( 'Адреса представительств' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
                'contacts' => [
                    'title'     => __( 'Контакты' ),
                    'url'       => route('contacts.edit', $model),
                    'active'    => false,
                ],
                'offices' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
                ]
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

            @includeWhen($model, 'pages.contacts.tabs', ['pages' => $model])

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- headpanel -->
                        <div class="card-body-headpanel">

                            <!-- Title -->
                            <h6 class="card-title">
                                {{ __( 'Записи' ) }}
                            </h6>
                            <!-- End Title -->

                            @permission('pages_create')
                                <a href="{{ route('contacts.offices.create') }}" type="button" class="btn btn-primary">
                                    {{ __( 'Создать запись' ) }}
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

                                                    @permission('pages_destroy')
                                                    <form
                                                            action="{{ route('contacts.offices.destroy', $item) }}"
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
                                                    <a href="{{ route('contacts.offices.edit', $item) }}" class="btn btn-primary btn-xs">
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
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- end stretch -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
