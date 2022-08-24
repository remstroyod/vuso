jQuery( function( $ ) {

    'use strict';

    /******************************************************************
     * Forms Submit
     * @type {{init: Forms.init, install: Forms.install}}
     * @since 1.0
     * @author Alex Cherniy
     * @date 21.01.2022
     */
    var Forms = {

        /**
         * Init
         */
        init: function () {

            this.install  = this.install( this )

            this.formConsultationTime()

        },

        /**
         * Install
         */
        install: function() {

            /**
             * Submit Form
             * @click
             */
            $(document).on('submit', '.ajaxForm', function (e)
            {

                e.preventDefault()

                var $this   = $(this),
                    url     = $this.attr('action');

                $.ajax( {
                    beforeSend  :   function(xhr){

                    },
                    data        :   $this.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method      :   'POST',
                    complete    :   function(){

                    },
                    error: function(response) {

                        $.each(response.responseJSON.errors,function(field_name,error){
                            $this.find('.'+field_name+'-error').remove()
                            $this.find('[name='+field_name+']').after('<span class="'+field_name+'-error error">' +error+ '</span>')
                        })

                    },
                    success     :   function( response ){

                        if( 'success' === response.status ) {
                            $this[0].reset()
                            $this.find('.error').remove()

                            if( $('.showAfterSubmit').length )
                            {
                                $('.showAfterSubmit').show()
                            }
                            if( $('.hideAfterSubmit').length )
                            {
                                $('.hideAfterSubmit').hide()
                            }

                        }

                        $('.successMessage').html(response.message).ready(function () {

                            $('.modal').modal('hide')
                            $('#successMessage').modal('show')

                        })

                    },
                    url         :   url
                } );

            })

        },

        /**
         * Form Consultation Time And Date
         */
        formConsultationTime: function ()
        {

            let $input = $('.formConsultationTimeValue')

            /**
             * On Load Set Default
             */
            $(window).on('load', function ()
            {

                let time = $('.formConsultationTimeTime [type="radio"]:checked').data('value'),
                    date = $('.formConsultationTimeDate [type="radio"]:checked').data('value')

                $input.val(date + ': ' + time)

            });

            /**
             * Set Date
             */
            $(document).on('change', '.formConsultationTimeDate [type="radio"]', function (e)
            {

                let $this = $(this),
                    value = $this.data('value'),
                    time = $('.formConsultationTimeTime [type="radio"]:checked').data('value')

                $input.val(value + ': ' + time)

            })

            /**
             * Set Time
             */
            $(document).on('change', '.formConsultationTimeTime [type="radio"]', function (e)
            {

                let $this = $(this),
                    value = $this.data('value'),
                    date = $('.formConsultationTimeDate [type="radio"]:checked').data('value')

                $input.val(date + ': ' + value)

            })

        }

    }

    Forms.init()

});

/**
 * Recaptcha ajaxForm
 */
let reCaptchaForm;
_submitEvent = function()
{

    //console.log(grecaptcha.getResponse());

    reCaptchaForm.trigger('submit');

};

_beforeSubmit = function(e)
{

    reCaptchaForm = $(e.target);

    return true;

}
