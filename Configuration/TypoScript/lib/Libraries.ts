lib.pageContent = FLUIDTEMPLATE
lib.pageContent {
    templateName = TEXT
    templateName.stdWrap {
        cObject = TEXT
        cObject {
            data = pagelayout
            split {
                token = pagets__
                1.current = 1
                1.wrap = |
            }
        }
    }
    templateRootPaths {
        0 = EXT:tirs_configuration/Resources/Private/Templates
    }
    partialRootPaths {
        0 = EXT:tirs_configuration/Resources/Private/Partials
    }
    layoutRootPaths {
        0 = EXT:tirs_configuration/Resources/Private/Layouts
    }
}

# extend lib.fluidContent from fluid_styled_content
lib.fluidContent {
    templateRootPaths.20 = {$tirs_configuration.templates.templateRootPath}
    partialRootPaths.20 = {$tirs_configuration.templates.partialRootPath}
    layoutRootPaths.20 = {$tirs_configuration.templates.layoutRootPath}

}

# Take logo if exists, otherwise output the page title
lib.logo = COA
lib.logo {
    wrap = <div class="logo">|</div>

    10 = IMAGE
    10 {
        if.isTrue.data = levelfield:0, logo
        file {
            import.data = levelfield:0, logo, slide
            treatIdAsReference = 1
            import.listNum = 0
        }
        stdWrap.typolink.parameter.data = leveluid:0
    }

    20 = TEXT
    20 {
        data = leveltitle:0
        if.isFalse.data = levelfield:0, logo
        stdWrap.typolink.parameter.data = leveluid:0
    }
}

# Get application context
lib.productionMode = TEXT
lib.productionMode.value = 0

[applicationContext = Production]
    lib.productionMode.value = 1
[end]
