# ======================================================================
# Menu configuration with additional classes for first/last menu elements
# ======================================================================

lib.basemenu = HMENU
lib.basemenu {
    1 = TMENU
    1 {
        wrap = <ul>|</ul>

        NO = 1
        NO {
            allStdWrap.insertData = 1
            # ATagTitle.field = description // subtitle // title

            stdWrap.cObject = COA
            stdWrap.cObject {
                10 = TEXT
                10.field = nav_title // subtitle // title

                12 = LOAD_REGISTER
                12 {
                    level1title.cObject = RECORDS
                    level1title.cObject {
                        source = {field:pid}
                        source.insertData = 1
                        tables = pages
                        conf.pages = TEXT
                        conf.pages.field = title
                    }
                }

                # Get the unix timestamp from newUntil w/o time and add 23:59:59
                15 = LOAD_REGISTER
                15 {
                    today {
                        cObject = TEXT
                        cObject {
                            data = field:newUntil
                            wrap = |+86399
                        }

                        prioriCalc = intval
                    }
                }

                20 = LOAD_REGISTER
                20 {
                    new.cObject = TEXT
                    new.cObject {
                        value = new
                        if {
                            value.data = date: U
                            isLessThan.data = register:today
                            negate = 1
                        }
                    }
                }

                30 = LOAD_REGISTER
                30 {
                    firstnew < lib.basemenu.1.NO.stdWrap.cObject.20.new
                    firstnew.cObject.value = firstnew
                }

                40 = LOAD_REGISTER
                40 {
                    lastnew < lib.basemenu.1.NO.stdWrap.cObject.20.new
                    lastnew.cObject.value = new
                }
            }

            wrapItemAndSub.insertData = 1
            wrapItemAndSub = <li class="first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="{register:new} page-{field:uid}">|</li> |*| <li class="last {register:new} {register:lastnew} page-{field:uid}">|</li>
            linkWrap = |
        }

        ACT < .NO
        ACT = 1
        ACT {
            wrapItemAndSub = <li class="active first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="active {register:new} page-{field:uid}">|</li> |*| <li class="active last {register:new} {register:lastnew} page-{field:uid}">|</li>
            ATagParams = class="active"
            linkWrap = |
        }

        IFSUB < .NO
        IFSUB = 1
        IFSUB.wrapItemAndSub = <li class="first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="{register:new} page-{field:uid}">|</li> |*| <li class="last {register:new} {register:lastnew} page-{field:uid}">|</li>

        ACTIFSUB < .IFSUB
        ACTIFSUB.wrapItemAndSub = <li class="first {register:new} {register:firstnew} page-{field:uid} active">|</li> |*| <li class="{register:new} page-{field:uid} active">|</li> |*| <li class="last {register:new} {register:lastnew} page-{field:uid} active">|</li>
        ACTIFSUB.ATagParams = class="active"
        ACTIFSUB = 1
    }

    2 < .1
    2 {
        wrap = <ul>|</ul>
        NO = 1
        NO {
            wrapItemAndSub = <li class="first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="{register:new} page-{field:uid}">|</li> |*| <li class="last {register:new} {register:lastnew} page-{field:uid}">|</li>
        }
        ACT < .NO
        ACT = 1
        ACT.ATagParams = class="active"
        ACT.wrapItemAndSub = <li class="active first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="active {register:new} page-{field:uid}">|</li> |*| <li class="active {register:new} {register:lastnew} page-{field:uid}">|</li>
        ACTIFSUB < .ACT
        ACTIFSUB = 1
    }
    3 < .1
    3 {
        NO = 1
        NO {
            wrapItemAndSub = <li class="first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="{register:new} page-{field:uid}">|</li> |*| <li class="last {register:new} {register:lastnew} page-{field:uid}">|</li>
        }
        ACT < .NO
        ACT = 1
        ACT.ATagParams = class="active"
        ACT.wrapItemAndSub = <li class="active first {register:new} {register:firstnew} page-{field:uid}">|</li> |*| <li class="active {register:new} page-{field:uid}">|</li> |*| <li<li class="active last {register:new} {register:lastnew} page-{field:uid}">|</li>
        ACTIFSUB < .ACT
        ACTIFSUB = 1
    }
    4 < .1
    4 {
        NO = 1
        NO {
            wrapItemAndSub = <li class="first {register:firstnew} page-{field:uid}">|</li> |*| <li class="{register:new} page-{field:uid}">|</li> |*| <li class="last {register:lastnew} page-{field:uid}">|</li>
        }
        ACT < .NO
        ACT = 1
        ACT.ATagParams = class="active"
        ACT.wrapItemAndSub = <li class="active first {register:firstnew} page-{field:uid}">|</li> |*| <li class="active {register:new} page-{field:uid}">|</li> |*| <li class="active last {register:lastnew} page-{field:uid}">|</li>
        ACTIFSUB < .ACT
        ACTIFSUB = 1
    }

}

lib.menu < lib.basemenu