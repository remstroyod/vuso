jQuery(function($) {
	'use strict';
	/******************************************************************
	 * Cart
	 * @type {{init: Cart.init, install: Cart.install}}
	 * @since 1.0
	 * @author Alex Cherniy
	 * @date 01.04.2022
	 */
	var Cart = {
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
			/**
			 * Remove Open Modal
			 */
			$('.cartMiniRemoveProduct').length && $(document).on('click', '.cartMiniRemoveProduct', this.remove_open_modal)
			/**
			 * Remove Item in Cart
			 */
			$('#modalCartRemoveForm').length && $(document).on('submit', '#modalCartRemoveForm', this.remove_item)
		},
		/**
		 * Remove Open Modal
		 * @param e
		 */
		remove_open_modal: function(e) {
			e.preventDefault()
			let $this = $(this),
				product_id = $this.data('product-id'),
				product_name = $this.data('product-name')
			$('#modalCartRemoveProduct').text(product_name)
			$('#modalCartRemoveForm input[name="item"]').val(product_id)
		},
		/**
		 * Remove Cart Item
		 * @param e
		 */
		remove_item: function(e) {
			e.preventDefault()
			let $this = $(this),
				url = $this.attr('action')
			$.ajax({
				beforeSend: function(xhr) {},
				data: $this.serialize(),
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'DELETE',
				complete: function() {},
				error: function(response) {
					$this.find('.error').html(response.message)
				},
				success: function(response) {
					if (true === response.status) {
						location.reload()
					}
				},
				url: url
			});
		},
	}
	Cart.init()
});