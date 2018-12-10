/* globals jQuery, document, medianNotice */

(function( $ ) {
    $( document ).ready( function() {

        $( '#median-notice button.notice-dismiss' ).click( function( e ) {
            e.preventDefault();
            $.post( medianNotice.ajaxurl, {
                action: medianNotice.action,
                nonce: medianNotice.nonce
            } );
        } );
    } );
})( jQuery );
