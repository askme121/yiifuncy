function clearRowLastMargin(e, t) {
    for (var r = 1; r <= e.length; r++) r % t == 0 && $(e[r - 1]).css("margin-right", "0")
}