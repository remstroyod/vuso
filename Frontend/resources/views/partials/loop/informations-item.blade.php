<li @isset( $hidden ) @if( $loop->iteration > $hidden ) class="hidden" @endif @endisset>

    <a href="{{ $item->file }}" class="info-text__tab-link" download>

        {{ $item->name }}

        <div class="download">
            {{ __( 'Скачать' ) }}
        </div>

    </a>

</li>
