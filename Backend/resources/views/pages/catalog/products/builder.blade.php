@extends('layouts.app', [
    'body_class'    => 'no-sidebar bg-white',
    'model'         => $model
])

@include( 'builder.style' )

@section('content')

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-md-12 grid-margin ">

            @include('template-parts.message')

            <!-- form -->
            <form action="{{ route('b2b.products.builder.update', ['product' => $model]) }}" method="post" enctype="multipart/form-data" class="formConstructor hidden">
                @csrf
                {!! html_hidden('name', ($model->name) ?? $model->name) !!}
                {!! html_select('category[]', $model->categories->map->id->toArray(), list_data($categories), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'category']) !!}
            </form>
            <!-- end form -->

            <!-- wrapper -->
            <div class="builder-wrapper">
                <div class="container">
                    {!! $model->content !!}
                </div>
            </div>
            <!-- end wrapper -->

        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    @include( 'builder.script' )

@endsection
