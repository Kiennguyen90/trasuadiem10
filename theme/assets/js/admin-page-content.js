/* global jQuery, wp */
( function ( $ ) {
	'use strict';

	$( document ).on( 'click', '.fy-pc-media-pick', function ( e ) {
		e.preventDefault();
		var $wrap = $( this ).closest( '.fy-pc-media' );
		var frame = wp.media( {
			title: 'Chọn ảnh',
			button: { text: 'Dùng ảnh này' },
			library: { type: 'image' },
			multiple: false
		} );

		frame.on( 'select', function () {
			var att = frame.state().get( 'selection' ).first().toJSON();
			var url = ( att.sizes && att.sizes.medium ) ? att.sizes.medium.url : att.url;
			$wrap.find( '.fy-pc-media-id' ).val( att.id );
			$wrap.find( '.fy-pc-media-preview' )
				.html( '<img src="' + url + '" alt="" />' );
			$wrap.find( '.fy-pc-media-clear' ).show();
		} );

		frame.open();
	} );

	$( document ).on( 'click', '.fy-pc-media-clear', function ( e ) {
		e.preventDefault();
		var $wrap = $( this ).closest( '.fy-pc-media' );
		$wrap.find( '.fy-pc-media-id' ).val( '' );
		$wrap.find( '.fy-pc-media-preview' ).empty();
		$( this ).hide();
	} );

} )( jQuery );
