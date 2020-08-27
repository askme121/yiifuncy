var t = true
function detect(ua) {

    function getFirstMatch(regex) {
        var match = ua.match(regex);
        return (match && match.length > 1 && match[1]) || '';
    }

    function getSecondMatch(regex) {
        var match = ua.match(regex);
        return (match && match.length > 1 && match[2]) || '';
    }

    var iosdevice = getFirstMatch(/(ipod|iphone|ipad)/i).toLowerCase()
        , likeAndroid = /like android/i.test(ua)
        , android = !likeAndroid && /android/i.test(ua)
        , nexusMobile = /nexus\s*[0-6]\s*/i.test(ua)
        , nexusTablet = !nexusMobile && /nexus\s*[0-9]+/i.test(ua)
        , chromeos = /CrOS/.test(ua)
        , silk = /silk/i.test(ua)
        , sailfish = /sailfish/i.test(ua)
        , tizen = /tizen/i.test(ua)
        , webos = /(web|hpw)os/i.test(ua)
        , windowsphone = /windows phone/i.test(ua)
        , samsungBrowser = /SamsungBrowser/i.test(ua)
        , windows = !windowsphone && /windows/i.test(ua)
        , mac = !iosdevice && !silk && /macintosh/i.test(ua)
        , linux = !android && !sailfish && !tizen && !webos && /linux/i.test(ua)
        , edgeVersion = getFirstMatch(/edge\/(\d+(\.\d+)?)/i)
        , versionIdentifier = getFirstMatch(/version\/(\d+(\.\d+)?)/i)
        , tablet = /tablet/i.test(ua)
        , mobile = !tablet && /[^-]mobi/i.test(ua)
        , xbox = /xbox/i.test(ua)
        , result

    if (/opera/i.test(ua)) {
        //  an old Opera
        result = {
            name: 'Opera'
            , opera: t
            , version: versionIdentifier || getFirstMatch(/(?:opera|opr|opios)[\s\/](\d+(\.\d+)?)/i)
        }
    } else if (/opr|opios/i.test(ua)) {
        // a new Opera
        result = {
            name: 'Opera'
            , opera: t
            , version: getFirstMatch(/(?:opr|opios)[\s\/](\d+(\.\d+)?)/i) || versionIdentifier
        }
    }
    else if (/SamsungBrowser/i.test(ua)) {
        result = {
            name: 'Samsung Internet for Android'
            , samsungBrowser: t
            , version: versionIdentifier || getFirstMatch(/(?:SamsungBrowser)[\s\/](\d+(\.\d+)?)/i)
        }
    }
    else if (/coast/i.test(ua)) {
        result = {
            name: 'Opera Coast'
            , coast: t
            , version: versionIdentifier || getFirstMatch(/(?:coast)[\s\/](\d+(\.\d+)?)/i)
        }
    }
    else if (/yabrowser/i.test(ua)) {
        result = {
            name: 'Yandex Browser'
            , yandexbrowser: t
            , version: versionIdentifier || getFirstMatch(/(?:yabrowser)[\s\/](\d+(\.\d+)?)/i)
        }
    }
    else if (/ucbrowser/i.test(ua)) {
        result = {
            name: 'UC Browser'
            , ucbrowser: t
            , version: getFirstMatch(/(?:ucbrowser)[\s\/](\d+(?:\.\d+)+)/i)
        }
    }
    else if (/mxios/i.test(ua)) {
        result = {
            name: 'Maxthon'
            , maxthon: t
            , version: getFirstMatch(/(?:mxios)[\s\/](\d+(?:\.\d+)+)/i)
        }
    }
    else if (/epiphany/i.test(ua)) {
        result = {
            name: 'Epiphany'
            , epiphany: t
            , version: getFirstMatch(/(?:epiphany)[\s\/](\d+(?:\.\d+)+)/i)
        }
    }
    else if (/puffin/i.test(ua)) {
        result = {
            name: 'Puffin'
            , puffin: t
            , version: getFirstMatch(/(?:puffin)[\s\/](\d+(?:\.\d+)?)/i)
        }
    }
    else if (/sleipnir/i.test(ua)) {
        result = {
            name: 'Sleipnir'
            , sleipnir: t
            , version: getFirstMatch(/(?:sleipnir)[\s\/](\d+(?:\.\d+)+)/i)
        }
    }
    else if (/k-meleon/i.test(ua)) {
        result = {
            name: 'K-Meleon'
            , kMeleon: t
            , version: getFirstMatch(/(?:k-meleon)[\s\/](\d+(?:\.\d+)+)/i)
        }
    }
    else if (windowsphone) {
        result = {
            name: 'Windows Phone'
            , windowsphone: t
        }
        if (edgeVersion) {
            result.msedge = t
            result.version = edgeVersion
        }
        else {
            result.msie = t
            result.version = getFirstMatch(/iemobile\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/msie|trident/i.test(ua)) {
        result = {
            name: 'Internet Explorer'
            , msie: t
            , version: getFirstMatch(/(?:msie |rv:)(\d+(\.\d+)?)/i)
        }
    } else if (chromeos) {
        result = {
            name: 'Chrome'
            , chromeos: t
            , chromeBook: t
            , chrome: t
            , version: getFirstMatch(/(?:chrome|crios|crmo)\/(\d+(\.\d+)?)/i)
        }
    } else if (/chrome.+? edge/i.test(ua)) {
        result = {
            name: 'Microsoft Edge'
            , msedge: t
            , version: edgeVersion
        }
    }
    else if (/vivaldi/i.test(ua)) {
        result = {
            name: 'Vivaldi'
            , vivaldi: t
            , version: getFirstMatch(/vivaldi\/(\d+(\.\d+)?)/i) || versionIdentifier
        }
    }
    else if (sailfish) {
        result = {
            name: 'Sailfish'
            , sailfish: t
            , version: getFirstMatch(/sailfish\s?browser\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/seamonkey\//i.test(ua)) {
        result = {
            name: 'SeaMonkey'
            , seamonkey: t
            , version: getFirstMatch(/seamonkey\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/firefox|iceweasel|fxios/i.test(ua)) {
        result = {
            name: 'Firefox'
            , firefox: t
            , version: getFirstMatch(/(?:firefox|iceweasel|fxios)[ \/](\d+(\.\d+)?)/i)
        }
        if (/\((mobile|tablet);[^\)]*rv:[\d\.]+\)/i.test(ua)) {
            result.firefoxos = t
        }
    }
    else if (silk) {
        result =  {
            name: 'Amazon Silk'
            , silk: t
            , version : getFirstMatch(/silk\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/phantom/i.test(ua)) {
        result = {
            name: 'PhantomJS'
            , phantom: t
            , version: getFirstMatch(/phantomjs\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/slimerjs/i.test(ua)) {
        result = {
            name: 'SlimerJS'
            , slimer: t
            , version: getFirstMatch(/slimerjs\/(\d+(\.\d+)?)/i)
        }
    }
    else if (/blackberry|\bbb\d+/i.test(ua) || /rim\stablet/i.test(ua)) {
        result = {
            name: 'BlackBerry'
            , blackberry: t
            , version: versionIdentifier || getFirstMatch(/blackberry[\d]+\/(\d+(\.\d+)?)/i)
        }
    }
    else if (webos) {
        result = {
            name: 'WebOS'
            , webos: t
            , version: versionIdentifier || getFirstMatch(/w(?:eb)?osbrowser\/(\d+(\.\d+)?)/i)
        };
        /touchpad\//i.test(ua) && (result.touchpad = t)
    }
    else if (/bada/i.test(ua)) {
        result = {
            name: 'Bada'
            , bada: t
            , version: getFirstMatch(/dolfin\/(\d+(\.\d+)?)/i)
        };
    }
    else if (tizen) {
        result = {
            name: 'Tizen'
            , tizen: t
            , version: getFirstMatch(/(?:tizen\s?)?browser\/(\d+(\.\d+)?)/i) || versionIdentifier
        };
    }
    else if (/qupzilla/i.test(ua)) {
        result = {
            name: 'QupZilla'
            , qupzilla: t
            , version: getFirstMatch(/(?:qupzilla)[\s\/](\d+(?:\.\d+)+)/i) || versionIdentifier
        }
    }
    else if (/chromium/i.test(ua)) {
        result = {
            name: 'Chromium'
            , chromium: t
            , version: getFirstMatch(/(?:chromium)[\s\/](\d+(?:\.\d+)?)/i) || versionIdentifier
        }
    }
    else if (/chrome|crios|crmo/i.test(ua)) {
        result = {
            name: 'Chrome'
            , chrome: t
            , version: getFirstMatch(/(?:chrome|crios|crmo)\/(\d+(\.\d+)?)/i)
        }
    }
    else if (android) {
        result = {
            name: 'Android'
            , version: versionIdentifier
        }
    }
    else if (/safari|applewebkit/i.test(ua)) {
        result = {
            name: 'Safari'
            , safari: t
        }
        if (versionIdentifier) {
            result.version = versionIdentifier
        }
    }
    else if (iosdevice) {
        result = {
            name : iosdevice == 'iphone' ? 'iPhone' : iosdevice == 'ipad' ? 'iPad' : 'iPod'
        }
        // WTF: version is not part of user agent in web apps
        if (versionIdentifier) {
            result.version = versionIdentifier
        }
    }
    else if(/googlebot/i.test(ua)) {
        result = {
            name: 'Googlebot'
            , googlebot: t
            , version: getFirstMatch(/googlebot\/(\d+(\.\d+))/i) || versionIdentifier
        }
    }
    else {
        result = {
            name: getFirstMatch(/^(.*)\/(.*) /),
            version: getSecondMatch(/^(.*)\/(.*) /)
        };
    }

    // set webkit or gecko flag for browsers based on these engines
    if (!result.msedge && /(apple)?webkit/i.test(ua)) {
        if (/(apple)?webkit\/537\.36/i.test(ua)) {
            result.name = result.name || "Blink"
            result.blink = t
        } else {
            result.name = result.name || "Webkit"
            result.webkit = t
        }
        if (!result.version && versionIdentifier) {
            result.version = versionIdentifier
        }
    } else if (!result.opera && /gecko\//i.test(ua)) {
        result.name = result.name || "Gecko"
        result.gecko = t
        result.version = result.version || getFirstMatch(/gecko\/(\d+(\.\d+)?)/i)
    }

    // set OS flags for platforms that have multiple browsers
    if (!result.windowsphone && !result.msedge && (android || result.silk)) {
        result.android = t
    } else if (!result.windowsphone && !result.msedge && iosdevice) {
        result[iosdevice] = t
        result.ios = t
    } else if (mac) {
        result.mac = t
    } else if (xbox) {
        result.xbox = t
    } else if (windows) {
        result.windows = t
    } else if (linux) {
        result.linux = t
    }

    // OS version extraction
    var osVersion = '';
    if (result.windowsphone) {
        osVersion = getFirstMatch(/windows phone (?:os)?\s?(\d+(\.\d+)*)/i);
    } else if (iosdevice) {
        osVersion = getFirstMatch(/os (\d+([_\s]\d+)*) like mac os x/i);
        osVersion = osVersion.replace(/[_\s]/g, '.');
    } else if (android) {
        osVersion = getFirstMatch(/android[ \/-](\d+(\.\d+)*)/i);
    } else if (result.webos) {
        osVersion = getFirstMatch(/(?:web|hpw)os\/(\d+(\.\d+)*)/i);
    } else if (result.blackberry) {
        osVersion = getFirstMatch(/rim\stablet\sos\s(\d+(\.\d+)*)/i);
    } else if (result.bada) {
        osVersion = getFirstMatch(/bada\/(\d+(\.\d+)*)/i);
    } else if (result.tizen) {
        osVersion = getFirstMatch(/tizen[\/\s](\d+(\.\d+)*)/i);
    }
    if (osVersion) {
        result.osversion = osVersion;
    }

    // device type extraction
    var osMajorVersion = osVersion.split('.')[0];
    if (
        tablet
        || nexusTablet
        || iosdevice == 'ipad'
        || (android && (osMajorVersion == 3 || (osMajorVersion >= 4 && !mobile)))
        || result.silk
    ) {
        result.tablet = t
    } else if (
        mobile
        || iosdevice == 'iphone'
        || iosdevice == 'ipod'
        || android
        || nexusMobile
        || result.blackberry
        || result.webos
        || result.bada
    ) {
        result.mobile = t
    }

    // Graded Browser Support
    // http://developer.yahoo.com/yui/articles/gbs
    if (result.msedge ||
        (result.msie && result.version >= 10) ||
        (result.yandexbrowser && result.version >= 15) ||
        (result.vivaldi && result.version >= 1.0) ||
        (result.chrome && result.version >= 20) ||
        (result.samsungBrowser && result.version >= 4) ||
        (result.firefox && result.version >= 20.0) ||
        (result.safari && result.version >= 6) ||
        (result.opera && result.version >= 10.0) ||
        (result.ios && result.osversion && result.osversion.split(".")[0] >= 6) ||
        (result.blackberry && result.version >= 10.1)
        || (result.chromium && result.version >= 20)
    ) {
        result.a = t;
    }
    else if ((result.msie && result.version < 10) ||
        (result.chrome && result.version < 20) ||
        (result.firefox && result.version < 20.0) ||
        (result.safari && result.version < 6) ||
        (result.opera && result.version < 10.0) ||
        (result.ios && result.osversion && result.osversion.split(".")[0] < 6)
        || (result.chromium && result.version < 20)
    ) {
        result.c = t
    } else result.x = t

    return result
}

var bowser = detect(typeof navigator !== 'undefined' ? navigator.userAgent || '' : '');

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

function showHideRegisterPassword(e) {
    $("#register-show-btn").click(function () {
        $("#register-hide-btn").show(), $("#register-show-btn").hide(), $(e).attr("type", "text")
    }), $("#register-hide-btn").click(function () {
        $("#register-hide-btn").hide(), $("#register-show-btn").show(), $(e).attr("type", "password")
    })
}

function openWithApp(appLink, webURL) {
    var timeout = 5000,
        timeDelay = 500,
        openTime = Date.now(),
        timer;

    if(isMobile()){
        window.location.href = appLink;
        timer = setTimeout(function () {
            if (Date.now() - openTime < timeout + timeDelay) {
                window.open(webURL);
            }else{
                clearTimeout(timer);
            }
        }, timeout);
    }else{
        window.open(webURL);
    }
}

function isMobile() {
    var userAgentInfo = navigator.userAgent;
    var mobileAgents = [ "Android", "iPhone", "SymbianOS", "Windows Phone", "iPad","iPod"];
    var mobile_flag = false;
    //根据userAgent判断是否是手机
    for (var v = 0; v < mobileAgents.length; v++) {
        if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
            mobile_flag = true;
            break;
        }
    }
    var screen_width = window.screen.width;
    var screen_height = window.screen.height;

    //根据屏幕分辨率判断是否是手机
    if(screen_width < 500 && screen_height < 800){
        mobile_flag = true;
    }
    return mobile_flag;
}

function getTrace() {
    var params = {};
    var url	= window.location.href || '';
    var urlParts = url.replace('http://','').replace('https://','').split(/[/?#]/);
    var domain = urlParts[0];
    var uuid = guid();
    params.url	= url;
    params.domain = domain;
    params.device = getDevice();
    params.user_agent = navigator.userAgent;
    var userLang = navigator.language || navigator.userLanguage;
    params.browser 	= bowser.name;  //浏览器名称
    params.browser_version 	= bowser.version;  //浏览器版本
    params.browser_date 	= getDate();  //浏览器时间
    params.browser_lang 	= userLang;   //浏览器语言
    var os_info = getOperate();
    params.operate 			= os_info.operate;     //操作系统
    params.operate_relase 	= os_info.operate_relase;  //操作系统详细
    params.refer_url = document.referrer || '';
    var _fto = Get_Cookie('_fto');
    var _fta = Get_Cookie('_fta');
    if(_fto){
        Set_Cookie('_fto',1, 0.6, '/', '', '');
        first_page = 0;
    }else{
        first_page = 1;
        Set_Cookie('_fto',1, 0.6, '/', '', '');
        if(_fta){
            Set_Cookie( '_ftreturn',1, 36500, '/', '', '' );
        }else{
            Set_Cookie( '_ftreturn',0, 36500, '/', '', '' );
        }
    }
    thisreferrer = document.referrer || '';
    first_refer_url = '';
    if(!Get_Cookie( '_ftreferdomain')){
        if(!thisreferrer){
            thisreferrer_domain = "redirect";
            first_refer_url = "redirect";
        }else{
            first_refer_url = thisreferrer;
            thisreferrer_domain = thisreferrer.replace('http://','').replace('https://','').split(/[/?#]/)[0];
            t_domain = document.domain;
            t_domain = t_domain.match(/[^\.]*\.[^.]*$/)[0];
            if(thisreferrer_domain){
                indexOf = thisreferrer_domain.indexOf(t_domain);
                if(indexOf != -1){
                    thisreferrer_domain = "redirect";
                    first_refer_url = "redirect";
                }
            }
        }
        Set_Cookie('_ftreferdomain',thisreferrer_domain, 0.6, '/', '', '');
        Set_Cookie('_ftreferurl',first_refer_url, 0.6, '/', '', '');
    }else{
        d_ftreferdomain = Get_Cookie('_ftreferdomain');
        Set_Cookie('_ftreferdomain',d_ftreferdomain, 0.6, '/', '', '');
        d_ftreferurl =  Get_Cookie( '_ftreferurl');
        Set_Cookie('_ftreferurl',d_ftreferurl, 0.6, '/', '', '');
    }
    params.first_referrer_domain = Get_Cookie('_ftreferdomain');
    params.first_referrer_url = Get_Cookie('_ftreferurl');
    params.is_new = Get_Cookie('_ftreturn')==0?1:0;
    params.first_page = first_page;
    if (cookie_uuid = Get_Cookie('_fta')){
        params.uuid = cookie_uuid;
    }else{
        params.uuid = uuid;
        Set_Cookie( '_fta', uuid, 36500, '/', '', '' );
    }
    if(window && window.screen) {
        if(window.devicePixelRatio){
            devicePixelRatio = window.devicePixelRatio;
            params.device_pixel_ratio = devicePixelRatio;
            params.resolution = (window.screen.width*devicePixelRatio || 0) +"x"+ (window.screen.height*devicePixelRatio || 0);
        }else{
            params.resolution = (window.screen.width || 0) +"x"+ (window.screen.height || 0);
        }
        params.color_depth = window.screen.colorDepth || 0;
    }
    return params;
}

function fpid(params) {
    $.ajax({
        type: "post",
        url: "/fpid",
        data: params,
        dataType: "json",
        success: function(resp){
            console.log(resp)
        },
        error: function(){
            console.log('error')
        }
    });
}

function fevent(params) {
    $.ajax({
        type: "post",
        url: "/fevent",
        data: params,
        dataType: "json",
        success: function(resp){
            console.log(resp)
        },
        error: function(){
            console.log('error')
        }
    });
}

function guid() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
}

function getVersionPrecision(version) {
    return version.split(".").length;
}

function getDevice(){
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        webOS:function() {
            return navigator.userAgent.match(/webOS/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iPhone: function() {
            return navigator.userAgent.match(/iPhone/i);
        },
        iPad: function() {
            return navigator.userAgent.match(/iPad/i);
        },
        iPod: function() {
            return navigator.userAgent.match(/iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iPad() ||isMobile.iPod() || isMobile.iPhone() || isMobile.Opera() || isMobile.Windows());
        }
    };
    var str = "";
    if( isMobile.Android() ) { str = "Android";  }
    if( isMobile.webOS() ) { str = "webOS";  }
    if( isMobile.BlackBerry() ) { str = "BlackBerry";  }
    if( isMobile.iPhone() ) { str =  "iPhone";  }
    if( isMobile.iPad() ) { str =  "iPad";  }
    if( isMobile.iPod() ) { str =  "iPod";  }
    if( isMobile.Opera() ) { str =  "Opera";  }
    if( isMobile.Windows() ) { str =  "Windows";  }
    if(str){
        return "Mobile:"+str;
    }else{
        return "PC";
    }
}

function Set_Cookie(name, value, expires, path, domain, secure)
{
    domain = document.domain;
    domain = domain.match(/[^\.]*\.[^.]*$/)[0];
    var today = new Date();
    today.setTime(today.getTime());

    if (expires)
    {
        expires = expires * 1000 * 60 * 60 * 24;
    }else{
        expires = expires * 20 * 365 * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date(today.getTime() + (expires));
    document.cookie = name + "=" +escape( value ) +
        ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
        ( ( path ) ? ";path=" + path : "" ) +
        ( ( domain ) ? ";domain=" + domain : "" ) +
        ( ( secure ) ? ";secure" : "" );
}

function Get_Cookie(check_name) {
    var a_all_cookies = document.cookie.split(';');
    var a_temp_cookie = '';
    var cookie_name = '';
    var cookie_value = '';
    var b_cookie_found = false;
    for (i = 0; i < a_all_cookies.length; i++ )
    {
        a_temp_cookie = a_all_cookies[i].split( '=' );
        cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
        if (cookie_name == check_name)
        {
            b_cookie_found = true;
            if (a_temp_cookie.length > 1 )
            {
                cookie_value = unescape(a_temp_cookie[1].replace(/^\s+|\s+$/g, ''));
            }
            return cookie_value;
            break;
        }
        a_temp_cookie = null;
        cookie_name = '';
    }
    if (!b_cookie_found)
    {
        return null;
    }
}

function Delete_Cookie(name, path, domain) {
    domain = document.domain;
    domain = domain.match(/[^\.]*\.[^.]*$/)[0];
    if (Get_Cookie(name)) document.cookie = name + "=" +
        ( ( path ) ? ";path=" + path : "") +
        ( ( domain ) ? ";domain=" + domain : "" ) +
        ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getDate(){
    var currentdate = new Date();
    month = currentdate.getMonth()+1;if(month<10){month = "0"+month;}
    day = currentdate.getDate();if(day<10){day = "0"+day;}
    hours = currentdate.getHours();if(hours<10){hours = "0"+hours;}
    minutes = currentdate.getMinutes();if(minutes<10){minutes = "0"+minutes;}
    second = currentdate.getSeconds();if(second<10){second = "0"+second;}
    var datetime =  currentdate.getFullYear() + "-"
        + month  + "-"
        + day + " "
        + hours + ":"
        + minutes + ":"
        + second;
    return datetime ;
}

function getOperate(){
    operate_relase = "";
    var OS_Name = navigator.appVersion;
    if (OS_Name.indexOf("Win") != -1) {
        operate = "Windows";

        if ((OS_Name.indexOf("Windows 95") != -1)||
            (OS_Name.indexOf("Win95") != -1) ||
            (OS_Name.indexOf("Windows_95") != -1)
        ) {
            operate_relase = "Windows 95";
        }else if ((OS_Name.indexOf("Windows 98") != -1)||
            (OS_Name.indexOf("Win98") != -1)) {
            operate_relase = "Win98";

        }else if ((OS_Name.indexOf("Windows NT 5.0") != -1)||
            (OS_Name.indexOf("Windows 2000") != -1)) {
            operate_relase = "Windows 2000";

        }else if ((OS_Name.indexOf("Windows NT 5.1") != -1)||
            (OS_Name.indexOf("Windows XP") != -1)) {
            operate_relase = "Windows XP";

        }else if (OS_Name.indexOf("Win16") != -1) {
            operate_relase = "Windows 3.11";

        }else if (OS_Name.indexOf("Windows NT 5.2") != -1) {
            operate_relase = "Windows Server 2003";

        }else if (OS_Name.indexOf("Windows NT 6.0") != -1) {
            operate_relase = "Windows Vista";

        }else if (OS_Name.indexOf("Windows NT 6.1") != -1) {
            operate_relase = "Windows 7";

        }else if ((OS_Name.indexOf("Windows NT 4.0") != -1)||
            (OS_Name.indexOf("WinNT4.0") != -1) ||
            (OS_Name.indexOf("WinNT") != -1)||
            (OS_Name.indexOf("Windows NT") != -1)) {
            operate_relase = "Windows NT 4.0";
        }else if (OS_Name.indexOf("Windows ME") != -1) {
            operate_relase = "Windows ME";
        }


    } else if (OS_Name.indexOf("Mac") != -1) {
        operate = "Mac OS";
    } else if (OS_Name.indexOf("X11") != -1) {
        operate = "Unix";
    } else if (OS_Name.indexOf("Linux") != -1) {
        operate = "Linux";
    } else if (OS_Name.indexOf("SunOS") != -1) {
        operate = "Sun OS";
    } else if (OS_Name.indexOf("OpenBSD") != -1) {
        operate = "Open BSD";

    } else if (OS_Name.indexOf("QNX") != -1) {
        operate = "QNX";
    } else if (OS_Name.indexOf("BeOS") != -1) {
        operate = "BeOS";
    } else if (OS_Name.indexOf("OS/2") != -1) {
        operate = "OS/2";
    } else if ((OS_Name.indexOf("nuhk") != -1)
        || (OS_Name.indexOf("Googlebot") != -1)
        || (OS_Name.indexOf("Yammybot") != -1)
        || (OS_Name.indexOf("Openbot") != -1)
        || (OS_Name.indexOf("Slurp") != -1)
        || (OS_Name.indexOf("MSNBot") != -1)
        || (OS_Name.indexOf("Ask Jeeves/Teoma") != -1)
        || (OS_Name.indexOf("ia_archiver") != -1)
    ) {
        operate = "Search Bot";
    }else{
        operate = "unknow";
    }
    return {"operate": operate, "operate_relase": operate_relase}
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