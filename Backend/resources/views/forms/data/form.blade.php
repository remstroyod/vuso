<!-- Row -->
<div class="row">

    <!-- Col -->
    <div class="col-lg-8 grid-margin stretch-card">

        <!-- card -->
        <div class="card">

            <!-- card-body -->
            <div class="card-body">

                <!-- Title -->
                <h6 class="card-title">
                    {{ __( 'Форма' ) }}: {{ $model->forms->type($model->type) }}
                </h6>
                <!-- End Title -->

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-4">

                        <!-- form group -->
                        <div class="form-group">
                            <label for="name">
                                {{ __( 'Имя' ) }}
                            </label>
                            {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name', 'readonly' => 'readonly']) !!}
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
                            {!! html_input('text', 'email', $model->email, ['class' => 'form-control', 'id' => 'email', 'readonly' => 'readonly']) !!}
                        </div>
                        <!-- end form group -->

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-lg-4">

                        <!-- form group -->
                        <div class="form-group">
                            <label for="phone">
                                {{ __( 'Телефон' ) }}
                            </label>
                            {!! html_input('text', 'phone', $model->phone, ['class' => 'form-control', 'id' => 'phone', 'readonly' => 'readonly']) !!}
                        </div>
                        <!-- end form group -->

                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Row -->

                <!-- form group -->
                <div class="form-group">
                    <label for="message">
                        {{ __( 'Текст' ) }}
                    </label>
                    {!! html_textarea('message', $model->message, ['class' => 'form-control', 'id' => 'message', 'rows' => 5, 'readonly' => 'readonly']) !!}
                </div>
                <!-- end form group -->

                <!-- fieldset -->
                <fieldset>

                    <a href="{{ route('forms.data.index') }}" type="button" class="btn btn-secondary">
                        {{ __( 'Назад' ) }}
                    </a>

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

                <!-- Title -->
                <h6 class="card-title">
                    {{ __( 'Детали' ) }}
                </h6>
                <!-- End Title -->

                <!-- form group -->
                <div class="form-group row">

                    <!-- col -->
                    <div class="col-sm-3">

                        <p class="card-description mb-0">
                            {{ __( 'Дата' ) }}
                        </p>

                    </div>
                    <!-- end col -->

                    <!-- col -->
                    <div class="col-sm-9">
                        {{ $model->published_at->format('d.m.Y') }}
                    </div>
                    <!-- end col -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-group row pt-0">

                    <!-- col -->
                    <div class="col-sm-3">

                        <p class="card-description mb-0">
                            {{ __( 'IP адрес' ) }}
                        </p>

                    </div>
                    <!-- end col -->

                    <!-- col -->
                    <div class="col-sm-9">
                        {{ $model->ip }}
                    </div>
                    <!-- end col -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-group row pt-0">

                    <!-- col -->
                    <div class="col-sm-3">

                        <p class="card-description mb-0">
                            {{ __( 'Страница' ) }}
                        </p>

                    </div>
                    <!-- end col -->

                    <!-- col -->
                    <div class="col-sm-9">
                        {{ $model->url }}
                    </div>
                    <!-- end col -->

                </div>
                <!-- end form group -->

                <!-- form group -->
                <div class="form-group row pt-0">

                    <!-- col -->
                    <div class="col-sm-3">

                        <p class="card-description mb-0">
                            {{ __( 'Браузер' ) }}
                        </p>

                    </div>
                    <!-- end col -->

                    <!-- col -->
                    <div class="col-sm-9">
                        {{ $model->browser }}
                    </div>
                    <!-- end col -->

                </div>
                <!-- end form group -->

            </div>
            <!-- end card-body -->

        </div>
        <!-- end card -->

    </div>
    <!-- End Col -->

</div>
<!-- End Row -->
