<form
        action="{{ route('profile.person.save') }}"
        method="post"
        enctype="multipart/form-data"
        class="formProfilePerson"
        novalidate
>
    @csrf

    <!-- head -->
    <div class="cabinet__personal-item__head">

        <!-- title -->
        <div class="cabinet__personal-item__title">
            {{ __( 'Личная информация' ) }}
        </div>
        <!-- end title -->

        <!-- edit -->
        <button class="cabinet__personal-item__edit" type="button">
            {{ __( 'Изменить' ) }}
        </button>
        <!-- end edit -->

        <!-- submit -->
        <button class="cabinet__personal-item__submit" type="submit">
            <span>{{ __( 'Сохранить изменения' ) }}</span>
        </button>
        <!-- end submit -->

    </div>
    <!-- end head -->

    <!-- body -->
    <div class="cabinet__personal-item__body">

        <!-- content -->
        <div class="cabinet__personal-item__content">

            <!-- groups -->
            <div class="cabinet__personal-item__param-groups">

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'ФИО (на украинском)' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->fullName() }}
                    </div>
                    <!-- end value -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="last_name"
                                    value="{{ $userDetail->last_name }}"
                                    placeholder="{{ __( 'Введите вашу фамилию' )}}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="first_name"
                                    value="{{ $userDetail->first_name }}"
                                    placeholder="{{ __( 'Введите ваше имя' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="middle_name"
                                    value="{{ $userDetail->middle_name }}"
                                    placeholder="{{ __( 'Введите ваше отчество' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end value -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Телефон' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->phone }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="phone"
                                    name="phone"
                                    value="{{ $userDetail->phone }}"
                                    placeholder="{{ __( 'Введите ваш телефон' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Дата рождения' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ Date::parse($userDetail->birthday)->format('j F Y') }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="birthday"
                                    value="{{ Date::parse($userDetail->birthday)->format('d.m.Y') }}"
                                    placeholder="{{ __( 'Введите дату рождения' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'E-mail' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $user->email }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="email"
                                    name="email"
                                    value="{{ $user->email }}"
                                    placeholder="{{ __( 'Введите вашу почту' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

            </div>
            <!-- end groups -->

            <!-- groups -->
            <div class="cabinet__personal-item__param-groups hidden">

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Адрес прописки' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->fullAddress() }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs address-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="city"
                                    value="{{ $userDetail->city }}"
                                    placeholder="{{ __( 'Введите ваш город' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper select-wrapper street-type-wrapper">

                            <select name="type_street">
                                @foreach( $type_street as $key => $value )
                                    <option value="{{ $key }}" @if( $userDetail->type_street == $key ) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper street-name-wrapper">
                            <input
                                    type="text"
                                    name="street"
                                    value="{{ $userDetail->street }}"
                                    placeholder="{{ __( 'Введите вашу улицу' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper building-number-wrapper">
                            <input
                                    type="text"
                                    name="house_number"
                                    value="{{ $userDetail->house_number }}"
                                    placeholder="{{ __( 'Введите номер дома' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper apartment-number-wrapper">
                            <input
                                    type="text"
                                    name="apartment_number"
                                    value="{{ $userDetail->apartment_number }}"
                                    placeholder="{{ __( 'Введите номер квартиры' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Номер паспорта' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->passport_id }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="passport_id"
                                    value="{{ $userDetail->passport_id }}"
                                    placeholder="Введите номер паспорта"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'ИНН' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->identification_number }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="identification_number"
                                    value="{{ $userDetail->identification_number }}"
                                    placeholder="{{ __( 'Введите ваш ИНН' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

            </div>
            <!-- end groups -->

            <!-- groups -->
            <div class="cabinet__personal-item__param-groups hidden">

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Имя и фамилия в загранпаспорте (на латинице)' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->internationalFullName() }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="international_last_name"
                                    value="{{ $userDetail->international_last_name }}"
                                    placeholder="{{ __( 'Введите фамилию в загранпаспорте' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="international_first_name"
                                    value="{{ $userDetail->international_first_name }}"
                                    placeholder="{{ __( 'Введите имя в загранпаспорте' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
                <div class="cabinet__personal-item__param-group wide international-passport-group">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Загранпаспорт' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $userDetail->international_passport }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="international_passport"
                                    value="{{ $userDetail->international_passport }}"
                                    placeholder="{{ __( 'Введите загранпаспорт' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

                <!-- group -->
{{--                <div class="cabinet__personal-item__param-group wide">--}}

{{--                    <!-- label -->--}}
{{--                    <div class="cabinet__personal-item__param-label">--}}
{{--                        {{ __( 'Серия загранпаспорта' ) }}--}}
{{--                    </div>--}}
{{--                    <!-- end label -->--}}

{{--                    <!-- value -->--}}
{{--                    <div class="cabinet__personal-item__param-value">--}}
{{--                        {{ $userDetail->international_passport_series }}--}}
{{--                    </div>--}}
{{--                    <!-- end value -->--}}

{{--                    <!-- inputs -->--}}
{{--                    <div class="cabinet__personal-item__param-inputs">--}}

{{--                        <!-- wrapper -->--}}
{{--                        <div class="input-wrapper">--}}
{{--                            <input--}}
{{--                                    type="text"--}}
{{--                                    name="international_passport_series"--}}
{{--                                    value="{{ $userDetail->international_passport_series }}"--}}
{{--                                    placeholder="{{ __( 'Введите серию загранпаспорта' ) }}"--}}
{{--                            >--}}
{{--                        </div>--}}
{{--                        <!-- end wrapper -->--}}

{{--                    </div>--}}
{{--                    <!-- end inputs -->--}}

{{--                </div>--}}
                <!-- end group -->

            </div>
            <!-- end groups -->

        </div>
        <!-- end content -->

        <!-- toggler -->
        <button class="cabinet__personal-item__toggler"  type="button">
            <span>{{ __( 'Показать всю информацию' ) }}</span>
            <span>{{ __( 'Скрыть дополнительную информацию' ) }}</span>
        </button>
        <!-- end toggler -->

    </div>
    <!-- end body -->

</form>
