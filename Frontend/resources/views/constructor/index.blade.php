@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@push('plugin-styles')
    {{--<link href="{{ asset('assets/plugins/ContentBuilder/assets/minimalist-blocks/content.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" />--}}

    <link rel="stylesheet/less" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/custom-blocks.less') }}" />
    <script src="https://unpkg.com/less@4.1.1" ></script>
@endpush

@section('content')


    <!-- Constructor -->
    <div class="container">
        {!! Shortcode::compile($page->content) !!}
    </div>
    <!-- End Constructor -->

@endsection
