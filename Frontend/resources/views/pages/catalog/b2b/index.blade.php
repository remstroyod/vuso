@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('catalog', $page) }}
    @endif

    <!-- catalog -->
    <section class="insurance insurance--business-catalog">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <div class="insurance__head">

                @include( 'partials.page-title' )

                @if(false)
                <!-- nav -->
                <ul class="nav nav-pills">
                    @if( $contragentCatalog )
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                aria-current="page"
                                href="{{ route('catalog.contragents.index', $contragentCatalog) }}"
                            >
                                {{ $contragentCatalog->name }}
                            </a>
                        </li>
                    @endif

                    @if( count($contragents) )
                        @foreach( $contragents as $contragent )
                            <li class="nav-item">
                                <a
                                    class="nav-link @if( $loop->iteration == 1 ) active @endif"
                                    aria-current="page"
                                    href="#"
                                >
                                    {{ $contragent->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <!-- end nav -->
                @endif

            </div>
            <!-- end header -->

            @if( count($tags) )

                <!-- filters -->
                <div class="insurance__filters">

                    <!-- title -->
                    <div class="insurance__filters-title">
                        {{ __( 'Фильтровать по отраслям бизнеса' ) }}
                    </div>
                    <!-- end title -->

                    <form
                        action="{{ url()->current() }}"
                        method="get"
                        enctype="multipart/form-data"
                        class="b2bTags"
                    >

                        <!-- list -->
                        <div class="insurance__filters-list">

                            @foreach( $tags as $name => $key )

                                <label class="insurance__filter">
                                    <input type="checkbox" name="tags[]" value="{{ $key }}" @if( request()->tags && in_array( $key, request()->tags ) ) checked @endif hidden>
                                    <span>{{ $name }}</span>
                                </label>

                            @endforeach

                        </div>
                        <!-- end list -->

                    </form>

                </div>
                <!-- end filters -->

            @endif

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col col-4">

                    @if( $categories->count() )

                    <!-- categories -->
                    <div class="insurance__categories">

                        @foreach( $categories as $category )

                            <a
                                href="{{ route( 'b2b.category.index', $category ) }}"
                                class="insurance__category-selector active"
                            >
                                {{ $category->name }}
                            </a>

                        @endforeach

                    </div>
                    <!-- end categories -->

                    @endif

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col col-8">

                    <!-- products -->
                    <div class="insurance__category">

                        @if( $products->count() )
                            <div class="insurance__category-head">
                                <div class="insurance__category-results">
                                    {{ __( 'Найдено :count результатов', ['count' => $products->total()] ) }}
                                </div>

                                <a href="{{route(request()->route()->getName(), ['category' => $page])}}" class="insurance__filters-reset">{{ __('Сбросить фильтры') }}</a>
                            </div>

                            <!-- list -->
                            <div class="insurance__category-list">

                                @foreach( $products as $item )

                                    @include( 'partials.loop.products-b2b' )

                                @endforeach

                            </div>
                            <!-- end list -->

                            @if ( $products->hasPages() )

                                <!-- controls -->
                                <div class="insurance__category-controls">

                                    @if ( $products->hasMorePages() )
                                    <button
                                        data-href="{{ url()->full() }}"
                                        data-target=".insurance__category-list"
                                        data-last="{{ $products->lastPage() }}"
                                        class="btn blue insurance__category-extender loadMore"
                                    >
                                        <span>{{ __( 'Показать еще' ) }} </span>
                                        <span>4</span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.6587 7.74865C4.95468 7.45921 5.43455 7.45921 5.73053 7.74865L12.2683 14.1422L18.8061 7.74865C19.102 7.45921 19.5819 7.45921 19.8779 7.74865C20.1739 8.0381 20.1739 8.50739 19.8779 8.79684L12.8042 15.7145C12.5082 16.0039 12.0284 16.0039 11.7324 15.7145L4.6587 8.79683C4.36273 8.50739 4.36273 8.0381 4.6587 7.74865Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.44895 7.53417C4.86152 7.1307 5.52771 7.1307 5.94028 7.53417L12.2683 13.7226L18.5963 7.53417C19.0089 7.1307 19.6751 7.1307 20.0876 7.53417C20.504 7.94129 20.504 8.6042 20.0876 9.01132L13.014 15.929C12.6014 16.3324 11.9352 16.3324 11.5226 15.929L4.44895 9.01132C4.03264 8.6042 4.03264 7.94129 4.44895 7.53417ZM5.52077 7.96314C5.34139 7.78771 5.04784 7.78771 4.86846 7.96314C4.69281 8.13491 4.69281 8.41058 4.86846 8.58235L11.9421 15.5C12.1215 15.6754 12.4151 15.6754 12.5945 15.5L19.6681 8.58235C19.8438 8.41058 19.8438 8.13491 19.6681 7.96314C19.4888 7.78771 19.1952 7.78771 19.0158 7.96314L12.4781 14.3567C12.3615 14.4707 12.1751 14.4707 12.0585 14.3567L5.52077 7.96314Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                    @endif

                                    {{ $products->appends(request()->all())->links('vendor.pagination.catalog-b2b') }}

                                </div>
                                <!-- end controls -->

                            @endif

                        @else

                            {{ __( 'По вашему запросу ничего не найдено' ) }}

                        @endif

                    </div>
                    <!-- end products -->

                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- end catalog -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/app/js/b2b.js') }}"></script>
    <script src="{{ asset('assets/app/js/load.more.js') }}"></script>
@endpush
