<!-- Form -->
<form
        action="{{ route('forms.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="consult__order-form ajaxForm"
>
    @csrf

    <input
            type="hidden"
            value="{{ $forms->consultation }}"
            name="type"
    >

    <input type="hidden" name="message" class="formConsultationTimeValue">

    <!-- day -->
    <div class="consult__order-day formConsultationTimeDate">

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    checked
                    data-value="{{ Date::now()->format('d.m.Y') }}"
            />
            <span>{{ __( 'Сегодня' ) }}</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('1 day')->format('d.m.Y') }}"
            />
            <span>{{ __( 'Завтра' ) }} ({{ Date::now()->add('1 day')->format('d.m') }})</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('2 day')->format('d.m.Y') }}"
            />
            <span>{{ __( 'Послезавтра' ) }} ({{ Date::now()->add('2 day')->format('d.m') }})</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('3 day')->format('d.m.Y') }}"
            />
            <span>{{ Date::now()->add('3 day')->format('d.m') }}</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    disabled
                    data-value="{{ Date::now()->add('4 day')->format('d.m.Y') }}"
            />
            <span>{{ Date::now()->add('4 day')->format('d.m') }}</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('5 day')->format('d.m.Y') }}"
            />
            <span>{{ Date::now()->add('5 day')->format('d.m') }}</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('6 day')->format('d.m.Y') }}"
            />
            <span>{{ Date::now()->add('6 day')->format('d.m') }}</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-date"
                    hidden
                    data-value="{{ Date::now()->add('7 day')->format('d.m.Y') }}"
            />
            <span>{{ Date::now()->add('7 day')->format('d.m') }}</span>
        </label>
        <!-- end label -->

    </div>
    <!-- end day -->

    <!-- time -->
    <div class="consult__order-time formConsultationTimeTime">

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-time"
                    hidden
                    disabled
                    data-value="12:30-13:00"
            />
            <span>12:30-13:00</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-time"
                    hidden
                    checked
                    data-value="14:30-15:00"
            />
            <span>14:30-15:00</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-time"
                    hidden
                    data-value="15:30-16:00"
            />
            <span>15:30-16:00</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-time"
                    hidden
                    data-value="16:30-17:00"
            />
            <span>16:30-17:00</span>
        </label>
        <!-- end label -->

        <!-- label -->
        <label class="radio-label">
            <input
                    type="radio"
                    name="consult-time"
                    hidden
                    data-value="17:30-18:00"
            />
            <span>17:30-18:00</span>
        </label>
        <!-- end label -->

    </div>
    <!-- end time -->

    <input
            type="text"
            class="consult__order-name"
            placeholder="{{ __( 'Имя' ) }}"
            name="name"
            required
            pattern="^[A-Za-zА-Яа-яЁё\s]+$"
    />

    <button
            class="btn grey consult__order-submit"
            type="submit"
    >
        {{ __( 'Забронировать консультацию' ) }}
    </button>

    @include( 'partials.message' )

    @include( 'forms.bitrix.bitrix-input' )

</form>
<!-- End Form -->
