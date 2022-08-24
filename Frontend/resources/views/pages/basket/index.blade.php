@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')
    <iframe
        src="https://test-front.vuso.ua/assets/app/interactive-app.html?path=cart&lang={{app()->currentLocale()}}"
        height="768"
        id="widget-frame"
    >
    </iframe>

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
