<?php

namespace Backend\Providers;

use Backend\Models\Articles\Articles;
use Backend\Models\Blocks\Block;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Contragents;
use Backend\Models\Catalog\Product;
use Backend\Models\Ecommerce\Order;
use Backend\Models\Ecommerce\Promocode;
use Backend\Models\Faq\Faq;
use Backend\Models\Menu\Menu;
use Backend\Models\Menu\MenuItem;
use Backend\Models\Pages;
use Backend\Models\Profile\User;
use Backend\Models\Reviews;
use Backend\Models\Sales\Sales;
use Backend\Models\Seo;
use Backend\Models\Tag;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EDocumentsImages;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Backend\Modules\EDocuments\Policies\EDocumentsDocsPolicy;
use Backend\Modules\EDocuments\Policies\EDocumentsImagesPolicy;
use Backend\Modules\EDocuments\Policies\EDocumentsPlaceholdersPolicy;
use Backend\Modules\EDocuments\Policies\EDocumentsPolicy;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Backend\Modules\PayHub\Policies\PayHubSystemsPolicy;
use Backend\Policies\ArticlesPolicy;
use Backend\Policies\BlocksPolicy;
use Backend\Policies\CatalogCategoryPolicy;
use Backend\Policies\CatalogContragentsPolicy;
use Backend\Policies\CatalogPolicy;
use Backend\Policies\CatalogProductPolicy;
use Backend\Policies\FaqPolicy;
use Backend\Policies\MenuElementsPolicy;
use Backend\Policies\MenuPolicy;
use Backend\Policies\OrderPolicy;
use Backend\Policies\PagesPolicy;
use Backend\Policies\PromocodesPolicy;
use Backend\Policies\ReviewsPolicy;
use Backend\Policies\SalesPolicy;
use Backend\Policies\SeoPolicy;
use Backend\Policies\TagPolicy;
use Backend\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Seo::class => SeoPolicy::class,
        Pages::class => PagesPolicy::class,
        Block::class => BlocksPolicy::class,
        Articles::class => ArticlesPolicy::class,
        Sales::class => SalesPolicy::class,
        Faq::class => FaqPolicy::class,
        Reviews::class => ReviewsPolicy::class,
        Contragents::class => CatalogContragentsPolicy::class,
        Category::class => CatalogCategoryPolicy::class,
        Product::class => CatalogProductPolicy::class,
        EDocuments::class => EDocumentsPolicy::class,
        EDocumentsDocs::class => EDocumentsDocsPolicy::class,
        EDocumentsImages::class => EDocumentsImagesPolicy::class,
        EDocumentsPlaceholders::class => EDocumentsPlaceholdersPolicy::class,
        Order::class => OrderPolicy::class,
        Promocode::class => PromocodesPolicy::class,
        Menu::class => MenuPolicy::class,
        MenuItem::class => MenuElementsPolicy::class,
        Tag::class => TagPolicy::class,
        PayHubSystem::class => PayHubSystemsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //

        Passport::routes();

        Passport::hashClientSecrets();
    }
}
