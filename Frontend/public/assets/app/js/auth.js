jQuery(function($) {
	'use strict';
	/******************************************************************
	 * Forms Auth
	 * @type {{init: Auth.init, install: Auth.install}}
	 * @since 1.0
	 * @author Alex Cherniy
	 * @date 21.01.2022
	 */
	var Auth = {
		countdownTimeSms: 30,
		countdownTimeSmsCode: 30,
		/**
		 * Init
		 */
		init: function() {
			this.install = this.install(this)
      /**
       *
       * @type {*|jQuery|HTMLElement}
       */
      const input = $("#phone-number-input");
      intlTelInput(input[0], {
        singleDialCode: true,
        nationalMode: false
      });

			/**
			 * Submit Form Phone
			 */
			$(document).on('submit', '.authPhone', this.phone);
			/**
			 * Submit Form SMS Code
			 */
			$(document).on('submit', '.authPhoneCode', this.code);
			/**
			 * Resend SMS Code
			 */
			$(document).on('click', '.btnResendSmsCode', this.resend_sms);
			/**
			 * Load Form Enter Password
			 */
			$(document).on('click', '.btnFormEnterPassword', this.password_get_form);
			/**
			 * Load Form Enter Password
			 */
			$(document).on('click', '.btnFormCreatePassword', this.password_get_create_form);
			/**
			 * Show Form SMS Code
			 */
			$(document).on('click', '.showFormSmsCode', this.show_form_sms_code);
			/**
			 * Submit Check Form Password Enter
			 */
			$(document).on('submit', '.authEnterPassword', this.password_check_form);
			/**
			 * Submit Store Form Password
			 */
			$(document).on('submit', '.authStorePassword', this.password_store_form);
		},
		/**
		 * Install
		 */
		install: function() {},
		/**
		 * Phone Auth
		 */
		phone: function(e) {
			e.preventDefault()

      const input = $("#phone-number-input");
      const iti = intlTelInput(input[0],{
        singleDialCode: true,
        nationalMode: false
      })
      const isValid = iti.isValidNumber();
      if (isValid) {
        var $this = $(this),
        url = $this.attr('action');
        $.ajax({
          beforeSend: function (xhr) {
          },
          data: $this.serialize(),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method: 'POST',
          complete: function () {
          },
          error: function (response) {
            Auth.parse_error($this, response);
          },
          success: function (response) {
            if (true === response.status) {
              $this.find('.error').remove()
              /**
               * Show Form
               */
              $('.authCellFormPhone').removeClass('active')
              $('.authCellFormCode').html(response.message).addClass('active')
              /**
               * Timer
               */
              Auth.timer_resend_sms()
            }
          },
          url: url
        });
        input[0].style.border = 'none'
      } else {
        input[0].style.border = '1px solid red'
      }
		},
		/**
		 * Phone Auth
		 */
		code: function(e) {
			e.preventDefault()
			var $this = $(this),
				url = $this.attr('action');
			$.ajax({
				beforeSend: function(xhr) {},
				data: $this.serialize(),
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST',
				complete: function() {},
				error: function(response) {
					Auth.parse_error($this, response);
				},
				success: function(response) {
					console.dir(response)
					if (true === response.status) {
						$this.find('.error').remove()
						window.location.href = response.url
					}
				},
				url: url
			});
		},
		/**
		 * Get Form Password Enter
		 */
		password_get_form: function(e) {
			e.preventDefault()
			var $this = $(this),
				url = $this.data('url');
			$.ajax({
				beforeSend: function(xhr) {},
				data: {},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST',
				complete: function() {},
				error: function(response) {
					Auth.parse_error($this, response);
				},
				success: function(response) {
					console.dir(response)
					if (true === response.status) {
						$this.find('.error').remove()
						/**
						 * Show Form
						 */
						$('.authCellFormCode').removeClass('active')
						$('.authCellFormEnterPassword').html(response.message).addClass('active')
					}
				},
				url: url
			});
		},
		/**
		 * Get Form Password Create
		 */
		password_get_create_form: function(e) {
			e.preventDefault()
			var $this = $(this),
				url = $this.data('url');
			$.ajax({
				beforeSend: function(xhr) {},
				data: {},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST',
				complete: function() {},
				error: function(response) {
					Auth.parse_error($this, response);
				},
				success: function(response) {
					if (true === response.status) {
						$this.find('.error').remove()
						/**
						 * Show Form
						 */
						$('.authCellFormCode, .authCellFormEnterPassword').removeClass('active')
						$('.authCellFormStorePassword').html(response.message).addClass('active')
					}
				},
				url: url
			});
		},
		/**
		 * Check Password
		 */
		password_check_form: function(e) {
			e.preventDefault()
			var $this = $(this),
				url = $this.attr('action');
			$.ajax({
				beforeSend: function(xhr) {},
				data: $this.serialize(),
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST',
				complete: function() {},
				error: function(response) {
					Auth.parse_error($this, response);
				},
				success: function(response) {
					if (true === response.status) {
						$this.find('.error').remove()
						window.location.href = response.url
					}
				},
				url: url
			});
		},
		/**
		 * Store Password
		 */
		password_store_form: function(e) {
			e.preventDefault()
			var $this = $(this),
				url = $this.attr('action');
			$.ajax({
				beforeSend: function(xhr) {},
				data: $this.serialize(),
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST',
				complete: function() {},
				error: function(response) {
					Auth.parse_error($this, response);
				},
				success: function(response) {
					console.dir(response)
					if (true === response.status) {
						$this.find('.error').remove()
						window.location.href = response.url
					}
				},
				url: url
			});
		},
		/**
		 * Parse Error
		 */
		parse_error: function(e, errors) {
			$.each(errors.responseJSON.errors, function(field_name, error) {
				e.find('.' + field_name + '-error').remove()
				let arr = ''
				$.each(error, function(err) {
					arr += '<div class="' + field_name + '-error error">' + error[err] + '</div>'
				})
				e.find('[name=' + field_name + ']').after(arr)
			})
		},
		/**
		 * Resend SMS Code
		 */
		resend_sms: function(e) {
			e.preventDefault()
			if (Auth.countdownTimeSmsCode === 0) {
				$('.authPhone').trigger('submit')
			}
		},
		/**
		 * Timer Resend SMS Code
		 */
		timer_resend_sms: function() {
			$('.smsCodeTimer').css('opacity', 1)
			Auth.countdownTimeSmsCode = Auth.countdownTimeSms
			let resend_sms = setInterval(function() {
				if (Auth.countdownTimeSmsCode <= 0) {
					clearInterval(resend_sms)
					$('#resend_sms').text(Auth.countdownTimeSms)
					$('.smsCodeTimer').css('opacity', 0)
				} else {
					$('#resend_sms').text(Auth.countdownTimeSmsCode);
					Auth.countdownTimeSmsCode -= 1
				}
			}, 1000)
		},
		/**
		 * Show Form SMS Code
		 */
		show_form_sms_code: function(e) {
			e.preventDefault()
			$('.authCellFormEnterPassword').removeClass('active')
			$('.authCellFormCode').addClass('active')
		},
	}
	Auth.init()
});
