( function( api ) {

	// Extends our custom "milktea-90" section.
	api.sectionConstructor['milktea-90'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );