@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : $page->name }}">
    <title>{{ ($page->seo) ? $page->seo->title : $page->name }}</title>

@endsection

@section('content')

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
