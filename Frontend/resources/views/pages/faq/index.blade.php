@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('faq') }}
    @endif

    <!-- Faq -->
    <section class="multiple-faq">
        <div class="container">

            @include( 'partials.page-title' )

            @if( count($categories) )
                <div class="multiple-faq__content">
                    @foreach( $categories as $category )
                        @php( $faqs = $category->faqs )

                        @if( $category->image || count($faqs) )
                            <div class="multiple-faq__group">
                                @if( $category->image )
                                    @if ( Storage::disk('public')->exists('images/faq/categories/' . $category->image) )
                                        <div class="multiple-faq__group-banner">
                                            <img
                                                src="{{ Storage::url('images/faq/categories/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                title="{{ $category->name }}"
                                            >
                                            <div class="multiple-faq__group-title">
                                                {{ $category->name }}
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if( count($faqs) )
                                    <div class="multiple-faq__group-accordion accordion" id="multiple-faq__accordion">
                                        @foreach( $faqs as $faq )
                                            <div class="accordion-item">
                                                <h3
                                                    class="accordion-header"
                                                    id="multiple-faq-elem-header-{{ $category->id }}-{{ $loop->iteration }}"
                                                >
                                                    <button
                                                        class="accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#multiple-faq-elem-body-{{ $category->id }}-{{ $loop->iteration }}"
                                                        aria-expanded="true"
                                                        aria-controls="multiple-faq-elem-body-{{ $category->id }}-{{ $loop->iteration }}"
                                                    >
                                                        {{ $faq->name }}
                                                    </button>
                                                </h3>
                                                <div
                                                    id="multiple-faq-elem-body-{{ $category->id }}-{{ $loop->iteration }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="multiple-faq-elem-header-{{ $category->id }}-{{ $loop->iteration }}"
                                                    data-bs-parent="#multiple-faq__accordion"
                                                >
                                                    <div class="accordion-body">
                                                        {!! $faq->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                    @endforeach
                </div>
            @endif

        </div>
    </section>
    <!-- End Faq -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
