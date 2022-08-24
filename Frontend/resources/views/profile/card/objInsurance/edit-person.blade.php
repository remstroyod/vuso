<form
        action="{{ route('obj.insurance.person.update', $person->id) }}"
        method="post"
        enctype="multipart/form-data"
        class="formObjInsurancePerson"
        novalidate
>
    @csrf

    <!-- head -->
    <div class="cabinet__personal-item__head">

        <!-- title -->
        <div class="cabinet__personal-item__title">
            {{ $person->fullName() }}
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
                        {{ $person->fullName() }}
                    </div>
                    <!-- end value -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="last_name"
                                    value="{{ $person->last_name }}"
                                    placeholder="{{ __( 'Введите вашу фамилию' )}}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="first_name"
                                    value="{{ $person->first_name }}"
                                    placeholder="{{ __( 'Введите ваше имя' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="middle_name"
                                    value="{{ $person->middle_name }}"
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
                        {{ $person->phone_number }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="phone"
                                    name="phone_number"
                                    value="{{ $person->phone_number }}"
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
                        {{ Date::parse($person->birthday)->format('j F Y') }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="birthday"
                                    value="{{ Date::parse($person->birthday)->format('d.m.Y') }}"
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
                        {{ $person->mail }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="email"
                                    name="mail"
                                    value="{{ $person->mail }}"
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
                        {{ $person->address_string }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs address-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="address_string"
                                    value="{{ $person->address_string }}"
                                    placeholder="{{ __( 'Введите ваш город' ) }}"
                            >
                        </div>

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
                        {{ $person->ukr_passport }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="ukr_passport"
                                    value="{{ $person->ukr_passport }}"
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
                        {{ __( 'Идентификатор lk' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $person->lk_Id }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="lk_Id"
                                    value="{{ $person->lk_Id }}"
                                    placeholder="Введите идентификатор lk"
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
                        {{ __( 'Код' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $person->code }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="code"
                                    value="{{ $person->code }}"
                                    placeholder="Введите код"
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
                        {{ __( 'ИНН' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $person->INN }}
                    </div>
                    <!-- end value -->


                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="INN"
                                    value="{{ $person->INN }}"
                                    placeholder="{{ __( 'Введите ваш ИНН' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->


                <div class="cabinet__personal-item__param-group wide">

                    <!-- label -->
                    <div class="cabinet__personal-item__param-label">
                        {{ __( 'Загранпаспорт' ) }}
                    </div>
                    <!-- end label -->

                    <!-- value -->
                    <div class="cabinet__personal-item__param-value">
                        {{ $person->international_passport }}
                    </div>
                    <!-- end value -->

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="international_passport"
                                    value="{{ $person->international_passport }}"
                                    placeholder="{{ __( 'Введите загранпаспорт' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                    </div>
                    <!-- end inputs -->

                </div>
                <!-- end group -->

            </div>
            <!-- end groups -->

        </div>

        <!-- toggler -->
        <button class="cabinet__personal-item__toggler"  type="button">
            <span>{{ __( 'Показать всю информацию' ) }}</span>
            <span>{{ __( 'Скрыть дополнительную информацию' ) }}</span>
        </button>
        <!-- end toggler -->

    </div>
    <!-- end body -->

</form>
