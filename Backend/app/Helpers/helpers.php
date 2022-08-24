<?php

use Illuminate\Support\Facades\Cache;

/**
 * @param $path
 * @param string $active
 * @return mixed|string
 */
function active_class($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

/**
 * @param $path
 * @return string
 */
function is_active_route($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

/**
 * @param $path
 * @return string
 */
function show_class($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

if (!function_exists('html_tag')) {
    /**
     * Render html tag with attributes
     *
     * @param string $name
     * @param string $content
     * @param array $options
     * @return string
     */
    function html_tag(string $name, $content = '', $options = []): string
    {
        $attributes = [];
        foreach ($options as $attribute => $value) {
            $attributes[] = $attribute . '="' . htmlspecialchars($value) . '"';
        }
        $attributes = implode(' ', $attributes);

        $html = "<$name $attributes>";
        $voidElements = [
            'area' => 1, 'base' => 1, 'br' => 1, 'col' => 1, 'command' => 1, 'embed' => 1, 'hr' => 1,
            'img' => 1, 'input' => 1, 'keygen' => 1, 'link' => 1, 'meta' => 1, 'param' => 1, 'source' => 1,
            'track' => 1, 'wbr' => 1];

        return isset($voidElements[strtolower($name)]) ? $html : "$html$content</$name>";
    }
}

if (!function_exists('html_input')) {
    /**
     * Render html input tag
     *
     * @param string $type
     * @param string $name
     * @param string|null $value
     * @param array $options
     * @return string
     */
    function html_input(string $type, string $name, ?string $value, $options = [])
    {
        $options += [
            'type' => $type,
            'name' => $name,
            'value' => $value
        ];
        return html_tag('input', '', $options);
    }
}

if (!function_exists('html_text')) {
    /**
     * Render html text input tag
     *
     * @param string $name
     * @param string|null $value
     * @param array $options
     * @return string
     */
    function html_text(string $name, ?string $value, $options = [])
    {
        return html_input('text', $name, $value, $options);
    }
}

if (!function_exists('html_hidden')) {
    /**
     * Render html hidden input tag
     *
     * @param string $name
     * @param string|null $value
     * @param array $options
     * @return string
     */
    function html_hidden(string $name, ?string $value, $options = [])
    {
        return html_input('hidden', $name, $value, $options);
    }
}

if (!function_exists('html_textarea')) {
    /**
     * Render html textarea
     *
     * @param string $name
     * @param string|null $value
     * @param array $options
     * @return string
     */
    function html_textarea(string $name, ?string $value, $options = [])
    {
        $options += [
            'name' => $name
        ];
        return html_tag('textarea', $value, $options);
    }
}

if (!function_exists('html_select')) {
    /**
     * Render select
     *
     * @param string $name
     * @param null $selected
     * @param array $items
     * @param array $options
     * @return string
     */
    function html_select(string $name, $selected, array $items, $options = [])
    {
        $options += [
            'name' => $name
        ];
        return html_tag('select', html_options($items, $selected), $options);
    }
}

if (!function_exists('html_options')) {
    /**
     * Render select options
     *
     * @param array $data
     * @param null $selected
     * @return string
     */
    function html_options(array $data, $selected = null)
    {
        if (!is_array($selected)) {
            $selected = [$selected];
        }
        $lines = [];
        foreach ($data as $key => $value) {
            $options = ['value' => $key];
            if (in_array($key, $selected, true)) {
                $options['selected'] = 'selected';
            }
            $lines[] = html_tag('option', $value, $options);
        }
        return implode($lines);
    }
}

if (!function_exists('html_checkbox')) {
    /**
     * Render checkbox input tag
     *
     * @param string $name
     * @param bool $checked
     * @param array $options
     * @return string
     */
    function html_checkbox(string $name, $checked = false, $options = [])
    {
        $attributes = ['type' => 'checkbox', 'name' => $name];
        if ($checked) {
            $attributes['checked'] = 'checked';
        }
        return html_tag('input', '', $options + $attributes);
    }
}

if (!function_exists('html_radio')) {
    /**
     * Render radio input tag
     *
     * @param string $name
     * @param bool $checked
     * @param array $options
     * @return string
     */
    function html_radio(string $name, $checked = false, $options = [])
    {
        $attributes = ['type' => 'radio', 'name' => $name];
        if ($checked) {
            $attributes['checked'] = 'checked';
        }
        return html_tag('input', '', $options + $attributes);
    }
}

if (!function_exists('list_data')) {
    /**
     * Convert list of objects to the associative array
     *
     * @param array|\Illuminate\Database\Eloquent\Collection $collection
     * @param string|callable $from
     * @param string|callable $to
     * @return array
     */
    function list_data($collection, $from = 'id', $to = 'name')
    {
        $result = [];
        foreach ($collection as $item) {
            $fromValue = is_callable($from) ? $from($item) : $item->{$from};
            $toValue = is_callable($to) ? $to($item) : $item->{$to};

            $result[$fromValue] = $toValue;
        }
        return $result;
    }
}

if (!function_exists('current_url')) {
    /**
     * Generate url to the current route but change some parameters
     *
     * @param array $params
     * @return string
     */
    function current_url($params = [])
    {
        $router = app('router')->current();

        return app('url')->route($router->getName(), array_merge($params, $router->parameters()));
    }
}

/**
 * Settings
 * @param $value
 * @return mixed
 */
function settings($value)
{
    return Cache::get('settings')->where('name', $value)->first()->value;
}

//Review

// function localeUrl() //Review
// {

//     $locale = settings('site_url') . '/';
//     $defaultLocale = config('app.fallback_locale');
//     $currentLocale = app()->getLocale();

//     if( $currentLocale <> $defaultLocale )
//         $locale .= $currentLocale . '/';

//     return $locale;

// }

function localeUrl(): string
{

    $locale = settings('site_url') . '/';
    
    $currentLocale = app()->getLocale();

    $locale .= $currentLocale . '/';
    
    return $locale;

}
