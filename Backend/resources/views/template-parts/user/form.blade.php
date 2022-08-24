<!-- Row -->
<div class="row">

  @if( request()->routeIs('users.list.create') )

    <!-- Col -->
    <div class="col-lg-12 grid-margin stretch-card">

      <!-- card -->
      <div class="card">

        <!-- card-body -->
        <div class="card-body">

          <!-- Row -->
          <div class="row mb-3">

            <!-- Col -->
            <div class="col-lg-4">

              <!-- form group -->
              <div class="form-group">
                <label for="name">
                  {{ __( 'Логин' ) }}
                </label>
                {!! html_input('text', 'name', '', ['class' => 'form-control', 'id' => 'name']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-4">

              <!-- form group -->
              <div class="form-group">
                <label for="email">
                  {{ __( 'E-mail' ) }}
                </label>
                {!! html_input('text', 'email', '', ['class' => 'form-control', 'id' => 'email']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-4">

              <!-- form group -->
              <div class="form-group">
                <label for="password">
                  {{ __( 'Пароль' ) }}
                </label>
                {!! html_input('password', 'password', '', ['class' => 'form-control', 'id' => 'password']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->

          <!-- fieldset -->
          <fieldset>
            <button type="submit" class="btn btn-primary">
              {{ __( 'Сохранить' ) }}
            </button>
          </fieldset>
          <!-- end fieldset -->

        </div>
        <!-- end card-body -->

      </div>
      <!-- end card -->

    </div>
    <!-- End Col -->

  @else

    <!-- Col -->
    <div class="col-lg-8 grid-margin stretch-card">

      <!-- card -->
      <div class="card">

        <!-- card-body -->
        <div class="card-body">

          <!-- Row -->
          <div class="row mb-3">

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="name">
                  {{ __( 'Логин' ) }}
                </label>
                {!! html_input('text', 'name', isset($user) ? $user->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="email">
                  {{ __( 'E-mail' ) }}
                </label>
                {!! html_input('text', 'email', isset($user) ? $user->email : '', ['class' => 'form-control', 'id' => 'email']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->

          <!-- Title -->
          <h6 class="card-title">
            {{ __( 'Данные' ) }}
          </h6>
          <!-- End Title -->

          <!-- Row -->
          <div class="row mb-3">

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="first_name">
                  {{ __( 'Имя' ) }}
                </label>
                {!! html_input('text', 'first_name', isset($user->detail) ? $user->detail->first_name : '', ['class' => 'form-control', 'id' => 'first_name']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="last_name">
                  {{ __( 'Фамилия' ) }}
                </label>
                {!! html_input('text', 'last_name', isset($user->detail) ? $user->detail->last_name : '', ['class' => 'form-control', 'id' => 'last_name']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->

          <!-- Row -->
          <div class="row mb-3">

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="view_name">
                  {{ __( 'Отображаемое имя' ) }}
                </label>
                {!! html_input('text', 'view_name', isset($user->detail) ? $user->detail->view_name : '', ['class' => 'form-control', 'id' => 'view_name']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="phone">
                  {{ __( 'Телефон' ) }}
                </label>
                {!! html_input('text', 'phone', isset($user->detail) ? $user->detail->phone : '', ['class' => 'form-control', 'id' => 'phone']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->

          <!-- form group -->
          <div class="form-group">
            <label for="website">
              {{ __( 'Web сайт' ) }}
            </label>
            {!! html_input('text', 'website', isset($user->detail) ? $user->detail->website : '', ['class' => 'form-control', 'id' => 'website']) !!}
          </div>
          <!-- end form group -->

          <!-- Row -->
          <div class="row mb-3">

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="country">
                  {{ __( 'Страна' ) }}
                </label>
                {!! html_input('text', 'country', isset($user->detail) ? $user->detail->country : '', ['class' => 'form-control', 'id' => 'country']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

            <!-- Col -->
            <div class="col-lg-6">

              <!-- form group -->
              <div class="form-group">
                <label for="city">
                  {{ __( 'Город' ) }}
                </label>
                {!! html_input('text', 'city', isset($user->detail) ? $user->detail->city : '', ['class' => 'form-control', 'id' => 'city']) !!}
              </div>
              <!-- end form group -->

            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->

          <!-- form group -->
          <div class="form-group">
            <label for="address">
              {{ __( 'Адрес' ) }}
            </label>
            {!! html_input('text', 'address', isset($user->detail) ? $user->detail->address : '', ['class' => 'form-control', 'id' => 'address']) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-group">
            <label for="about">
              {{ __( 'Обо мне' ) }}
            </label>
            {!! html_textarea('about', isset($user->detail) ? $user->detail->about : '', ['class' => 'form-control', 'id'=>'about', 'rows' => 5]) !!}
          </div>
          <!-- end form group -->

          <!-- form group -->
          <div class="form-check form-check-flat form-check-primary">
            <label class="form-check-label">
              {!! html_hidden('is_active', 0) !!}
              {!! html_checkbox('is_active', isset($user) ? $user->is_active : '', ['class' => 'form-check-input', 'value' => 1]) !!}
              {{ __( 'Активный' ) }}
              <i class="input-frame"></i> </label>
          </div>
          <!-- end form group -->

          <!-- fieldset -->
          <fieldset>
            <button type="submit" class="btn btn-primary">
              {{ __( 'Сохранить' ) }}
            </button>
          </fieldset>
          <!-- end fieldset -->

        </div>
        <!-- end card-body -->

      </div>
      <!-- end card -->

    </div>
    <!-- End Col -->

      <!-- Col -->
      <div class="col-lg-4 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

          <!-- card-body -->
          <div class="card-body">

          @role('admin')
          <!-- form group -->
            <div class="form-group mb-5">
              <label for="role">
                {{ __( 'Роль' ) }}
              </label>
              {!! html_select('role', $user->roles()->first()->id, list_data($roles), ['class' => 'custom-select', 'id' => 'role']) !!}
            </div>
            <!-- end form group -->
          @endrole

          <!-- Title -->
            <h6 class="card-title">
              {{ __( 'Изображение' ) }}
            </h6>
            <!-- End Title -->

            <!-- Margin -->
            <div class="mb-5">

              <!-- Image -->
            <p class="card-description">
              {{ __( 'Основное изображение' ) }}
            </p>
            <input
                    type="file"
                    id="imageUpload"
                    name="image"
                    class="border"
                    data-max-file-size="3M"
                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                    @isset( $user->detail )
                    data-default-file="{{ ($user->detail->image) ? url('storage' . '/images/user/' . $user->id . '/' . $user->detail->image) : '' }}"
                    @endisset
            />
            <!-- End Image -->

          </div>
          <!-- End Margin -->

          <!-- Title -->
          <h6 class="card-title">
            {{ __( 'Аватар' ) }}
          </h6>
          <!-- End Title -->

          <!-- Margin -->
          <div class="mb-5">

            <!-- Image -->
            <p class="card-description">
              {{ __( 'Фотография' ) }}
            </p>
            <input
                    type="file"
                    id="avatarUpload"
                    name="avatar"
                    class="border"
                    data-max-file-size="3M"
                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                    @isset( $user->detail )
                    data-default-file="{{ ($user->detail->avatar) ? url('storage' . '/images/user/' . $user->id . '/' . $user->detail->avatar) : '' }}"
                    @endisset
            />
            <!-- End Image -->

          </div>
          <!-- End Margin -->

        </div>
        <!-- end card-body -->

      </div>
      <!-- end card -->

    </div>
    <!-- End Col -->

  @endif

</div>
<!-- End Row -->
