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
            <form action="{{ route('constructor.builder', $model) }}" method="post" enctype="multipart/form-data" class="formConstructor">
                @csrf
                {!! html_hidden('name', ($model->name) ?? $model->name) !!}
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
