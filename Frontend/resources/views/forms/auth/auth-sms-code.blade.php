<!-- Form -->
<form
        action="{{ route('auth.web.sms.code', []) }}"
        method="post"
        enctype="multipart/form-data"
        class="auth-group__phone-subgroup__confirm auth-group__phone-subgroup__confirm--sms-form authPhoneCode"
>
    @csrf

    <input
            type="text"
            name="phone"
            class="auth-group__phone-subgroup__selected-input"
            data-selected-phone-input
            value="{{ $phone }}"
            readonly
    >

    <!-- annotation -->
    <div class="auth-group__phone-subgroup__annotation">
        {{ __( 'Мы отправили смс с одноразовым кодом на номер :Phone, пожалуйста введите его', ['phone' => $phone] ) }}
    </div>
    <!-- end annotation -->

    <!-- confirm -->
    <div class="auth-group__phone-subgroup__confirm-row">

        <!-- label -->
        <label class="auth-group__phone-subgroup__confirm-label">
            {{ __( 'Код из смс' ) }}
        </label>
        <!-- end label -->

        <input
                type="text"
                class="auth-group__phone-subgroup__confirm-input"
                name="sms_code"
        >

        <button
                type="submit"
                class="auth-group__phone-subgroup__confirm-submit"
        ></button>

    </div>
    <!-- end confirm -->

    @include( 'partials.message' )

    <!-- resend -->
    <button class="auth-group__phone-subgroup__resend-btn btnResendSmsCode">
        <span>{{ __( 'Отправить новый код' ) }}</span> <span class="smsCodeTimer">{!! __( 'через :Seconds сек', ['seconds' => 30 ] ) !!}</span>
    </button>
    <!-- end resend -->

    @if( empty($user->password) )
        <!-- create-password -->
        <button
                class="auth-group__phone-subgroup__step-btn auth-group__phone-subgroup__create-password-btn btnFormCreatePassword"
                data-url="{{ route('auth.create.password.form', ['user' => $user, 'phone' => $phone]) }}"
        >
            {{ __( 'Создать пароль вместо одноразового кода' ) }}
        </button>
        <!-- end create-password -->
    @else
        <!-- enter-password -->
        <button
                class="auth-group__phone-subgroup__step-btn auth-group__phone-subgroup__switch-to-password-btn btnFormEnterPassword"
                data-url="{{ route('auth.enter.password.form', ['user' => $user, 'phone' => $phone]) }}"
        >
            {{ __( 'Ввести пароль вместо одноразового кода' ) }}
        </button>
        <!-- end enter-password -->
    @endif

</form>
<!-- End Form -->
