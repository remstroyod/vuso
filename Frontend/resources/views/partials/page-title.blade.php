<!-- title -->
<h1 class="page-title @isset( $class ) {{ $class }} @endisset">
    @if( isset($page->seo->h1) && !empty($page->seo->h1) )
        {{ $page->seo->h1 }}
    @else
        {{ $page->name }}
    @endif
</h1>
<!-- end title -->
