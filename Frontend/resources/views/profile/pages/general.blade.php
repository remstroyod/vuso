
@if(false)
<!-- Issues -->
<div class="cabinet__group cabinet__issues">

    <!-- title -->
    <div class="cabinet__group-title">
        {{ __( 'Статусы заявлений о страховом случае' ) }}
    </div>
    <!-- end title -->

    <!-- content -->
    <div class="cabinet__group-content">

        <!-- swiper -->
        <div class="cabinet__issues-slider swiper-container cabinet-issues-swiper">

            <!-- wrapper -->
            <div class="swiper-wrapper">

                <!-- slide -->
                <div class="swiper-slide">

                    <!-- item -->
                    <div class="cabinet__issue-item pending">

                        <!-- status -->
                        <div class="cabinet__issue-item__status">

                            <!-- inner -->
                            <div class="cabinet__issue-item__status-inner">

                                <!-- type -->
                                <div class="cabinet__issue-item__type">
                                    {{ __( 'КАСКО' ) }}
                                </div>
                                <!-- end type -->

                                {{ __( 'Заявление на рассмотрении' ) }}

                            </div>
                            <!-- end inner -->

                        </div>
                        <!-- end status -->

                        <!-- body -->
                        <div class="cabinet__issue-item__body">

                            <!-- title -->
                            <div class="cabinet__issue-item__title">
                                Заявление по ТС BMW X5 2019 от 24 окт 2021
                            </div>
                            <!-- end title -->

                            <!-- progress -->
                            <div class="cabinet__issue-item__progress">

                                <!-- step -->
                                <div class="cabinet__issue-item__step completed">

                                    <!-- inner -->
                                    <div class="cabinet__issue-item__step-inner">

                                        <!-- inner -->
                                        <div class="cabinet__issue-item__step-title">
                                            {{ __( 'Агент произвел осмотр ТС' ) }}
                                        </div>
                                        <div class="cabinet__issue-item__step-date">3 августа 2021 </div>
                                    </div>
                                    <!-- end inner -->

                                </div>
                                <!-- end step -->

                                <!-- step -->
                                <div class="cabinet__issue-item__step completed">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Документы находятся в страховой компании</div>
                                        <div class="cabinet__issue-item__step-date">4 августа 2021 </div>
                                    </div>
                                </div>
                                <!-- end step -->

                                <!-- step -->
                                <div class="cabinet__issue-item__step current">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Принятие решения</div>
                                        <div class="cabinet__issue-item__step-date">9-20 августа 2021 </div>
                                    </div>
                                </div>
                                <!-- end step -->

                                <!-- step -->
                                <div class="cabinet__issue-item__step">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Выплата</div>
                                        <div class="cabinet__issue-item__step-date">22-30 августа 2021</div>
                                    </div>
                                </div>
                                <!-- end step -->

                            </div>
                            <!-- end progress -->

                        </div>
                        <!-- end body -->

                    </div>
                    <!-- end item -->

                </div>
                <!-- end slide -->

                <!-- slide -->
                <div class="swiper-slide">
                    <div class="cabinet__issue-item completed">
                        <div class="cabinet__issue-item__status">
                            <div class="cabinet__issue-item__status-inner">
                                <span class="cabinet__issue-item__type">КАСКО</span>
                                Выплата произведена 25 сентября 2021
                            </div>
                        </div>
                        <div class="cabinet__issue-item__body">
                            <div class="cabinet__issue-item__title">
                                Заявление по ТС BMW X5 2019 от 24 окт 2021
                            </div>
                            <div class="cabinet__issue-item__progress">
                                <div class="cabinet__issue-item__step completed">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Агент произвел осмотр ТС</div>
                                        <div class="cabinet__issue-item__step-date">3 августа 2021 </div>
                                    </div>
                                </div>
                                <div class="cabinet__issue-item__step completed">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Документы находятся на рассмотрении в страховой компании</div>
                                        <div class="cabinet__issue-item__step-date">4 августа 2021 </div>
                                    </div>
                                </div>
                                <div class="cabinet__issue-item__step completed">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Принятие решения</div>
                                        <div class="cabinet__issue-item__step-date">9-20 августа 2021 </div>
                                    </div>
                                </div>
                                <div class="cabinet__issue-item__step completed">
                                    <div class="cabinet__issue-item__step-inner">
                                        <div class="cabinet__issue-item__step-title">Выплата</div>
                                        <div class="cabinet__issue-item__step-date">22-30 августа 2021</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end slide -->

            </div>
            <!-- end wrapper -->

            <!-- pagination -->
            <div class="swiper-pagination"></div>
            <!-- end pagination -->

        </div>
        <!-- end swiper -->

    </div>
    <!-- end content -->

