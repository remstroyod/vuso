@extends('layouts.app')

@section('content')

    @php( $title = __( 'Список записей' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'articles' => [
                'title'     => __( 'Новости и статьи' ),
                'url'       => route('articles.edit'),
                'active'    => false
            ],
            'articles-list' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
                ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @includeWhen($model->id, 'pages.articles.tabs', ['pages' => $model])

        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-md-12 grid-margin stretch-card">

            <!-- Card -->
            <div class="card">

                <!-- Body -->
                <div class="card-body">

                    <!-- form -->
                    <form action="" class="row">

                        <!-- col -->
                        <div class="col-md-3">
                            {!! html_select('category', (int)request('category', ''), ['' => 'Категории'] + list_data($categories, 'id', 'name'), ['onchange' => '$(this).closest("form").submit()']) !!}
                        </div>
                        <!-- end col -->

                        <!-- col -->
                        <div class="col-md-9">

                            <!-- group -->
                            <div class="input-group">
                                {!! html_input('search', 'q', request('q', ''), ['class' => 'form-control']) !!}
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="submit">
                                    {{ __( 'Найти' ) }}
                                </button>
                                </span>
                            </div>
                            <!-- end group -->

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
                            {{ $title }}
                        </h6>
                        <!-- End Title -->

                        @permission('articles_create')
                            <a href="{{ route('articles.list.create') }}" type="button" class="btn btn-primary text-nowrap">
                                {{ __( 'Создать запись' ) }}
                            </a>
                        @endpermission

                    </div>
                    <!-- end headpanel -->

                    @if( count($items) <> 0 )
                    <!-- Table Responsive -->
                        <div class="table-responsive pt-3">
                            <!-- Table -->
                            <table class="table table-bordered" id="tblLocations">
                                <thead>
                                <tr>
                                    <th>
                                        {{ __( 'Код' ) }}
                                    </th>
                                    <th width="100">
                                        {{ __( 'Картинка' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Наименование' ) }}
                                    </th>
                                    <th>
                                        {{ __( 'Позиция' ) }}
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
                                            @if ( Storage::disk('public')->exists('images/articles/' . $item->image) )
                                                <img
                                                        src="{{ $item->getThumbnail() }}"
                                                        class="img-fluid"
                                                        style="border-radius:0;width: 100%; height: auto"
                                                >
                                            @endif
                                        </td>
                                        <td class="text-wrap">
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->order }}
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

                                                @permission('articles_destroy')
                                                    <form
                                                            action="{{ route('articles.list.destroy', $item) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Вы уверены?')"
                                                            class="mr-2"
                                                    >
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">{{ __( 'Удалить' ) }}</button>
                                                    </form>
                                                @endpermission

                                                @permission('articles_update')
                                                    <a href="{{ route('articles.list.edit', $item) }}" class="btn btn-primary btn-xs">
                                                        {{ __( 'Изменить' ) }}
                                                    </a>
                                                @endpermission

                                                @if( !$item->is_banner )
                                                    <a
                                                            href="{{ $item->getFullUrl() }}"
                                                            class="btn btn-xs btn-info ml-2"
                                                            target="_blank"
                                                    >
                                                        {{ __( 'Ссылка' ) }}
                                                    </a>
                                                @endif

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

@push('custom-scripts')
    <script src="{{ asset('assets/plugins/jquery-ui-dist/jquery-ui.min.js') }}"></script>
@endpush
