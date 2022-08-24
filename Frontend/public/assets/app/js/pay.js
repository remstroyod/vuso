jQuery(function($) {
	'use strict';
	/******************************************************************
	 * Cart
	 * @type {{init: Cart.init, install: Cart.install}}
	 * @since 1.0
	 * @author Alex Cherniy
	 * @date 01.04.2022
	 */
	var Pay = {
		/**
		 * Init
		 */
		init: function() {
			this.install = this.install(this)
		},
		/**
		 * Install
		 */
		install: function() {

			 $(document).on('click', '#payButton', this.pay)
		},
		/**
		 * Remove Open Modal
		 * @param e
		 */
		pay: function(e) {
            let url = e.target.href;
			e.preventDefault()
            $.ajax( {
                data: $(this).serialize(),
                url : url,
                method : 'GET',
                error: function(error) {
                    alert('error');
                    console.log(error)
                },
                success     :   function( response ){
                    window.location.href = response.data.url;
                },
            } );
		},
		/**
		 * Remove Cart Item
		 * @param e
		 */
	}
	Pay.init()
});
