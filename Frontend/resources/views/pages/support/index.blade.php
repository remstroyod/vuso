@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('support') }}
    @endif

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
