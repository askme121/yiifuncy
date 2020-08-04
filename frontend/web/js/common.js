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