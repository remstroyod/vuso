<!-- Step > 2 -->
<div class="online-payment__step online-payment__step--second active paymentStepTwo">

    <!-- form -->
    <form action="{{ route('payment.process', ['user' => $user, 'contract' => $contract]) }}" method="post" class="paymentFormProcess">
        @csrf

        <!-- group -->
        <div class="online-payment__group">

            <!-- title -->
            <div class="online-payment__group-title">
                {{ __( 'Заполните форму ниже, чтобы закончить оформление страхового полиса' ) }}:
            </div>
            <!-- end title -->

            <!-- content -->
            <div class="online-payment__group-content">

                <!-- input -->
                <div class="online-payment__group-input">

                    <input
                            type="text"
                            maxlength="4"
                            value=""
                            name="sms_code"
                    >
                    <span>{{ __( 'Код из сообщения' ) }}</span>

                </div>
                <!-- end input -->

            </div>
            <!-- end content -->

        </div>
        <!-- end group -->

        <!-- title -->
        <h3 class="online-payment__order-title">
            {{ __( 'Данные по договору' ) }}
        </h3>
        <!-- end title -->

        <!-- group -->
        <div class="online-payment__group">

            <!-- title -->
            <div class="online-payment__group-title">
                {{ __( 'Ваши личные данные' ) }}
            </div>
            <!-- end title -->

            <!-- content -->
            <div class="online-payment__group-content">

                <!-- input -->
                <div class="online-payment__group-input">
                    <input
                            type="text"
                            value="{{ $user->detail->fullname }}"
                            name="name"
                            readonly
                    >
                </div>
                <!-- end input -->

                <!-- input -->
                <div class="online-payment__group-input">
                    <input
                            type="text"
                            value="{{ Date::parse($user->detail->birthday)->format('d.m.Y') }}"
                            name="birthday"
                            readonly
                    >
                </div>
                <!-- end input -->

                <!-- input -->
                <div class="online-payment__group-input">
                    <input
                            type="text"
                            value="{{ $user->email }}"
                            name="email"
                            readonly
                    >
                </div>
                <!-- end input -->

            </div>
            <!-- end content -->

        </div>
        <!-- end group -->

        <!-- group -->
        <div class="online-payment__group">

            <!-- title -->
            <div class="online-payment__group-title">
                {{ __( 'Данные о страховании' ) }}
            </div>
            <!-- end title -->

            <!-- content -->
            <div class="online-payment__group-content">

                <!-- product -->
                <div class="online-payment__product">

                    <!-- inner -->
                    <div class="online-payment__product-inner">

                        <!-- icon -->
                        <div class="online-payment__product-icon">
                            {!! $product->icon_svg !!}
                        </div>
                        <!-- end icon -->

                        <!-- info -->
                        <div class="online-payment__product-info">

                            <!-- title -->
                            <div class="online-payment__product-title">
                                {{ $product->name }}
                            </div>
                            <!-- end title -->

                            <!-- pricing -->
                            <div class="online-payment__product-pricing">
                                {{ __( 'К оплате' ) }} <span>{{ priceFormat($contract->total, 2) }}</span>
                            </div>
                            <!-- end pricing -->

                        </div>
                        <!-- end info -->

                        <!-- amount -->
                        <div class="online-payment__product-amount">
                            <span>2</span>/2
                        </div>
                        <!-- end amount -->

                    </div>
                    <!-- end inner -->

                    <!-- promo -->
                    <div class="online-payment__promo">

                        <!-- button -->
                        <button class="online-payment__promo-toggler" type="button">
                            {{ __( 'У меня есть промокод' ) }}
                        </button>
                        <!-- end button -->

                        <!-- form -->
                        <div class="online-payment__promo-form">

                            <label class="online-payment__promo-label">
                                {{ __( 'Введите промокод' ) }}
                            </label>

                            <input
                                    class="online-payment__promo-input"
                                    type="text"
                                    maxlength="11"
                                    name="promocode"
                            >

                            <button
                                    class="online-payment__promo-submit"
                                    type="button"
                                    disabled=""
                            ></button>

                        </div>
                        <!-- end form -->

                    </div>
                    <!-- end promo -->

                </div>
                <!-- end product -->

                <!-- total -->
                <div class="online-payment__total">

                    <!-- field -->
                    <div class="online-payment__total-field">

                        <!-- title -->
                        <div class="field-title">
                            {{ __( 'Страховое покрытие' ) }}
                        </div>
                        <!-- end title -->

                        <!-- value -->
                        <div class="field-value">

                        </div>
                        <!-- end value -->

                    </div>
                    <!-- end field -->

                    @if( $contract->data )

                        <!-- field -->
                        <div class="online-payment__total-field">

                            <!-- title -->
                            <div class="field-title">
                                {{ __( 'Количество застрахованных' ) }}
                            </div>
                            <!-- end title -->

                            <!-- value -->
                            <div class="field-value">
                                {{ count($contract->data['clients']) }} {{ Illuminate\Support\Facades\Lang::choice('человек|человека|человек', count($contract->data['clients']), [], 'ru') }}:
                            </div>
                            <!-- end value -->

                        </div>
                        <!-- end field -->

                        @foreach( $contract->data['clients'] as $client )

                            <!-- field -->
                            <div class="online-payment__total-field person">

                                <!-- title -->
                                <div class="field-title">
                                    {{ $client['name'] }}
                                </div>
                                <!-- end title -->

                                <!-- value -->
                                <div class="field-value">
                                    {{ Date::parse($client['born_date'])->format('d.m.Y') }}
                                </div>
                                <!-- end value -->

                            </div>
                            <!-- end field -->

                        @endforeach

                    @endif

                    <!-- field -->
                    <div class="online-payment__total-field">

                        <!-- title -->
                        <div class="field-title">
                            {{ _( 'Даты действия договора' ) }}
                        </div>
                        <!-- end title -->

                        <!-- value -->
                        <div class="field-value">
                            {{ Date::parse($contract['start'])->format('d.m.Y') }} - {{ Date::parse($contract['end'])->format('d.m.Y') }}
                        </div>
                        <!-- end value -->

                    </div>
                    <!-- end field -->

                    <!-- field -->
                    <div class="online-payment__total-field is-hidden">

                        <!-- title -->
                        <div class="field-title">
                            {{ __( 'Выбранный пакет страхования' ) }}
                        </div>
                        <!-- end title -->

                        <!-- value -->
                        <div class="field-value">
                            XL
                        </div>
                        <!-- end value -->

                    </div>
                    <!-- end field -->

                    <!-- field -->
                    <div class="online-payment__total-field is-hidden">

                        <!-- title -->
                        <div class="field-title">
                            {{ __( 'Франшиза' ) }}
                        </div>
                        <!-- end title -->

                        <!-- value -->
                        <div class="field-value">
                            2000 грн
                        </div>
                        <!-- end value -->

                    </div>
                    <!-- end field -->

                    <button class="online-payment__total-toggler" type="button">
                        <span>
                            {{ __( 'Детальнее' ) }}
                        </span>
                        <span>
                            {{ __( 'Скрыть' ) }}
                        </span>
                    </button>
                </div>
                <!-- end total -->

                <!-- Buttons -->
                <button class="btn yellow online-payment__submit" type="submit">
                    {{ __( 'Перейти к оплате' ) }}
                </button>
                <button class="online-payment__error-report" type="button">
                    {{ __( 'Сообщить об ошибке' ) }}
                </button>
                <!-- End Buttons -->

                <div class="error-response"></div>

            </div>
            <!-- end content -->

        </div>
        <!-- end group -->

    </form>
    <!-- end form -->

</div>
<!-- End Step > 2 -->
