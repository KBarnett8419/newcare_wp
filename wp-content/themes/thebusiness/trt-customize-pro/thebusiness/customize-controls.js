( function( api ) {

	// Extends our custom "thebusiness" section.
	api.sectionConstructor['thebusiness'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
