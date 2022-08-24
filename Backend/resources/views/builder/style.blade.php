@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/assets/minimalist-blocks/content.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" />

    <!-- custom -->
    <!-- styles для готовых блоков с сайта -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/site-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/contentbuilder.css') }}" />

    <!-- уникальные блоки контентбилдера -->
    {{--<link rel="stylesheet/less" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/custom-blocks.less') }}" />
    <script src="https://unpkg.com/less@4.1.1" ></script>--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/ContentBuilder/contentbuilder/content-builder-blocks.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- свайпер слайдер -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <style>
        .builder-wrapper {
            overflow: hidden;
        }
        .is-builder section .container {
            max-width: 100%;
        }
        .is-builder .category .container,
        .is-builder .product-suggestion__banner,
        .is-builder .actions__list,
        .is-builder .feedback__add,
        .is-builder .feedback__list,
        .is-builder .action__products-list,
        .is-builder .faq__accordion,
        .is-builder .faq__form,
        .is-builder .accordion-with-card .col-4,
        .is-builder .accordion-with-card .col-8 {
            position: relative;
        }
        .is-builder .feedback .row {
            align-items: stretch;
        }
        .is-builder .feedback__list {
            overflow: hidden;
            height: auto;
            max-height: 765px;
        }

        .is-builder .category .container::after,
        .is-builder .product-suggestion__banner::after,
        .is-builder .actions__list::after,
        .is-builder .feedback__add::after,
        .is-builder .feedback__list::after,
        .is-builder .action__products-list::after,
        .is-builder .faq__accordion::after,
        .is-builder .faq__form::after,
        .is-builder .accordion-with-card .col-4::after,
        .is-builder .accordion-with-card .col-8::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 10;
            cursor: not-allowed;
            background-color: rgba(0,0,0,0.15);
        }

        /* .is-builder .category .container *,
        .is-builder .actions .container *,
        .is-builder .product-suggestion .container *,
        .is-builder .feedback .container *,
        .is-builder .action .container *,
        .is-builder .faq .container * {
            pointer-events: none;
            cursor: not-allowed;
        } */

        .is-selectbox.snippet-cat {
            padding-right: 15px;
            padding-left: 16px;
        }
        .is-selectbox.snippet-cat span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            display: block;
            letter-spacing: initial;
        }
        .is-selectbox-options > div {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            display: block;
            padding-right: 15px;
            padding-left: 16px;
            letter-spacing: initial;
        }
        .snippet-item {
            background-color: #fff !important;
        }
        .snippet-item:hover {
            background-color: #fff !important;
        }
        .snippet-item::before {
            content: attr(title);
            font-size: 10px;
            font-weight: 700;
            color: #151826;
            text-align: center;
            display: block;
            line-height: normal;
            padding: 4px 8px;
            letter-spacing: normal;
            word-break: break-word;
        }
    </style>

@endpush
