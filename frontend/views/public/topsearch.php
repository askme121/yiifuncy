<form method="get" action="">
    <input class="search-input" type="text" name="q" value="" placeholder="Search deals here" maxlength="22" onkeyup="javascript:maxLengthDispose(this,22)" onchange="javascript:maxLengthDispose(this,22)" onkeydown="javascript:maxLengthDispose(this,22)">
    <button type="submit" style="visibility:hidden;position:absolute;top:0;right:0;">
        <img class="search-icon" src="<?= getImgUrl('images/v3-search.png'); ?>">
    </button>
</form>
