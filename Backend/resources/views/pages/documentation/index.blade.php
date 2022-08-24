@extends('layouts.app')

@section('content')

    @php( $title = __( 'Документация' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'settings' => [
                'title'     => __( 'Документация' ),
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin ">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('pages.documentation.tabs')

            <!-- tab content -->
            <div class="tab-content grid-margin" id="documentationTabContent">

                <!-- tab api -->
                <div
                        class="tab-pane fade show active"
                        id="documentation-tab-api"
                        role="tabpanel"
                        aria-labelledby="settings-tab-general-tab"
                >

                    <!-- Row -->
                    <div class="stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Основное' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ __( 'Токен доступа' ) }}
                                            </td>
                                            <td class="align-top text-wrap">
                                                {!! env('API_TOKEN') !!}
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Корзина' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                            <tr>
                                                <th width="40%">URL</th>
                                                <th width="10%">Method</th>
                                                <th width="20%">Query</th>
                                                <th width="30%">Description</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart
                                                </td>
                                                <td class="align-top">
                                                    GET
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Получение корзины пользователя' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/add/{ID_PRODUCT}
                                                </td>
                                                <td class="align-top">
                                                    POST
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                        <li>
                                                            price={1-9999}
                                                        </li>
                                                        <li>
                                                            document_id={ID DOCUMENT}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Добавление товара в корзину' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/destroy/{ITEM_CART_ID}
                                                </td>
                                                <td class="align-top">
                                                    POST
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Удаление товара из корзины' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/update/{ITEM_CART_ID}
                                                </td>
                                                <td class="align-top">
                                                    POST
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                        <li>
                                                            name={NAME PRODUCT}
                                                        </li>
                                                        <li>
                                                            price={PRICE}
                                                        </li>
                                                        <li>
                                                            document_id={ID DOCUMENT}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Обновление данных о товаре в корзине' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/total
                                                </td>
                                                <td class="align-top">
                                                    GET
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Получение Total корзины' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/subtotal
                                                </td>
                                                <td class="align-top">
                                                    GET
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Получение SubTotal корзины' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/quantity
                                                </td>
                                                <td class="align-top">
                                                    GET
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Получение кол.-ва продуктов в корзине' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="align-top">
                                                    {{ settings('site_url') }}/api/v1/cart/clear
                                                </td>
                                                <td class="align-top">
                                                    POST
                                                </td>
                                                <td class="align-top">
                                                    <ul class="mb-0 list-unstyled">
                                                        <li>
                                                            token={TOKEN}
                                                        </li>
                                                        <li>
                                                            user={ID}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-top text-wrap">
                                                    <p class="card-description mb-0">
                                                        {{ __( 'Очистить корзину' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Пользователи' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/user/{ID}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID_USER}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получение данных об пользователе' ) }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/user/find/user
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        field={FIELD_NAME}
                                                    </li>
                                                    <li>
                                                        value={SEARCH_VALUE}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Поиск пользователя' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/user/sms
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        phone={USER_PHONE}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Отправка SMS' ) }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/user/sms/auth
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        phone={USER_PHONE}
                                                    </li>
                                                    <li>
                                                        sms_code={SMS_CODE}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Авторизация по коду из SMS' ) }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/user/sms/otp
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        phone={USER_PHONE}
                                                    </li>
                                                    <li>
                                                        code={OTP}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Отправить ОТП' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Продукты' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/catalog
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        page={NUMBER}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Каталог продуктов' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/catalog/product/{ID}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID_PRODUCT}
                                                    </li>
                                                    <li>
                                                        lang={LANG}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Данные о продукте' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/catalog/product/{ID}/update
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID_PRODUCT}
                                                    </li>
                                                    <li>
                                                        scenario={VALUE} (Body)
                                                    </li>
                                                    <li>
                                                        lang={LANG}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Обновить продукт' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'E-Documents' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/product/{ID}
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        user={USER_ID}
                                                    </li>
                                                    <li>
                                                        endpoint={ID}
                                                    </li>
                                                    <li>
                                                        regenerate={true|false}
                                                    </li>
                                                    <li>
                                                        policy_no={NUMBER CONTRACT}
                                                    </li>
                                                    <li>
                                                        first_name={Имя}
                                                    </li>
                                                    <li>
                                                        last_name={Фамилия}
                                                    </li>
                                                    <li>
                                                        ...={...}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Сгенерировать документ' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/destroy/{DOGOVOR}
                                            </td>
                                            <td class="align-top">
                                                DELETE
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Удалить документ' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/payment/{ID}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID DOCUMENT}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Проверить статус договора' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        page={NUMBER}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить все сгенераированные документы' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/show/{ID}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID_DOCUMENT}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить сгенерированный документ по ID' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/user/{ID}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        ID={ID_USER}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить сгенерированные документы польователя' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/system/documents
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить типы документов системы' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/system/templates
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить шаблоны системы' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/calculator/calculate-insurance/{ID}
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        id={ID_PRODUCT}
                                                    </li>
                                                    <li>
                                                        json to Body
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Калькулятор: Калькуляция' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/calculator/save-insurance/{ID}
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        id={ID_PRODUCT}
                                                    </li>
                                                    <li>
                                                        user={ID_USER}
                                                    </li>
                                                    <li>
                                                        total={TOTAL CONTRACT}
                                                    </li>
                                                    <li>
                                                        json to Body
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Калькулятор: Генерация' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/edocuments/calculator/buy-insurance/{ID}
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        id={ID_PRODUCT}
                                                    </li>
                                                    <li>
                                                        json to Body {
                                                            "policy_no":"XXX",
                                                            "otp":"XXX",
                                                            "user": ID_USER
                                                        }
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Калькулятор: Перегенерировать документ' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'PayHub' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/payment/pay
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        dogovor_id={DOGOVOR_ID}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Получить ссылку на оплату договора' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Файлы' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/files/upload
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        file={FILE}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Загрузить файл' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Страницы' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/page/{PAGE}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        PAGE={URL_PAGE}
                                                    </li>
                                                    <li>
                                                        lang={LANG}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Данные страницы' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/page/update/{PAGE}
                                            </td>
                                            <td class="align-top">
                                                POST
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        PAGE={URL_PAGE}
                                                    </li>
                                                    <li>
                                                        lang={LANG}
                                                    </li>
                                                    <li>
                                                        scenario={VALUE} (Body)
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Обновить данные страницы' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Справочники' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/autoria/mark
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Autoria (Марки)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/autoria/models
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        mark={ID_MARK}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Autoria (Модели)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/autoria/transmissions
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Autoria (Трансмиссия)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/autoria/tstype
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Autoria (Тип транспорта)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/ewa/city
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Ewa (Города)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/ewa/mark
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Ewa (Марки)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/ewa/models
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        mark={ID_MARK}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Ewa (Модели)' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url_admin') }}/api/v1/dictionaries/countries
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Страны' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title mb-1">
                                    {{ __( 'Промокоды' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- responsive -->
                                <div class="table-responsive pt-3 mb-4">

                                    <!-- table -->
                                    <table class="table table-dark table-dark-api">

                                        <thead>
                                        <tr>
                                            <th width="40%">URL</th>
                                            <th width="10%">Method</th>
                                            <th width="20%">Query</th>
                                            <th width="30%">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/promocode/valid/{PROMOCODE}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        PROMOCODE={PROMOCODE}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Проверить промокод' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-top">
                                                {{ settings('site_url') }}/api/v1/promocode/apply/{PROMOCODE}
                                            </td>
                                            <td class="align-top">
                                                GET
                                            </td>
                                            <td class="align-top text-wrap">
                                                <ul class="mb-0 list-unstyled">
                                                    <li>
                                                        token={TOKEN}
                                                    </li>
                                                    <li>
                                                        PROMOCODE={PROMOCODE}
                                                    </li>
                                                    <li>
                                                        user={ID USER}
                                                    </li>
                                                    <li>
                                                        product={ID PRODUCT}
                                                        <br><br>
                                                        (Если указать ID продукта, тогда будет возвращен результат только по этому продукту. Если не указывать ID продукта, будет возвращен результат всей корзины.)
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="align-top text-wrap">
                                                <p class="card-description mb-0">
                                                    {{ __( 'Применить промокод' ) }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <!-- end table -->

                                </div>
                                <!-- end responsive -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Row -->

                </div>
                <!-- end tab general -->

            </div>
            <!-- end tab content -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection

@push( 'style' )
    <style>
        .table-dark-api ul {
            padding-left: 0;
            margin-left: 0;
        }
        .table-dark-api ul li:not(:last-child) {
            margin-bottom: 8px;
        }
    </style>
@endpush
