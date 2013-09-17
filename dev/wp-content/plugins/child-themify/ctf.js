(function(l10n){
	if ( typeof l10n.link !== 'string' || l10n.link.length < 1 ) {
		return;
	}
	var themeOptions = document.getElementById('customize-current-theme-link'),
		x,
		optionsLinks,
		newListItem,
		newLink;
	if ( themeOptions ) {
		themeOptions = themeOptions.parentNode;
	} else {
		return;
	}
	for( x in themeOptions.childNodes ) {
		if ( themeOptions.childNodes[x].nodeName !== undefined ) {
			if ( themeOptions.childNodes[x].nodeName.toUpperCase() === 'UL' ) {
				optionsLinks = themeOptions.childNodes[x];
				break;
			}
		}
	}
	if ( !optionsLinks ) {
		return;
	}
	newLink = document.createElement( 'a' );
	newLink.appendChild( document.createTextNode( l10n.createAChildTheme ) );
	newLink.href = l10n.link;
	newListItem = document.createElement( 'li' );
	newListItem.appendChild( newLink );
	optionsLinks.appendChild( newListItem );
}(childThemify));
