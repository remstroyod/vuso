jQuery( function( $ ) {

    'use strict';

    /******************************************************************
     * B2B
     * @type {{init: B2B.init, install: B2B.install}}
     * @since 1.0
     * @author Alex Cherniy
     * @date 26.02.2022
     */
    var B2B = {

        /**
         * Init
         */
        init: function () {

            this.install  = this.install( this )

        },

        /**
         * Install
         */
        install: function() {

            /**
             * Submit Form
             * @click
             */
            $(document).on('change', '.b2bTags [type="checkbox"]', function (e)
            {

                e.preventDefault()

                $('.b2bTags').submit()

            })

        },

    }

    B2B.init()

});
