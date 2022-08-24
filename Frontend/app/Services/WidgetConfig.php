<?php
namespace Frontend\Services;

use Illuminate\Support\Facades\File;

class WidgetConfig
{


    public function __construct()
    {
        $this->generate();
    }

    /**
     * @return string|void
     */
    protected function generate()
    {

        $file = public_path() . '/assets/app/interactive-app/config.js';

        $content = 'window.FRONTEND_API_DOMAIN = "' . settings('site_url') . settings('url_app_api_frontend') . '";' . PHP_EOL;
        $content .= 'window.VUSO_API_DOMAIN = "' . env('VUSO_API_DOMAIN') . '";' . PHP_EOL;
        $content .= 'window.FRONTEND_API_DOMAIN = "' . settings('site_url_admin') . settings('url_app_api_backend') . '";' . PHP_EOL;
        $content .= 'window.RESOURCES_DOMAIN = "' . settings('site_url_admin') . '/storage";' . PHP_EOL;
        $content .= 'window.API_ACCESS_TOKEN = "' . env('API_TOKEN') . '";' . PHP_EOL;
        $content .= 'window.PRIVACY_POLICY_URL = "google.com";' . PHP_EOL;
        $content .= 'window.WIDGET_RENDER_TARGET_ID = "widget";';

        try {

            File::put($file, $content);

        } catch (\Throwable $e) {

            return $e->getMessage();

        }

    }

}
