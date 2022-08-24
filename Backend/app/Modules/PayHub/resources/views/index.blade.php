@extends('layouts.app')

@section('content')

    @php( $title = __( 'PayHub' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'payhub' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
            ],
        ]
    ])

    <!-- Headpanel -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

        <!-- title -->
        <div>
            <h4 class="mb-3 mb-md-0">
                {{ $title }}
            </h4>
        </div>
        <!-- End title -->

    </div>
    <!-- End Headpanel -->

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">

            <!-- card -->
            <div class="card">

                <!-- body -->
                <div class="card-body">

                    <!-- header -->
                    <div class="d-flex justify-content-between align-items-baseline mb-2">

                        <!-- title -->
                        <h6 class="card-title mb-3">
                            {{ __( 'Оплаченные' ) }}
                        </h6>
                        <!-- end title -->

                    </div>
                    <!-- end header -->

                    <!-- content -->
                    <div class="d-flex flex-column">

                        @if( $paid->count() )

                            @foreach( $paid as $pay )

                                <!-- item -->
                                <div class="d-flex align-items-center border-bottom @if( $loop->iteration > 1 ) py-3 @else pb-3 @endif">

                                    <!-- image -->
                                    <div class="mr-3 wd-35 d-flex rounded-circle" style="background-color: #453F9B; height: 35px; align-items: center;justify-content: center">
                                        {!! $pay->document->product->icon_svg !!}
                                    </div>
                                    <!-- end image -->

                                    <!-- content -->
                                    <div class="w-100">

                                        <!-- header -->
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">
                                                {{ $pay->document->product->name }}
                                            </h6>
                                            <p class="text-muted tx-12">
                                                {{ $pay->published_at->format('d в H:i') }}
                                            </p>
                                        </div>
                                        <!-- end header -->

                                        <!-- content -->
                                        <p class="text-muted tx-13">
                                            {{ isset($pay->document->user->detail->fullname) ? $pay->document->user->detail->fullname : '' }}
                                        </p>
                                        <!-- end content -->

                                    </div>
                                    <!-- end content -->

                                </div>
                                <!-- end item -->

                            @endforeach

{{--                                <a href="#" type="button" class="btn btn-primary">--}}
{{--                                    {{ __( 'Смотреть все' ) }}--}}
{{--                                </a>--}}

                        @else

                            {{ __( 'Записей нет' ) }}

                        @endif

                    </div>
                    <!-- end content -->

                </div>
                <!-- end body -->

            </div>
            <!-- end card -->

        </div>
        <!-- end col -->

        <!-- col -->
        <div class="col-lg-7 col-xl-8 stretch-card">

            <!-- card -->
            <div class="card">

                <!-- body -->
                <div class="card-body">

                    <!-- header -->
                    <div class="d-flex justify-content-between align-items-baseline mb-2">

                        <!-- title -->
                        <h6 class="card-title mb-3">
                            {{ __( 'История' ) }}
                        </h6>
                        <!-- end title -->

                    </div>
                    <!-- end header -->

                    @if( $logs->count() )

                        <!-- content -->
                        <div class="table-responsive">

                            <!-- table -->
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">
                                        {{ __( 'Система' ) }}
                                    </th>
                                    <th class="pt-0">
                                        {{ __( 'Дата' ) }}
                                    </th>
                                    <th class="pt-0">
                                        {{ __( 'Продукт' ) }}
                                    </th>
                                    <th class="pt-0">
                                        {{ __( 'Статус' ) }}
                                    </th>
                                    <th class="pt-0">
                                        {{ __( 'Клиент' ) }}
                                    </th>
                                    <th class="pt-0"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $logs as $item )
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>
                                            {{ $item->system->name }}
                                        </td>
                                        <td>
                                            {{ $item->published_at->format('d.m.Y H:s') }}
                                        </td>
                                        <td class="text-wrap">
                                            {{ $item->document->product->name }}
                                        </td>
                                        <td>
                                            @if( $item->status === \Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum::paid )
                                                <span class="badge badge-success">
                                                    {{ __( 'success' ) }}
                                                </span>
                                            @elseif( $item->status === \Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum::errorpaid )
                                                <span class="badge badge-danger">
                                                    {{ __( 'error' ) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ isset($item->document->user->detail->fullname) ? $item->document->user->detail->fullname : '' }}
                                        </td>
                                        <td>

                                            @php( $information = '<div class="table-responsive pt-3"><table class="table table-bordered"><tbody>' )

                                            @foreach( $item->request as $key => $value )
                                                @php( $information .= '<tr>' )
                                                @php( $information .= '<td>' . $key . '</td>' )
                                                @php( $information .= '<td>' . $value . '</td>' )
                                                @php( $information .= '</tr>' )
                                            @endforeach

                                            @php( $information .= '</tbody></table></div>' )
                                            <button
                                                    type="button" class="btn btn-info btn-xs btn-icon"
                                                    onclick="showSwalPayHubLogInfo('{{ $information }}')"
                                            >
                                                <i data-feather="info"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->

                            <a href="{{ route('payhub.logs.index') }}" type="button" class="btn btn-primary">
                                {{ __( 'Смотреть все' ) }}
                            </a>

                        </div>
                        <!-- end content -->

                    @else

                        {{ __( 'Записей нет' ) }}

                    @endif

                </div>
                <!-- end body -->

            </div>
            <!-- end card -->

        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

@endsection

@push('custom-scripts')
    @include( 'PayHub::script' )
@endpush
