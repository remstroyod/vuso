<!-- Form -->
<form
        action="{{ route('forms.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="info-text__payment-request__form ajaxForm"
>
    @csrf

    <input
            type="hidden"
            value="{{ $forms->payment }}"
            name="type"
    >

    <input type="hidden" name="message" class="formConsultationTimeValue">

    <!-- slider -->
    <div class="info-text__payment-request__slider formConsultationTimeDate">

        <!-- swiper -->
        <div class="swiper-container payment-request-day-swiper">

            <!-- wrapper -->
            <div class="swiper-wrapper">

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="day"
                                hidden
                                checked
                                data-value="{{ Date::now()->format('d.m.Y') }}"
                        >
                        <span class="radio-custom">{{ __( 'Сегодня' ) }}</span>
                    </label>
                </div>
                <!-- end slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="day"
                                hidden
                                data-value="{{ Date::now()->add('1 day')->format('d.m.Y') }}"
                        >
                        <span class="radio-custom">{{ __( 'Завтра' ) }} ({{ Date::now()->add('1 day')->format('d.m') }})</span>
                    </label>
                </div>
                <!-- end slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="day"
                                hidden
                                data-value="{{ Date::now()->add('2 day')->format('d.m.Y') }}"
                        >
                        <span class="radio-custom">{{ __( 'Послезавтра' ) }} ({{ Date::now()->add('2 day')->format('d.m') }})</span>
                    </label>
                </div>
                <!-- end slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="day"
                                hidden
                                data-value="{{ Date::now()->add('3 day')->format('d.m.Y') }}"
                        >
                        <span class="radio-custom">{{ Date::now()->add('3 day')->format('d.m') }}</span>
                    </label>
                </div>
                <!-- end slide -->

            </div>
            <!-- end wrapper -->

        </div>
        <!-- end swiper -->

        <!-- controls -->
        <button
                type="button"
                class="swiper-button swiper-button-prev"
                id="prev-day-btn"
        ></button>
        <button
                type="button"
                class="swiper-button swiper-button-next"
                id="next-day-btn"
        ></button>
        <!-- end controls -->

    </div>
    <!-- end slider -->

    <!-- slider -->
    <div class="info-text__payment-request__slider formConsultationTimeTime">

        <!-- swiper -->
        <div class="swiper-container payment-request-time-swiper">

            <!-- wrapper -->
            <div class="swiper-wrapper">

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="time"
                                hidden
                                checked
                                data-value="12:30-13:00"
                        >
                        <span class="radio-custom">12:30-13:00</span>
                    </label>
                </div>
                <!-- slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="time"
                                hidden
                                data-value="14:30-15:00"
                        >
                        <span class="radio-custom">14:30-15:00</span>
                    </label>
                </div>
                <!-- slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="time"
                                hidden
                                data-value="15:30-16:00"
                        >
                        <span class="radio-custom">15:30-16:00</span>
                    </label>
                </div>
                <!-- slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <label class="radio-label">
                        <input
                                type="radio"
                                name="time"
                                hidden
                                data-value="17:30-18:00"
                        >
                        <span class="radio-custom">17:30-18:00</span>
                    </label>
                </div>
                <!-- slide -->

            </div>
            <!-- end wrapper -->

        </div>
        <!-- end swiper -->

        <!-- controls -->
        <button
                type="button"
                class="swiper-button swiper-button-prev"
                id="prev-time-btn"
        ></button>
        <button
                type="button"
                class="swiper-button swiper-button-next"
                id="next-time-btn"
        ></button>
        <!-- end controls -->

    </div>
    <!-- end slider -->

    <!-- inputs -->
    <div class="info-text__payment-request__inputs">

        <input
                type="text"
                class="info-text__payment-request__input"
                name="name"
                placeholder="{{ __( 'Имя' ) }}"
                required
                pattern="^[A-Za-zА-Яа-яЁё\s]+$"
        />

        <input
                type="phone"
                class="info-text__payment-request__input"
                name="phone"
                placeholder="{{ __( 'Телефон' ) }}"
                required
                pattern="(\+?\d[- . ( )]*){7,15}"
        />

    </div>
    <!-- end inputs -->

    <button
            type="submit"
            class="btn info-text__payment-request__submit"
    >
        {{ __( 'Забронировать это время' ) }}
    </button>

    @include( 'partials.message' )

    @include( 'forms.bitrix.bitrix-input' )

</form>
<!-- End Form -->
