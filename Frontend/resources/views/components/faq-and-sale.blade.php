{{--Component: FAQ & Акция :Component--}}
{{--Fields: title, image, link, linktext :Fields--}}
@if( $block )

    <!-- Accoridion with card -->
    <section class="accordion-with-card">
        <div class="container">
            <div class="row">
                <div class="col col-8">
                    @if( $block->elements->count() )
                        @php( $faqs = $block->elements )
                    @endif

                    @if( $faqs->count() )
                        <div class="accordion" id="faq__accordion">
                            @foreach( $faqs as $item )
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="faq-elem-header-{{ $loop->iteration }}">
                                        <button
                                            class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faq-elem-body-{{ $loop->iteration }}"
                                            aria-expanded="true"
                                            aria-controls="faq-elem-body-{{ $loop->iteration }}"
                                        >
                                            {{ (isset($item->title)) ? $item->title : $item->name }}
                                        </button>
                                    </h3>
                                    <div
                                        id="faq-elem-body-{{ $loop->iteration }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="faq-elem-header-{{ $loop->iteration }}"
                                        data-bs-parent="#faq__accordion"
                                    >
                                        <div class="accordion-body">
                                            {!! $item->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col col-4">
                    <div class="card">
                        @if ( Storage::disk('public')->exists('images/blocks/' . $block->image) )
                            <img
                                src="{{ Storage::url('images/blocks/' . $block->image) }}"
                                class="card-img-top"
                                alt="{{ $block->title }}"
                                title="{{ $block->title }}"
                            >
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $block->title }}
                            </h5>

                            <div class="card-footer">
                                <a href="{{ $block->link }}" class="card-link">
                                    {{ $block->linktext }}
                                </a>

                                <div class="card-date">
                                    {{ Date::parse($block->published_at)->format('j F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Accoridion with card -->

@endif
