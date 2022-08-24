    <ul class="list-unstyled" style="padding: 0 0 0 20px">

        @foreach($subcategories as $subcategory)

            <li>
                <div class="form-check">
                    <input
                            type="radio"
                            id="category-{{ $subcategory->id }}"
                            name="category_id"
                            value="{{ $subcategory->id }}"
                            @if( $model->category_id == $subcategory->id ) checked @endif
                            class="form-check-input"
                    >
                    <label for="category-{{ $subcategory->id }}" class="mb-0">{{ $subcategory->name }}</label>
                </div>
            </li>
            @if(count($subcategory->subcategory))
                @include('pages.informations.categories.subcategory-list',['subcategories' => $subcategory->subcategory, 'model' => $model])
            @endif

        @endforeach

    </ul>
