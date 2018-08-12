config {
    absRefPrefix = auto
    language = de
    locale_all = de_DE
    sys_language_uid = 0
    sys_language_content = 0
    sys_language_isocode_default = de

    headerComment (
(C) 2017 Pavel Leonidov
    Reference: http://www.pavel-leonidov.de
    )
}

config.concatenateCss = 1
config.concatenateJs = 1
config.compressJs = 1
config.compressCss = 1

[globalVar = GP:L = 1]
    config.sys_language_uid = 1
    config.language = en
    config.locale_all = en_US
    config.sys_language_content = 1
    config.sys_language_isocode = en
[GLOBAL]


[ApplicationContext = Production]
    config.absRefPrefix = /
[end]

# additional html classes
config.htmlTag_stdWrap = COA
config.htmlTag_stdWrap {
    cObject = TEXT
    cObject.value (
<!--[if lt IE 7]>      <html lang="{TSFE:sys_language_isocode}" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="{TSFE:sys_language_isocode}" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="{TSFE:sys_language_isocode}" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="{TSFE:sys_language_isocode}" class="no-js"> <!--<![endif]-->
    )
    cObject.insertData = 1
}
page = PAGE
page.typeNum = 0