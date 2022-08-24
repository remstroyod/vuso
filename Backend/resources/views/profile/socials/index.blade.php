@extends('layouts.app')

@section('content')

    @php( $title = __( 'Социальные сети' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'profile' => [
                'title'     => __( 'Профиль' ),
                'url'       => route('users.profile.index'),
                'active'    => false
            ],
            'profile-general' => [
                'title'     => __( 'Основное' ),
                'url'       => route('users.profile.edit'),
                'active'    => false
            ],
            'profile-socials' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
                ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('profile.tabs')

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <div class="card-body-headpanel mb-0 pb-0">

                        <!-- Title -->
                        <h6 class="card-title mb-0">
                            {{ __( 'Мои социальные сети' ) }}
                        </h6>
                        <!-- End Title -->

                        <a href="{{ route('users.profile.socials.create') }}" type="button" class="btn btn-primary">
                            {{ __( 'Создать запись' ) }}
                        </a>

                    </div>

                @if( count($items) <> 0 )
                    <!-- Table Responsive -->
                        <div class="table-responsive pt-3">
                            <!-- Table -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        {{ __( 'Иконка' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Наименование' ) }}
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $item)

                                    <tr>

                                        <td>

                                            <!-- icon -->
                                            <span class="btn d-flex align-items-center justify-content-center btn-icon {{ $item->image }}">
                                                <i data-feather="{{ $item->image }}" data-toggle="tooltip" title="{{ $item->name }}"></i>
                                            </span>
                                            <!-- end icon -->

                                        </td>
                                        <td>

                                            @if( empty($item->url) )

                                                {{ $item->name }}

                                            @else

                                                <a href="{{ $item->url }}" target="_blank">
                                                    {{ $item->name }}
                                                </a>

                                            @endif

                                        </td>
                                        <td>
                                            <form action="{{ route('users.profile.socials.destroy', ['socials' => $item]) }}" method="post" onsubmit="return confirm('Вы уверены?')">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('users.profile.socials.edit', ['socials' => $item]) }}" class="btn btn-primary btn-xs">
                                                    {{ __( 'Изменить' ) }}
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                            </form>
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
