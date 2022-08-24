jQuery( function( $ ) {

    'use strict';

    /******************************************************************
     * Profile page
     * @type {{init: Profile.init, install: Profile.install}}
     * @since 1.0
     * @author Alex Cherniy
     * @date 01.02.2022
     */
    var Share = {

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
             * Submit Form Person
             */
            $( document ).on(
                'click',
                '#shareSocial',
                this.socialShare );

        },

        /**
         * Form Person
         * @param e
         */
         socialShare: async  function (e) {

            const shareData = {
                title: 'VUSO',
                url: window.location.href,
            }
            
            try{

                await navigator.share(shareData);
            
            } catch(err) {
                console.log('Your host will start with HTTPS::');
            }

        },

    }

    Share.init()

});
