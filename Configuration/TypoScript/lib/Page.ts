/**
 * Created by pavelleonidov on 26/01/16.
 */

page {
    meta {
        og:site_name = TYPO3 project
        og:site_name.attribute = property
        description = Inspiring people to share
        og:description = Inspiring people to share
        og:description.attribute = property
        og:locale = de_DE
        og:locale.attribute = property
        og:locale:alternate {
            attribute = property
            value.1 = de_DE
            value.2 = en_US
        }
        viewport = width=device-width, initial-scale=1.0

    }
    10 =< lib.pageContent
    10 {

        variables {
            content < styles.content.get

            visual < styles.content.get
            visual.select.where = {#colPos}=1

            menu < lib.menu
            backgroundVisual < lib.backgroundVisual
            logo < lib.logo

            productionMode < lib.productionMode
        }
    }

}

