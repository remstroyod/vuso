<!-- Modal Auth -->
<div
    class="modal fade modal-auth"
    id="modal-auth"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
>

    <!-- overlay -->
    <div class="modal-overlay" data-bs-dismiss="modal"></div>
    <!-- end overlay -->

    <!-- dialog -->
    <div class="modal-dialog modal-dialog-centered">

        <!-- content -->
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">

                <!-- Title -->
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __( 'Вход/Регистрация' ) }}
                </h5>
                <!-- End Title -->

                <button
                    type="button"
                    class="modal-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>
            <!-- end header -->

            <!-- body -->
            <div class="modal-body authPopup">
                <!--

                1. по умолчанию все auth-group без .active и .hidden

                2. по сабмиту на авторизацию телефоном, остальные группы скрываются а ей добавляется активный класс чтобы убрать бордеры и растянуть на всю высоту

                3. по умолчанию auth-group__phone-subgroup c .hidden, активна первая группа введения телефона, переключение классом актив

                4. кнопки auth-group__phone-subgroup__step-btn переключают класс на соответсвующую подгруппу

                -->

                <!-- <div class="auth-group auth-group__messenger hidden"> -->
                <div class="auth-group auth-group__messenger">

                    <!-- title -->
                    <div class="auth-group__messenger-title">
                        {{ __( 'Чтобы продолжить, пожалуйста, авторизируйтесь' ) }}
                    </div>
                    <!-- end title -->

                </div>

                <!-- Form Group -->
                <div class="auth-group auth-group__phone">

                    <!-- title -->
                    <div class="auth-group__phone-title">
                        {{ __( 'С помощью номера телефона' ) }}
                    </div>
                    <!-- end title -->

                    <!-- form phone -->
                    <div class="auth-group__phone-subgroup auth-group__phone-subgroup__initial active authCellFormPhone">
                        @include( 'forms.auth.auth-sms' )
                    </div>
                    <!-- end form phone -->

                    <!-- form sms code -->
                    <div class="auth-group__phone-subgroup auth-group__phone-subgroup__sms-password authCellFormCode">

                        {{--This Ajax--}}

                    </div>
                    <!-- end form sms code -->

                    <!-- form store password -->
                    <div class="auth-group__phone-subgroup auth-group__phone-subgroup__create-password authCellFormStorePassword">

                        {{--This Ajax--}}

                    </div>
                    <!-- end form store password -->


                    <!-- form enter password -->
                    <div class="auth-group__phone-subgroup auth-group__phone-subgroup__confirm-password authCellFormEnterPassword">

                        {{--This Ajax--}}

                    </div>
                    <!-- end form enter password -->

                </div>
                <!-- End Form Group -->

                <!-- service -->
                <div class="auth-group auth-group__service">

                    <!-- title -->
                    <div class="auth-group__service-title">
                        {{ __( 'Или с помощью' ) }}
                    </div>
                    <!-- end title -->

                    <!-- list -->
                    <div class="auth-group__service-list">

                        <!-- Facebook -->
                        <a
                            href="{{ route('auth.provider', ['provider' => 'facebook']) }}"
                            rel="noindex nofollow noreferrer"
                            class="auth-group__service-item"
                        >
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="#3B5998"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6667 25.4077V16.7028H20.0696L20.388 13.7031H17.6667L17.6707 12.2017C17.6707 11.4193 17.7451 11.0001 18.8688 11.0001H20.371V8H17.9677C15.081 8 14.065 9.4552 14.065 11.9024V13.7034H12.2656V16.7031H14.065V25.4077H17.6667Z" fill="white"/>
                            </svg>
                        </a>
                        <!-- End Facebook -->

                        <!-- Google -->
                        <a
                            href="{{ route('auth.provider', ['provider' => 'google']) }}"
                            rel="noindex nofollow noreferrer"
                            class="auth-group__service-item"
                        >
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M31.688 16.3683C31.688 15.2807 31.5998 14.1872 31.4117 13.1172H16.3199V19.2785H24.9623C24.6036 21.2656 23.4513 23.0235 21.764 24.1405V28.1383H26.92C29.9478 25.3516 31.688 21.2362 31.688 16.3683Z" fill="#4285F4"/>
                                <path d="M16.32 32.0014C20.6352 32.0014 24.2744 30.5846 26.9259 28.1389L21.7699 24.1411C20.3354 25.117 18.4835 25.6696 16.3259 25.6696C12.1517 25.6696 8.61246 22.8535 7.34257 19.0674H2.02197V23.1886C4.73812 28.5915 10.2704 32.0014 16.32 32.0014V32.0014Z" fill="#34A853"/>
                                <path d="M7.33667 19.0666C6.66645 17.0795 6.66645 14.9277 7.33667 12.9406V8.81934H2.02195C-0.247388 13.3404 -0.247388 18.6668 2.02195 23.1879L7.33667 19.0666V19.0666Z" fill="#FBBC04"/>
                                <path d="M16.32 6.33288C18.6011 6.29761 20.8057 7.15596 22.4578 8.73156L27.0258 4.16349C24.1333 1.44734 20.2942 -0.0459547 16.32 0.00107822C10.2704 0.00107822 4.73812 3.41096 2.02197 8.81974L7.33669 12.941C8.6007 9.14897 12.1458 6.33288 16.32 6.33288V6.33288Z" fill="#EA4335"/>
                            </svg>
                        </a>
                        <!-- end Google -->

                        <!-- Apple -->
                        <a
                            href="{{ route('auth.provider', ['provider' => 'apple']) }}"
                            rel="noindex nofollow noreferrer"
                            class="auth-group__service-item"
                        >
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="#151826"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4402 8.92219C19.0416 8.16439 19.4975 7.09331 19.3326 6C18.3497 6.06668 17.2009 6.68054 16.5306 7.48067C15.9195 8.20567 15.4173 9.28416 15.6134 10.3309C16.6879 10.3637 17.7969 9.73503 18.4402 8.92219Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.75 19.2064C23.32 20.1421 23.1131 20.5601 22.5592 21.3888C21.7864 22.5456 20.6969 23.9861 19.3454 23.9967C18.146 24.0094 17.8367 23.2293 16.2082 23.2389C14.5798 23.2473 14.2403 24.0115 13.0387 23.9998C11.6883 23.9882 10.6559 22.6885 9.88319 21.5317C7.72131 18.2994 7.49391 14.5051 8.82704 12.4868C9.77542 11.0537 11.2713 10.2155 12.6766 10.2155C14.1067 10.2155 15.0066 10.986 16.191 10.986C17.3398 10.986 18.0393 10.2134 19.6935 10.2134C20.9458 10.2134 22.2725 10.8833 23.2166 12.0391C20.1214 13.705 20.6225 18.0454 23.75 19.2064Z" fill="white"/>
                            </svg>
                        </a>
                        <!-- End Apple -->

                    </div>
                    <!-- end list -->

                </div>
                <!-- end service -->

                <!-- policy -->
                <div class="auth-group auth-group__policy">
                    {{ __( 'Продолжая, Вы соглашаетесь с' ) }} <a href="/" target="_blank">{{ __( 'Политикой конфиденциальности' ) }}</a>
                </div>
                <!-- end policy -->

            </div>
            <!-- end body -->

        </div>
        <!-- end content -->

    </div>
    <!-- end dialog -->

</div>
<!-- End Modal Auth -->
