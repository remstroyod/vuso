<{{ $menu->getWrapper() }}
        class="{{ ($menu->attrclass) ? $menu->attrclass : '' }}"
        id="{{ ($menu->attrid) ? $menu->attrid : '' }}"
>

    @if( $menu->items->count() )

        @foreach( $menu->items as $item )

            {!! ($menu->wrapper == 1) ? '<li>' : '' !!}
                <a
                        href="{{ $item->url }}"
                        {!! $item->attrtarget ? ' target="' . $item->attrtarget . '"' : '' !!}
                        {!! $item->attrtitle ? ' title="' . $item->attrtitle . '"' : '' !!}
                        {!! $item->attrid ? ' id="' . $item->attrid . '"' : '' !!}
                        {!! $item->attrclass ? ' class="' . $item->attrclass . '"' : '' !!}
                        {!! $item->attrrel ? ' rel="' . $item->attrrel . '"' : '' !!}
                >
                    {!! $item->getIcon('left') !!}
                    <span>{{ $item->title }}</span>
                    {!! $item->getIcon('right') !!}
                </a>
            {!! ($menu->wrapper == 1) ? '</li>' : '' !!}
        @endforeach

    @endif
</{{ $menu->getWrapper() }}>

