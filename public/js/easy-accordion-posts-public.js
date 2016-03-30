
'use strict';
jQuery( function( $ ){

	// slide Toggle
	//-- define event listener
	function eapSlideToggle( ){
		var $this = $( this );
		if( ! $this.parent( ).hasClass( 'eap_no_content' ) )
			$this.siblings( '.eap_content' ).stop( ).slideToggle( ).parent( ).toggleClass('eap_open');
	}
	//-- bind event listener
	$( 'body' ).on( 'click', '.eap_title', eapSlideToggle );


} );
