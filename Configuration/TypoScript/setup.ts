# ======================================================================
# Include external files
# ======================================================================
<INCLUDE_TYPOSCRIPT: source="FILE:./lib/General.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:./lib/Libraries.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:./lib/Menu.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:./lib/Page.ts">

# This file will be loaded only in development context

[applicationContext = Development]
	<INCLUDE_TYPOSCRIPT: source="FILE:EXT:tirs_configuration/Configuration/TypoScript/lib/Development.ts">
[end]