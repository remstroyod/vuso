<input
        type="hidden"
        value="{{ isset($page) && isset($page->name) ? $page->name : '' }}"
        name="crm[source_description]"
>
<input
        type="hidden"
        value="{{ isset($page) && isset($page->page) ? strtoupper($page->page) : '' }}"
        name="crm[value_type]"
>
