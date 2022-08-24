<!-- form -->
<form
        action="{{ route('forms.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="footer__search__form ajaxForm"
>
    @csrf

    <input
            type="hidden"
            value="{{ $forms->question }}"
            name="type"
    >
    <input
            type="text"
            placeholder="{{ __( 'Возник вопрос?' ) }}"
            name="message"
            required
            pattern="[^ @]*@[^ @]*"
            class="ask-input showAfterSubmit"
            autocomplete="off"
            value=""
    >
    <input
            type="email"
            placeholder="{{ __( 'Ваш email' ) }}"
            required
            class="mail-input hidden hideAfterSubmit"
            autocomplete="off"
            pattern="[^ @]*@[^ @]*"
            name="email"
            value=""
    >

    {!! app('captcha')->renderCaptchaHTML() !!}

    <button type="submit" class="footer-form-submit"></button>

    @include( 'partials.message' )

    @include( 'forms.bitrix.bitrix-input' )

</form>
<!-- end form -->
