<!-- accordion -->
<div class="@isset($class) {{ $class }} @endisset accordion" id="faq__accordion">

    @foreach( $faqs as $item )

        <!-- item -->
        <div class="accordion-item">

            <!-- header -->
            <h3 class="accordion-header" id="faq-elem-header-{{ $loop->iteration }}">
                <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq-elem-body-{{ $loop->iteration }}"
                        aria-expanded="true"
                        aria-controls="faq-elem-body-{{ $loop->iteration }}"
                >
                    {{ $item->name }}
                </button>
            </h3>
            <!-- end header -->

            <!-- collapse -->
            <div
                    id="faq-elem-body-{{ $loop->iteration }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="faq-elem-header-{{ $loop->iteration }}"
                    data-bs-parent="#faq__accordion"
            >

                <!-- body -->
                <div class="accordion-body">
                    {!! $item->description !!}
                </div>
                <!-- end body -->

            </div>
            <!-- collapse -->

        </div>
        <!-- end item -->

    @endforeach

</div>
<!-- end accordion -->
