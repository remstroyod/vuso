<!-- Form -->
<form
        action="@if( isset( $scrollTo ) ) {{ route('search', $scrollTo) }} @else {{ route('search') }} @endif"
        method="get"
        enctype="multipart/form-data"
        class="search @isset($class) {{ $class }} @endisset"
>

    <input
            type="text"
            placeholder="{{ __( 'Поиск' ) }}"
            name="q"
            required
            value="{{ request()->q }}"
    >

    <button type="submit"></button>

    @include( 'partials.message' )

</form>
<!-- End Form -->