</div>
<!-- End Issues -->
@endif
<!-- Policy -->
<div class="cabinet__group cabinet__policy">
    <div class="cabinet__group-title">{{__('Ваши страховые полисы')}}</div>
    <div class="cabinet__group-content">
        <div class="cabinet__policy-slider swiper-container cabinet-policy-swiper">
            <div class="swiper-wrapper">
                @foreach($insuranceDocs as $i => $item)
                <form action="{{ route('payment.buy-insurance', ['user' => $item['user'], 'doc_blank_1c' => $item['doc_blank_1c'], 'id' => $item['product_id']]) }}"  method="post" class="swiper-slide buy-insurance">
                    <div class="cabinet__policy-item">
                        @if(isset($item['status']))
                            <div class="cabinet__policy-item__status" style="background: {{$item['status']['color']}}">{{$item['status']['name']}} {{isset($item['status']['parameter']) ?  $item[$item['status']['parameter']] : ''}}</div>
                        @endif
                        <div class="cabinet__policy-item__body">
                            <div class="cabinet__policy-item__title">{{$item['product']['name']}}</div>
                            @if(isset($item['insurance_object']) && isset($item['obj_type']))
                                <div class="cabinet__policy-item__number">Договор № {{$item['doc_blank_1c']}}
                                    @if(isset($item['insurance_object']))
                                        @if($item['obj_type'] === 'building')
                                            адрес:
                                        @else
                                            для
                                        @endif
                                        @foreach($item['insurance_object'] as $index => $object)
                                            @if($item['obj_type'] === 'car')
                                            {{$object->mark}}
                                            {{$object->model}}
                                            {{$object->year}}
                                            @elseif($item['obj_type'] === 'person')
                                                @if($index < 2)
                                                {{$object->first_name}}
                                                {{$object->last_name}}
                                                @endif
                                            @elseif($item['obj_type'] === 'building')
                                                {{$object->address}}
                                            @endif
                                        @endforeach
                                        @if(count($item['insurance_object']) > 2)
                                            <a href="#" class="many-items-button" data-index="{{$i}}">еще {{count($item['insurance_object']) - 2}} -е</a>
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="cabinet__policy-item__params">
                                <div class="cabinet__policy-item__param">{{ __('Стоимость') }}: {{$item['total']}} грн</div>
                                {{--<div class="cabinet__policy-item__param">Стоимость: {{$item['subtotal']}} грн/месяц</div>--}}
                            </div>
                            <div class="cabinet__policy-item__controls">
                                <button
                                    class="cabinet__policy-item__edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-insurance"
                                    data-product-id=""
                                    data-insurance-edit-type=""
                                    type="button"
                                >
                                    {{ __( 'Изменить условия договора' ) }}
                                </button>
                                
                                {{--<button class="cabinet__policy-item__toggle suspend" disabled>Приостановить дейстивие</button>--}}
                                @if($item['payment_status'] == "0")
                                    <a href="{{route('api.v1.payment.pay', ['dogovor_id' => $item['dogovor_id'], 'successUrl' => route(Route::currentRouteName()), 'errorUrl' => route(Route::currentRouteName())])}}" id="payButton" class="btn yellow cabinet__policy-item__submit">{{__('Оплатить')}}</a>
                                @endif
                                @if($item['payment_status'] == "1")
                                    <a href="{{route('catalog.product.index', ['product' => $item->product->slug, 'state' => 'sign', 'policyNo' => $item['dogovor_id']])}}" class="btn yellow cabinet__policy-item__submit">{{ __('Подписать договор') }}</a>
                                @endif
                                <button type="button" data-id="{{$item['id']}}" href="#" class="cabinet__policy-item__pdf d-flex align-items-center">
                                    <span>{{ __('Скачать .pdf') }}</span>
                                    <img class="m-2 d-none" src="{{url('/assets/app/img/loading.svg')}}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
                <!-- добавлены блоки добавления договора -->
                <div class="swiper-slide">
                    <div class="cabinet__policy-add cabinet__policy-add--offer">
                        <div class="cabinet__policy-add__title">
                            {{ __('Добавить существующий договор') }}
                        </div>
                        <div class="cabinet__policy-add__form">
                            <form action="{{route('forms.store')}}" class="subscribe__form ajaxForm" method="post">
                                @csrf
                                <input type="hidden" name="type" value="12">
                                <input type="text" name="inn" class="cabinet__policy-add__input" placeholder="{{__('ИНН')}}" maxlength="11">
                                <input type="text" name="UF_CRM_1641984798" class="cabinet__policy-add__input" placeholder="{{__('Номер договора')}}" maxlength="11">
                                <button class="btn yellow cabinet__policy-add__submit subscribe__submit" type="submit">
                                    {{__('Добавить')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cabinet__policy-add cabinet__policy-add--create">
                        <div class="cabinet__policy-add__title">
                            <a href="{{route('catalog.index')}}">{{__('Оформить новый договор')}}</a>
                        </div>
                    </div>
                </div>
                <!-- добавлены блоки добавления договора -->
                        {{--                <div class="swiper-slide">--}}
                        {{--                    <div class="cabinet__policy-item">--}}
                        {{--                        <div class="cabinet__policy-item__status no-payment">Не оплачен</div>--}}
                        {{--                        <div class="cabinet__policy-item__body">--}}
                        {{--                            <div class="cabinet__policy-item__title">КАСКО Антистресс</div>--}}
                        {{--                            <div class="cabinet__policy-item__number">Договор № 09458473476 для BMW X4 2020</div>--}}
                        {{--                            <div class="cabinet__policy-item__params">--}}
                        {{--                                <div class="cabinet__policy-item__param">Покрытие: 200 000 грн</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Стоимость: 1200 грн/месяц</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Следующая оплата: 12 сентября</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="cabinet__policy-item__payments">Осталось 12 платежей</div>--}}
                        {{--                            <div class="cabinet__policy-item__controls">--}}
                        {{--                                <button class="cabinet__policy-item__edit">Изменить условия договора</button>--}}
                        {{--                                <button class="cabinet__policy-item__toggle suspend" disabled>Приостановить дейстивие</button>--}}
                        {{--                                <button class="btn yellow cabinet__policy-item__submit">Оплатить</button>--}}
                        {{--                                <a download href="/" class="cabinet__policy-item__pdf" disabled>Скачать .pdf</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="swiper-slide">--}}
                        {{--                    <div class="cabinet__policy-item">--}}
                        {{--                        <div class="cabinet__policy-item__status awaiting-inspection">Ожидает осмотра</div>--}}
                        {{--                        <div class="cabinet__policy-item__body">--}}
                        {{--                            <div class="cabinet__policy-item__title">КАСКО Антистресс</div>--}}
                        {{--                            <div class="cabinet__policy-item__number">Договор № 09458473476 для BMW X4 2020</div>--}}
                        {{--                            <div class="cabinet__policy-item__params">--}}
                        {{--                                <div class="cabinet__policy-item__param">Покрытие: 200 000 грн</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Стоимость: 1200 грн/месяц</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Следующая оплата: 12 сентября</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="cabinet__policy-item__payments">Осталось 12 платежей</div>--}}
                        {{--                            <div class="cabinet__policy-item__controls">--}}
                        {{--                                <button class="cabinet__policy-item__edit">Изменить условия договора</button>--}}
                        {{--                                <button class="cabinet__policy-item__toggle suspend">Приостановить дейстивие</button>--}}
                        {{--                                <button class="cabinet__policy-item__wallet">Добавить в Apple Wallet</button>--}}
                        {{--                                <a download href="/" class="cabinet__policy-item__pdf">Скачать .pdf</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="swiper-slide">--}}
                        {{--                    <div class="cabinet__policy-item">--}}
                        {{--                        <div class="cabinet__policy-item__status valid">Действует до 30.08.2021 </div>--}}
                        {{--                        <div class="cabinet__policy-item__body">--}}
                        {{--                            <div class="cabinet__policy-item__title">КАСКО Антистресс</div>--}}
                        {{--                            <div class="cabinet__policy-item__number">Договор № 09458473476 для BMW X4 2020</div>--}}
                        {{--                            <div class="cabinet__policy-item__params">--}}
                        {{--                                <div class="cabinet__policy-item__param">Покрытие: 200 000 грн</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Стоимость: 1200 грн/месяц</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Следующая оплата: 12 сентября</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="cabinet__policy-item__payments">Осталось 2 платежа</div>--}}
                        {{--                            <div class="cabinet__policy-item__controls">--}}
                        {{--                                <button class="cabinet__policy-item__edit">Изменить условия договора</button>--}}
                        {{--                                <button class="cabinet__policy-item__toggle suspend">Приостановить дейстивие</button>--}}
                        {{--                                <button class="cabinet__policy-item__wallet">Добавить в Apple Wallet</button>--}}
                        {{--                                <a download href="/" class="cabinet__policy-item__pdf">Скачать .pdf</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="swiper-slide">--}}
                        {{--                    <div class="cabinet__policy-item">--}}
                        {{--                        <div class="cabinet__policy-item__status suspended">Приостановлено до 30.08.2021</div>--}}
                        {{--                        <div class="cabinet__policy-item__body">--}}
                        {{--                            <div class="cabinet__policy-item__title">КАСКО Антистресс</div>--}}
                        {{--                            <div class="cabinet__policy-item__number">Договор № 09458473476 для BMW X4 2020</div>--}}
                        {{--                            <div class="cabinet__policy-item__params">--}}
                        {{--                                <div class="cabinet__policy-item__param">Покрытие: 200 000 грн</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Стоимость: 1200 грн/месяц</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Следующая оплата: 12 сентября</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="cabinet__policy-item__payments success">Оплачено полностью</div>--}}
                        {{--                            <div class="cabinet__policy-item__controls">--}}
                        {{--                                <button class="cabinet__policy-item__edit">Изменить условия договора</button>--}}
                        {{--                                <button class="cabinet__policy-item__toggle activate">Продолжить действие</button>--}}
                        {{--                                <button class="cabinet__policy-item__wallet">Добавить в Apple Wallet</button>--}}
                        {{--                                <a download href="/" class="cabinet__policy-item__pdf">Скачать .pdf</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="swiper-slide">--}}
                        {{--                    <div class="cabinet__policy-item">--}}
                        {{--                        <div class="cabinet__policy-item__status ended">Закончил действие 30.08.2021</div>--}}
                        {{--                        <div class="cabinet__policy-item__body">--}}
                        {{--                            <div class="cabinet__policy-item__title">Защита COVID-19</div>--}}
                        {{--                            <div class="cabinet__policy-item__number">Договор № 09458473476 для Вадим Гаряев, Александр Д.., еще 2-е</div>--}}
                        {{--                            <div class="cabinet__policy-item__params">--}}
                        {{--                                <div class="cabinet__policy-item__param">Покрытие: 200 000 грн</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Стоимость: 1200 грн/месяц</div>--}}
                        {{--                                <div class="cabinet__policy-item__param">Следующая оплата: 12 сентября</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="cabinet__policy-item__payments success">Оплачено полностью</div>--}}
                        {{--                            <div class="cabinet__policy-item__controls">--}}
                        {{--                                <button class="cabinet__policy-item__edit" disabled>Изменить условия договора</button>--}}
                        {{--                                <button class="cabinet__policy-item__toggle suspend" disabled>Приостановить дейстивие</button>--}}
                        {{--                                <button class="cabinet__policy-item__wallet">Добавить в Apple Wallet</button>--}}
                        {{--                                <a download href="/" class="cabinet__policy-item__pdf">Скачать .pdf</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- to do
        в кнопку карточки надо передать какойто параметр чтобы определять её приостанавливать или возобновлять
        передавать а айди этого блока и кнопку data-bs-target="modal-edit-insurance" индекс продукта
    -->
    <div
        class="modal fade modal-edit-insurance"
        id="modal-edit-insurance"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-overlay" data-bs-dismiss="modal"></div>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ __( 'Изменить условия договора' ) }}
                    </h5>
                    <button
                        type="button"
                        class="modal-close"
                        data-bs-dismiss="modal"
                        aria-label="{{ __( 'Close' ) }}"></button>
                </div>
                <div class="modal-body">
                    <form action="/" class="modal-edit-insurance__form">
                        <!-- <input type="hidden" value="some product id"> -->
                        <!-- renew -->
                        <!-- <div class="modal-edit-insurance__group active"> -->
                        <div class="modal-edit-insurance__group">
                            <button type="button" class="modal-edit-insurance__group-btn modal-edit-insurance__group-btn--renew">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.75 4.37073C3.75 3.57956 4.62525 3.10172 5.29076 3.52955L14.1082 9.19788C14.7205 9.59152 14.7205 10.4866 14.1082 10.8802L5.29076 16.5486C4.62524 16.9764 3.75 16.4986 3.75 15.7074V4.37073Z" fill="#F9FBFE"/>
                                </svg>
                                <span>{{ __( 'Возобновить договор' ) }}</span>
                            </button>

                            <div class="modal-edit-insurance__group-content">
                                <div class="modal-edit-insurance__group-annotation">
                                    {{ __( 'Пожалуйста, выберите дату, с которой Вы хотите возобновить действие договора' ) }}
                                </div>
                                <div class="modal-edit-insurance__group-inputs">
                                    <div class="modal-edit-insurance__group-elem">
                                        <input type="text" placeholder="C" class="modal-edit-insurance__group-input" min="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- renew -->

                        <!-- pause -->
                        <!-- <div class="modal-edit-insurance__group active"> -->
                        <div class="modal-edit-insurance__group">
                            <button type="button" class="modal-edit-insurance__group-btn modal-edit-insurance__group-btn--pause">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.33333 3.37305H5V16.7064H8.33333V3.37305Z" fill="#F9FBFE"/>
                                    <path d="M14.9998 3.37305H11.6665V16.7064H14.9998V3.37305Z" fill="#F9FBFE"/>
                                </svg>
                                <span>{{ __( 'Приостановить договор' ) }}</span>
                            </button>

                            <div class="modal-edit-insurance__group-content">
                                <div class="modal-edit-insurance__group-annotation">
                                    {{ __( 'Пожалуйста, выберите период времени, в который хотите приостановить действие договора' ) }}
                                </div>
                                <div class="modal-edit-insurance__group-inputs">
                                    <div class="modal-edit-insurance__group-elem">
                                        <input type="text" placeholder="C" class="modal-edit-insurance__group-input" min="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="modal-edit-insurance__group-elem">
                                        <input type="text" placeholder="До" class="modal-edit-insurance__group-input" min="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pause -->

                        <!-- cancel -->
                        <!-- <div class="modal-edit-insurance__group active"> -->
                        <div class="modal-edit-insurance__group">
                            <button type="button" class="modal-edit-insurance__group-btn modal-edit-insurance__group-btn--cancel">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8432 4.19635C16.3856 4.73874 16.3856 5.61814 15.8432 6.16053L6.12098 15.8828C5.57859 16.4251 4.69919 16.4251 4.1568 15.8828C3.6144 15.3404 3.6144 14.461 4.1568 13.9186L13.879 4.19635C14.4214 3.65395 15.3008 3.65395 15.8432 4.19635Z" fill="#BFC9E9"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.1568 4.19635C4.69919 3.65395 5.57859 3.65395 6.12098 4.19635L15.8432 13.9186C16.3856 14.461 16.3856 15.3404 15.8432 15.8828C15.3008 16.4251 14.4214 16.4251 13.879 15.8828L4.1568 6.16053C3.6144 5.61814 3.6144 4.73874 4.1568 4.19635Z" fill="#BFC9E9"/>
                                </svg>
                                <span>{{ __( 'Отменить действие договора' ) }}</span>
                            </button>

                            <div class="modal-edit-insurance__group-content">
                                <div class="modal-edit-insurance__group-annotation">
                                    {{ __( 'Пожалуйста, выберите дату, с которой Вы хотите отменить действие договора' ) }}
                                </div>
                                <div class="modal-edit-insurance__group-inputs">
                                    <div class="modal-edit-insurance__group-elem">
                                        <input type="text" placeholder="C" class="modal-edit-insurance__group-input" min="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cancel -->

                        <div class="modal-edit-insurance__group edit-insurance-comment-group">
                            <div class="edit-insurance-comment-group__title">
                                {{ __( 'Или укажите в комментарии, что вы хотите изменить' ) }}
                            </div>
                            <div class="edit-insurance-comment-group__descr">
                                {{ __( 'Страховой специалист получит вашу заявку, и свяжется с вами для дальнейших деталей.' ) }}
                            </div>
                            <textarea
                                class="edit-insurance-comment-group__textarea"
                                placeholder="{{ __( 'Комментарий для страхового специалиста' ) }}"
                            ></textarea>
                        </div>

                        <button class="btn yellow modal-edit-insurance__submit">{{ __( 'Отправить запрос на изменение' ) }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Policy -->
