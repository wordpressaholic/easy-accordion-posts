
'use strict';
jQuery( function( $ ){

	// slide Toggle
	//-- define listner
	function eapSlideToggle( ){
		var $this = $( this );
		if( ! $this.parent( ).hasClass( 'eap_no_content' ) )
			$this.siblings( '.eap_content' ).stop( ).slideToggle( ).parent( ).toggleClass('eap_open');
	}
	//-- bind listner
	$( 'body' ).on( 'click', '.eap_title', eapSlideToggle );


} );
