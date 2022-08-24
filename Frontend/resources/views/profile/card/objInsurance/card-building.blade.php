<form
        action="{{ isset($home->id) ? route('obj.insurance.home.update', $home->id) :  route('obj.insurance.home.save')}}"
        method="post"
        enctype="multipart/form-data"
        class="formObjInsuranceHome"
        novalidate
>
@csrf

<!-- head -->
<div class="cabinet__personal-item__head">

    <!-- title -->
    <div class="cabinet__personal-item__title">
        {{ __( 'Ваша недвижимость' ) }}
    </div>
    <!-- end title -->

    <!-- btn -->
    <button class="cabinet__personal-item__edit update-building" type="button">
        {{ __( 'Изменить' ) }}
    </button>
    <!-- end btn -->

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
                    {{ __( 'Форма недвижимости' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($building) ? $building->realEstateForm() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper select-wrapper">
                        <select name="real_estate_form">
                            <option value="" selected>{{ __( 'Форма недвижимости' )}}</option>
                            <option value="proprietary" @if(isset($building) && $building->real_estate_form === 'proprietary') selected @endif>{{ __( 'Собственное' ) }}</option>
                            <option value="rented"  @if(isset($building) && $building->real_estate_form === 'rented') selected @endif>{{ __( 'Арендованное' ) }}</option>
                        </select>
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
                    {{ __( 'Тип имущества' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($building) ? $building->propertyType() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper select-wrapper">
                        <select name="property_type">
                            <option value="" selected>{{ __( 'Тип имущества' )}}</option>
                            <option value="apartment" @if(isset($building) && $building->property_type === 'apartment') selected @endif>{{ __( 'Квартира' ) }}</option>
                            <option value="house" @if(isset($building) && $building->property_type === 'house') selected @endif>{{ __( 'Жилой дом' ) }}</option>
                        </select>
                    </div>
                    <!-- end wrapper -->
                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->


        </div>
        <!-- end groups -->


        <div class="cabinet__personal-item__param-groups">


            <!-- group -->
            <div class="cabinet__personal-item__param-group wide">

                <!-- label -->
                <div class="cabinet__personal-item__param-label">
                    {{ __( 'Адрес недвижимости (на украинском)' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($building) ? $building->countryCity() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper select-wrapper">
                        <select name="country_id" class="country">
                           <option  selected="selected" data-code="{{ $country->code }}" data-id="{{ $country->id }}" value="{{ $country->id }}" >{{ $country->country_name_ru }}</option>
                        </select>
                    </div>
                    <!-- end wrapper -->

                    <div class="input-wrapper select-wrapper">
                        <select name="city_id" class="city js-example-data-array">
                            <option value="" selected>{{ __( 'Города' ) }}</option>
                        </select>
                    </div>

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="address"
                                value="{{ isset($building->address) ? $building->address : '' }}"
                                placeholder="{{ __( 'Введите ваш адрес' ) }}"
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
    <!-- end content -->

</div>
<!-- end body -->
</form>
