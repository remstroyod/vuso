@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@push('plugin-styles')
    <link rel="stylesheet/less" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/custom-blocks.less') }}" />
@endpush

@section('content')

    {!! Shortcode::compile($page->content) !!}

@endsection

@push('custom-scripts')
    <script src="https://unpkg.com/less@4.1.1" ></script>
@endpush
