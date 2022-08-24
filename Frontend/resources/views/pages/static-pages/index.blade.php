@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_template == 1 )

        @if ( Storage::disk('public')->exists('files/template/' . $page->id . '.blade.php') )

            @include( 'files.template.' . $page->id) )

        @else

            {{ __( 'Шаблон не найден' ) }}

        @endif

    @else

        @if( $page->is_breadcrumbs )
            {{ Breadcrumbs::render('static-page', $page) }}
        @endif

        @if( $blocks->count() )
            @includeWhen( $blocks, 'partials.blocks' )
        @else

            <section>
                <div class="container">
                    {!! $page->description !!}
                </div>
            </section>

        @endif

    @endif

@endsection


