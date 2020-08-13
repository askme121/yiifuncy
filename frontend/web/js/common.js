function clearRowLastMargin(e, t) {
    for (var r = 1; r <= e.length; r++) r % t == 0 && $(e[r - 1]).css("margin-right", "0")
}

function GetRequest() {
    var e = location.search,
        t = new Object;
    if (-1 != e.indexOf("?")) {
        var r = e.substr(1);
        strs = r.split("&");
        for (var i = 0; i < strs.length; i++) t[strs[i].split("=")[0]] = decodeURI(strs[i].split("=")[1])
    }
    return t
}

function showHidePassword(e) {
    $("#show-btn").click(function () {
        $("#hide-btn").show(), $("#show-btn").hide(), $(e).attr("type", "text")
    }), $("#hide-btn").click(function () {
        $("#hide-btn").hide(), $("#show-btn").show(), $(e).attr("type", "password")
    })
}

function inputClear(e) {
    $(e).focus(function () {
        $(e).bind("input propertychange", function (t) {
            "" != $(e).val() ? $(e).parent().children(".input-clear").show() : $(e).parent().children(
                ".input-clear").hide()
        })
    }), $(e).blur(function () {
        "" == $(e).val() && $(e).parent().children(".input-clear").hide()
    }), $(".input-clear").click(function () {
        $(this).parent().find("input").val(""), $(this).hide()
    })
}

! function (t) {
    t.fn.autoMail = function (e) {
        var i = t.extend({}, t.fn.autoMail.defaults, e);
        return this.each(function () {
            function e(e) {
                t("#mailBox li").removeClass("cmail").eq(e).addClass("cmail")
            }
            var a = t(this),
                n = t.meta ? t.extend({}, i, a.data()) : i,
                r = a.innerHeight() + 3,
                o = t('<div id="mailBox" style="top:' + r + "px;left:0px;width:" + a.innerWidth() +
                    'px"></div>');
            t(".email-container").append(o);
            var s = n.emails,
                l = function (e) {
                    if (e.attr("autocomplete", "off"), "" != e.val() && e.val().indexOf("@") == e.val().length -
                    1) {
                        for (var i = "<ul>", n = 0; n < s.length; n++) i += "<li>" + e.val() + s[n] +
                            "</li>";
                        i += "</ul>", o.html(i).show(0)
                    } else o.hide(0);
                    t("#mailBox li").hover(function () {
                        t("#mailBox li").removeClass("cmail"), t(this).addClass("cmail")
                    }, function () {
                        t(this).removeClass("cmail")
                    }).click(function () {
                        e.val(t(this).html()), o.hide(0)
                    })
                },
                h = -1;
            a.focus(function () {
                -1 != a.val().indexOf("@") ? l(a) : o.hide(0)
            }).blur(function () {
                setTimeout(function () {
                    o.hide(0)
                }, 1e3)
            }).keyup(function (i) {
                -1 != a.val().indexOf("@") ? 40 == i.keyCode ? (h++, h >= t("#mailBox li").length &&
                (h = 0), e(h)) : 38 == i.keyCode ? (h--, h < 0 && (h = t("#mailBox li").length -
                    1), e(h)) : 13 == i.keyCode ? h >= 0 && (a.val(t("#mailBox li").eq(h).html()),
                    o.hide(0)) : (h = -1, l(a)) : o.hide(0)
            }).keydown(function (t) {
                if (13 == t.keyCode) return !1
            })
        })
    }, t.fn.autoMail.defaults = {
        emails: []
    }
}(jQuery);