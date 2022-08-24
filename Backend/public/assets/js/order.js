$(document).ready(function(){

    $(".item").click(function(){
        let node = $(this);
        let product_id = node.data("id");
        node.parent().addClass('disabled')
        $.ajax({
            method:'get',
            url: `/users/orders/${product_id}/addProductTemplate`,
            success: function(response) {
                	
                $( "#products" ).find( ".row" ).append( response.product );
            
            },
            error:function(e){
                
                node.parent().removeClass('disabled')
            
            }
        });
    });

    $( "#order-products-form" ).submit(function( event ) {
        
        let products = $( this ).serializeArray();
        event.preventDefault();
        $.ajax({
            method:'post',
            url: `/users/orders/store`,
            data: products,
            success: function(response) { 	
            
            },
            error:function(e){
            
            }
        });
    });

    $('.products_row').bind('DOMSubtreeModified', function(e) {
        
        if(e.target.firstElementChild)
        {

            $('#product-form-fieldset').removeClass('d-none')
        
        }
        else
        {

            $('#product-form-fieldset').addClass('d-none')
        
        }
    });
});