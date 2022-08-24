<!-- personal -->
<div class="cabinet__group cabinet__personal">

    <!-- title -->
    <div class="cabinet__group-title">
        {{ __( 'Мои данные' ) }}
    </div>
    <!-- end title -->

    <!-- list -->
    <div class="cabinet__group-content cabinet__personal-list">

        <!-- item -->
        <div class="cabinet__personal-item cabinet__personal-item--person personCard">

            @include( 'profile.card.card-person' )

        </div>
        <!-- end item -->

        <!-- item -->
        <div class="cabinet__personal-item">

            @include( 'profile.card.card-providers' )

        </div>
        <!-- end item -->

         @if(!empty($persons))
             @foreach($persons as $person)
                 <div class="cabinet__personal-item" data-id="{{'person'.$person->id}}">
                     @include( 'profile.card.objInsurance.edit-person',$person)
                 </div>
             @endForeach
         @endif

        @if(!empty($cars))
             @foreach($cars as $car)
                 <div class="cabinet__personal-item" data-id="{{'car'.$car->id}}">
                     @include( 'profile.card.objInsurance.card-car', $car)
                 </div>
             @endForeach
         @endif

        @if(!empty($buildings))
             @foreach($buildings as $building)
                 <div class="cabinet__personal-item" data-id="{{'building'.$building->id}}">
                     @include( 'profile.card.objInsurance.card-building', $building)
                 </div>
             @endForeach
         @endif

        <div class="cabinet__personal-item d-none obj_insurance" id="new-person">
            @include( 'profile.card.objInsurance.add-person' )
        </div>

        <div class="cabinet__personal-item d-none obj_insurance" id="new-car">
            @include( 'profile.card.objInsurance.card-car', ['car' => null] )
        </div>

        <div class="cabinet__personal-item d-none obj_insurance" id="new-building">
            @include( 'profile.card.objInsurance.card-building', ['building' => null] )
        </div>

        <div class="objPerson d-none"></div>

        <!-- end item -->

        <!-- create -->
        <div class="cabinet__personal-create">

            <!-- btn -->
            <button class="cabinet__personal-create__btn cabinet__personal-create__btn--car">
                {{ __( 'Добавить еще один автомобиль' ) }}
            </button>
            <!-- end btn -->

            <!-- btn -->
            <button class="cabinet__personal-create__btn cabinet__personal-create__btn--person">
                {{ __( 'Добавить еще информацию о близком человеке' ) }}
            </button>
            <!-- end btn -->

            <!-- btn -->
            <button class="cabinet__personal-create__btn cabinet__personal-create__btn--estate">
                {{ __( 'Добавить информацию о недвижимости' ) }}
            </button>
            <!-- end btn -->

        </div>
        <!-- end create -->

        <!-- overlay -->
        <div class="cabinet__personal-overlay"></div>
        <!-- end overlay -->

    </div>
    <!-- end list -->

</div>
<!-- end personal -->
