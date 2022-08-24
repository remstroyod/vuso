@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @php( $title = (isset($page->seo->h1)) ? $page->seo->h1 : $page->name )

    <section class="widget">
        <iframe
            src="{{asset('assets/app/interactive-app.html')}}?path=product&lang={{app()->currentLocale()}}&productId={{$page->id}}"
            height="768"
            id="widget-frame"
        ></iframe>
        {{-- {!! $page->excerpt !!} --}}
    </section>

@endsection
