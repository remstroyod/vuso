@if( $blocks->count() )

  @foreach( $blocks as $block)

    @include( 'components.' . $block->component, ['block' => $block] )

  @endforeach

@endif
