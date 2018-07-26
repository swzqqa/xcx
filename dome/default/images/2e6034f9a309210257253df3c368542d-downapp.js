/* Index */
var LycheeUI={}
LycheeUI.userAgent = navigator.userAgent.toLowerCase();
LycheeUI.browser = {
    version: (LycheeUI.userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
    safari: /webkit/.test(LycheeUI.userAgent),
    opera: /opera/.test(LycheeUI.userAgent),
    msie: /msie/.test(LycheeUI.userAgent) && !/opera/.test(LycheeUI.userAgent),
    mozilla: /mozilla/.test(LycheeUI.userAgent) && !/(compatible|webkit)/.test(LycheeUI.userAgent)
};
LycheeUI.phoneList = new Array("2.0 MMP", "240320", "AvantGo", "BlackBerry", "Blazer", "Cellphone", "Danger", "DoCoMo", "Elaine/3.0", "EudoraWeb",
    "hiptop", "IEMobile", "KYOCERA/WX310K", "LG/U990", "MIDP-2.0", "MMEF20", "MOT-V", "NetFront", "Newt", "Nintendo Wii",
    "Nitro", "Nokia","Opera Mini", "Opera Mobi","Palm", "Playstation Portable", "portalmmm", "Proxinet", "ProxiNet",
    "SHARP-TQ-GX10", "Small", "SonyEricsson", "Symbian", "TS21i-10", "UP.Browser", "UP.Link", "Windows CE", "WinWAP",
    "iPhone", "iPod", "Windows Phone", "HTC", "ucweb", "Mobile", "Android");
LycheeUI.isOnTouchStart = function () { return typeof (ontouchstart) != "undefined"; }
LycheeUI.isiPad = function () { return LycheeUI.userAgent.indexOf("ipad") >= 0; }
LycheeUI.isAndroid = function () { return (LycheeUI.userAgent.indexOf("Android") > -1 ||LycheeUI.userAgent.indexOf("android") > -1); }
LycheeUI.isiPhone = function () { return (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1); }
LycheeUI.isPhone = function () {
    if (LycheeUI.isOnTouchStart() && !LycheeUI.isiPad()) {
        return true;
    }
    for (var i = 0; i < LycheeUI.phoneList.length; i++) {
        if (LycheeUI.userAgent.indexOf(LycheeUI.phoneList[i].toLowerCase()) >= 0 && LycheeUI.userAgent.indexOf("ipad") == -1) {
            return true;
        }
    }
    var appNameList = new Array("Microsoft Pocket Internet Explorer");
    for (var i = 0; i < appNameList.length; i++) {
        if (LycheeUI.userAgent.indexOf(appNameList[i]) >= 0) {
            return true;
        }
    }
    return false;
}
LycheeUI.isMobile = function () { return LycheeUI.isOnTouchStart() || LycheeUI.isPhone() || LycheeUI.isiPad();}
$(function() {
    $(".weixin_ico").click(function(){
        if($("#qrRollover").is(":hidden")){
            $("#qrRollover").show();
            closeOutClickWindow();
        }
    })
})
function closeOutClickWindow() {
    document.onclick = outsideOutClickWindow;
    function outsideOutClickWindow(event) {
        event = (event == null) ? window.event : event;
        var srcelement = event.target ? event.target : event.srcElement;
        if (srcelement.getAttribute("author") != "outClick") {
            $(".rollover").css("display", "none");
            document.onclick = null;
        }
    }
}
function supports_video() {
    return !!document.createElement('video').canPlayType;
}
function openVideo(){
    $('.sdialogMask').css({'width':'auto'})
    $('.sdialogMask').show().css({'height':$(document).height(),'width':$(document).width()});
    $(".videoWrap").show();
    var winHeight=$(window).height()-40;
    var winWidth= $(window).width()-40;
    var scrollTop= $(document).scrollTop();
    var videoW=winWidth;
    var videoH=winWidth*(54/96);
    var topMargin=(winHeight-videoH)/2+scrollTop;
    var leftMargin=20;
    if((winWidth/winHeight)>(96/54)){
        videoW=winHeight*(96/54);
        videoH=winHeight;
        leftMargin=(winWidth-videoW)/2;
        topMargin=20+scrollTop;
    }
    $(".videoWrap").css({'width':videoW,'height':videoH,'left':leftMargin,'top':topMargin});
    if((/Android|webOS|iPhone|iPad|iPod|windows Phone|BlackBerry/i.test(navigator.userAgent)) && supports_video()){
        initHtml5Video(videoW,videoH);
        return;
    }
    initVideo(videoW,videoH);
}
function rePosition(){
    var winHeight=$(window).height()-40;
    var winWidth= $(window).width()-40;
    var videoH = $(".videoWrap").height();
    var videoW=$(".videoWrap").width();
    var scrollTop= $(document).scrollTop();
    var topMargin=(winHeight-videoH)/2+scrollTop;
    var leftMargin=(winWidth-videoW)/2;
    $(".videoWrap").css({'left':leftMargin,'top':topMargin});
}
function initHtml5Video(videoW,videoH){
    var videoHtml='<div class="closeBtn" onclick="closeVideo()">关闭</div>'
    +'<video id="Html5Video" width="'+videoW+'" height="'+videoH +'" preload controls> '
    +    '<source src="http://cdn5.lizhi.fm/web_res/lizhi.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' /> '
    +    '<source src="http://cdn5.lizhi.fm/web_res/lizhi.ogg" type=\'video/ogg; codecs="theora, vorbis"\' />'
    +    '<source src="http://cdn5.lizhi.fm/web_res/lizhi.webm" type=\'video/webm; codecs="vp8, vorbis"\' /> '
    +'</video> ';
    $(".videoWrap").append(videoHtml);
}
function initVideo(width,height){
    var videoHtml='<div class="closeBtn" onclick="closeVideo()">关闭</div>'
        +'<a href="http://cdn5.lizhi.fm/web_res/lizhi.flv" style="display:block;width:'
        +width+'px;height:'+height+'px" id="player"></a>';
    $(".videoWrap").append(videoHtml);
    /*
    flowplayer(
        "player",
        "/js/assets/about/flowplayer-3.2.7.swf"
    );
    */
    if(window.newPlayer){
        window.newPlayer.remove();
    }
    window.newPlayer = jwplayer("player").setup({
        file: "http://cdn5.lizhi.fm/web_res/lizhi.flv",
        width: width, height: height,
        autostart: true,
    });
}
function closeVideo(){
    $('.sdialogMask').hide();
    $(".videoWrap").hide().html('');
}
function appDownload(obj){
    var dialog = obj[0]
    var platform = obj.attr('data-platform');
    var $qrcodeDiv = null;
    var qrcodeUrl;
    obj.addClass('js-activeDialog');
    $('.sdialogMask').css({'width':'auto'});
    $('.sdialogMask').show().css({'height':$(document).height(),'width':$(document).width()});
    obj.show();
    //markDownload(platform);
    if(platform === 'android') {
        handleAndroidDialog(dialog);
    } else {
        $qrcodeDiv = obj.find('.js-qrcode');
        qrcodeUrl =  '/images/ioscode.png?2016030201';
        replaceBackgroundWithImg($qrcodeDiv, qrcodeUrl);
    }
    var winHeight=$(window).height()-40;
    var winWidth= $(window).width()-40;
    var scrollTop= $(document).scrollTop();
    var topMargin=(winHeight-290)/2+scrollTop;
    obj.css({'top':topMargin});
    closeOutClickAndroid()
    obj.removeClass('js-activeDialog');
}
function closeAppDownload(){
    $('.sdialogMask').hide();
    $(".sdialog").hide();
}
function closeOutClickAndroid() {
    document.onclick = outsideOutClickAndroid;
    function outsideOutClickAndroid(event) {
        event = (event == null) ? window.event : event;
        var srcelement = event.target ? event.target : event.srcElement;
        if (srcelement.getAttribute("author") != "outClick") {
            closeAppDownload()
            document.onclick = null;
        }
    }
}

//iphone图片滚动
(function() {
    var slider = {
        index: 0,
        len: 254,
        el: $('.iphoneScroll-wrap'),
        slide: function() {
            var self = this;
            var left = ++self.index * 254;
            self.el.animate({left: -left + 'px'}, 550, function() {
                if (self.index == 4) {
                    self.index = 0;
                    self.el.css('left', 0);
                }
            });
        }
    }

    setInterval(function() {
        slider.slide();
    }, 2000);
})();
