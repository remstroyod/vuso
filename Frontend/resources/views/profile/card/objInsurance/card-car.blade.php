<form
        action="{{ isset($car->id) ? route('obj.insurance.car.update', $car->id) :  route('obj.insurance.car.save')}}"
        method="post"
        enctype="multipart/form-data"
        class="formObjInsuranceCar"
        novalidate
>
@csrf

<!-- head -->
<div class="cabinet__personal-item__head">

    <!-- title -->
    <div class="cabinet__personal-item__title">
        {{ __( 'Транспортное средство' ) }}
    </div>
    <!-- end title -->

    <!-- btn -->
    <button class="cabinet__personal-item__edit" type="button">
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
                    {{ __( 'Марка и модель' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car) ? $car->carFullName() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper select-wrapper">
                        <select name="mark" class="auto-mark">
                            @foreach( $marks as $value )
                                <option value="{{ $value->id }}" @if($car && $car->mark == $value->id ) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- end wrapper -->

                    <div class="input-wrapper select-wrapper">

                        <select name="model" class="auto-model">
                            <option value="" selected>Модель автомобиля</option>
                            @if(isset($car->model))
                              <option value="{{isset($car->model) ? $car->model : '' }}"  selected>{{ isset($car->models) ? $car->models->name : '' }}</option>
                            @endif
                        </select>

                    </div>

                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->

            <!-- group -->
            <div class="cabinet__personal-item__param-group">

                <!-- label -->
                <div class="cabinet__personal-item__param-label">
                    {{ __( 'Год выпуска' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->year) ? $car->year : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">


                    <!-- wrapper -->
                    <div class="input-wrapper select-wrapper">
                        <select name="year">
                            @foreach( $years as $value )
                                <option value="{{ $value }}" @if($car && $car->year == $value ) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
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
                    {{ __( 'Гос. номер' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->reg_num) ? $car->reg_num : '' }}
                </div>
                <!-- end value -->


                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="reg_num"
                                value="{{ isset($car->reg_num) ? $car->reg_num : '' }}"
                                placeholder="{{ __( 'Введите гос.номер' ) }}"
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
                    {{ __( 'Коробка передач' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->type) ? $car->transmissionName() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <div class="input-wrapper select-wrapper">
                        <select name="type">
                            @foreach( $transmissions as $key => $value )
                                <option value="{{ $value->value }}" @if($car && $car->type == $value->value ) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->

            <!-- group -->
            <div class="cabinet__personal-item__param-group">

                <!-- label -->
                <div class="cabinet__personal-item__param-label">
                    {{ __( 'Пробег' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->run) ? $car->run : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="number"
                                min="1"
                                name="run"
                                value="{{ isset($car->run) ? $car->run : '' }}"
                                placeholder="{{ __( 'Введите пробег автомобиля' ) }}"
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
                    {{ __( 'Тип и категория транспортного средства' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->cargo) ? $car->tsTypeName() : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <div class="input-wrapper select-wrapper">
                        <select name="cargo">
                            @foreach( $tsTypes as $value )
                                <option value="{{ $value->value }}" @if($car && $car->cargo == $value->value ) selected @endif>{{ $value->ru_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->

            <!-- group -->
            <div class="cabinet__personal-item__param-group wide">

                <!-- label -->
                <div class="cabinet__personal-item__param-label">
                    {{ __( 'Номер кузова (VIN код)' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->vin) ? $car->vin : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="vin"
                                value="{{ isset($car->vin) ? $car->vin : '' }}"
                                placeholder="{{ __( 'Введите вин автомобиля' ) }}"
                        >
                    </div>
                    <!-- end wrapper -->

                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->

            {{--            <!-- group -->--}}
            <div class="cabinet__personal-item__param-group wide">

                <!-- label -->
                <div class="cabinet__personal-item__param-label">
                    {{ __( 'Примерная стоимость' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{-- {{ isset($car->cost) ? priceFormat($car->cost) : '' }} --}}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">


                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="cost"
                                value="{{ isset($car->cost) ? $car->cost : '' }}"
                                placeholder="{{ __( 'стоимость автомобиля' ) }}"
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
                    {{ __( 'Объём двигателя' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->engine_volume) ? $car->engine_volume . ' см.куб.' : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="engine_volume"
                                value="{{ isset($car->engine_volume) ? $car->engine_volume : '' }}"
                                placeholder="{{ __( 'Введите объём двигателя, куб.см' ) }}"
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
                    {{ __( 'Пассажиры' ) }}
                </div>
                <!-- end label -->

                <!-- value -->
                <div class="cabinet__personal-item__param-value">
                    {{ isset($car->tumber_passengers) ? $car->tumber_passengers : '' }}
                </div>
                <!-- end value -->

                <!-- inputs -->
                <div class="cabinet__personal-item__param-inputs">

                    <!-- wrapper -->
                    <div class="input-wrapper">
                        <input
                                type="text"
                                name="number_passengers"
                                value="{{ isset($car->number_passengers) ? $car->number_passengers : '' }}"
                                placeholder="{{ __( 'Введите пассажиры' ) }}"
                        >
                    </div>
                    <!-- end wrapper -->

                </div>
                <!-- end inputs -->

            </div>
            <!-- end group -->

        </div>
        <!-- end groups -->

        <!-- toggler -->
        <button class="cabinet__personal-item__toggler"  type="button">
            <span>{{ __( 'Показать всю информацию' ) }}</span>
            <span>{{ __( 'Скрыть дополнительную информацию' ) }}</span>
        </button>
        <!-- end toggler -->


    </div>
    <!-- end content -->

</div>
<!-- end body -->
</form>
