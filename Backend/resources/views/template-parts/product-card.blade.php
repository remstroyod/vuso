<div class="col-lg-6 col-md-6  mt-2 appended-product">
    <p>{{$product->name}}</p>
    
    <div class="card d-flex flex-column align-items-center">
        
        <div class="form-group">
            
            <label for="phone" class="mt-4">
                {{ __( 'Номер Телефона' ) }}
            </label>
            <input type="text" name='phone[{{$product->id}}]'  class="form-control" id="phone"/>

            <label for="last-name" class="mt-4">
                {{ __( 'Фамилия' ) }}
            </label>
            <input type="text" name='last_name[{{$product->id}}]'  class="form-control" id="last-name"/>
            
            <label for="name" class="mt-4">
                {{ __( 'Имя' ) }}
            </label>
            <input type="text" name='name[{{$product->id}}]'  class="form-control" id="name"/>

            <label for="born_date" class="mt-4">
                {{ __( 'Дата рождения' ) }}
            </label>
            <input type="text" name='born_date[{{$product->id}}]'  class="form-control" id="born_date"/>
        
        </div>
        
        @if(false)
        
        <!-- fieldset -->
        <fieldset>

            <button type="submit" class="btn btn-primary">
                {{ __( 'Сохранить' ) }}
            </button>

        </fieldset>
        <!-- end fieldset -->
        
        @endif
    
    </div>
</div>