<form
        action="{{ route('obj.insurance.person.save') }}"
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
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="last_name"
                                    placeholder="{{ __( 'Введите вашу фамилию' )}}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="first_name"
                                    placeholder="{{ __( 'Введите ваше имя' ) }}"
                            >
                        </div>
                        <!-- end wrapper -->

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="middle_name"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="phone"
                                    name="phone_number"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="birthday"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="email"
                                    name="mail"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs address-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="address_string"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="ukr_passport"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="lk_Id"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="code"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="INN"
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

                    <!-- inputs -->
                    <div class="cabinet__personal-item__param-inputs">

                        <!-- wrapper -->
                        <div class="input-wrapper">
                            <input
                                    type="text"
                                    name="international_passport"
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

    </div>
    <!-- end body -->

</form>
