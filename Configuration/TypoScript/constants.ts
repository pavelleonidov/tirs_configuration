# fluid_styled_content constants
styles.content {
	textmedia {
		maxW = 2560
		maxWInText = 2560
	}
}

styles.templates {
	templateRootPath = EXT:tirs_configuration/Resources/Private/Templates/ContentElements/
	partialRootPath = EXT:tirs_configuration/Resources/Private/Partials/ContentElements/
	layoutRootPath = EXT:tirs_configuration/Resources/Private/Layouts/ContentElements/
}
# @TODO: Apply necessary overrides of fluid_styled_content templates

# define a third content elements template fallback (for further derivations)
tirs_configuration {
	templates {
		templateRootPath =
		partialRoothPath =
		layoutRootPath =
	}

	rootPid = 1
}