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
        0 = EXT:tirs_configuration/Resources/Private/Templates/
        10 = {$tirs_configuration.templates.templateRootPath}
    }
    partialRootPaths {
        0 = EXT:tirs_configuration/Resources/Private/Partials/
        10 = {$tirs_configuration.templates.partialRootPath}
    }
    layoutRootPaths {
        0 = EXT:tirs_configuration/Resources/Private/Layouts/
        10 = {$tirs_configuration.templates.layoutRootPath}
    }

    # Menu processor

    dataProcessing {
        # Main menu
        10 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
        10 {
            special = directory
            special.value = {$tirs_configuration.rootPid}
            levels = 4
            includeSpacer = 1
            as = menuMain

            dataProcessing {
                10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
                10 {
                    references.fieldName = media
                    as = pageMedia
                }
            }
        }

        # Submenu
        20 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
        20 {
            levels = 2
            entryLevel = 1
            expandAll = 0
            includeSpacer = 1
            as = menuSub
        }
    }
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

# background visual

/*
lib.backgroundVisual = FILES
lib.backgroundVisual {
    #if.isTrue.data = levelfield:-1, background_visual
    begin = 0
    maxItems = 1
    references {
        table = pages
        data = levelfield:-1, background_visual, slide
        fieldName = background_visual
    }
    renderObj = IMG_RESOURCE
    renderObj {
        file.import.data = file:current:publicUrl
    }
}
*/


lib.backgroundVisual = IMG_RESOURCE
lib.backgroundVisual {
    file {
        import.data = levelfield:-1, background_visual, slide
        treatIdAsReference = 1
        import.listNum = 0
    }
}


# Get application context
lib.productionMode = TEXT
lib.productionMode.value = 0

[applicationContext = Production]
    lib.productionMode.value = 1
[end]
