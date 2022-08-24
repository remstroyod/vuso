<!-- head -->
<div class="cabinet__personal-item__head">

    <!-- title -->
    <div class="cabinet__personal-item__title">
        {{ __( 'Подключенные сервисы' ) }}
    </div>
    <!-- end title -->

    <!-- trigger -->
    <div
            class="popover-trigger"
            data-bs-toggle="popover"
            data-bs-placement="bottom"
            data-bs-trigger="hover focus"
            title="{{ __( 'Popover title' ) }}"
            data-bs-content="{{ __( 'And here is some amazing content. It is very engaging. Right?' ) }}"
    ></div>
    <!-- end trigger -->

</div>

<!-- end head -->

<!-- body -->
<div class="cabinet__personal-item__body">

    <!-- content -->
    <div class="cabinet__personal-item__content">

        <!-- excerpt -->
        <div class="cabinet__personal-item__content-descr">
            {{ __( 'Вы можете подключить сервисы, чтобы авторизоваться с их помощью при повторном входе в личный кабинет' ) }}
        </div>
        <!-- end excerpt -->

        <!-- services -->
        <div class="cabinet__personal-item__services">

            @foreach( $providers as $key => $value )

                @if( $user->provider($key)->exists() )

                    <button class="cabinet__personal-item__service {{ $key }} active">
                        {{ $value }}
                    </button>

                @else

                    <a href="{{ route('auth.provider', $key) }}" class="cabinet__personal-item__service {{ $key }}">
                        {{ $value }}
                    </a>

                @endif

            @endforeach

        </div>
        <!-- end services -->

    </div>
    <!-- end content -->

</div>
<!-- end body -->
