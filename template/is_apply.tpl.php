<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <title>Coach蔻驰</title>
    <link href = "http://cdn.minnie.coach.samesamechina.com/web/css/base.css" rel="stylesheet" type="text/css">
    <link href = "http://cdn.minnie.coach.samesamechina.com/web/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://coach.samesamechina.com/api/v1/js/2f515ea7-bbbb-45a5-aed2-4988576b856d/wechat"></script>
    <script>
      !function(){function a(){document.documentElement.style.fontSize=document.documentElement.clientWidth/7.5+"px";if(document.documentElement.clientWidth>1080){document.documentElement.style.fontSize='100px'}}var b=null;window.addEventListener("resize",function(){clearTimeout(b),b=setTimeout(a,10)},!1),a()}(window);
    </script>
</head>

<body>
<div id="wrapper">
    <div class="dreambox">
        
        <div class="logo"></div>
        
        <div class="context ycenter">
            <div class="resultArea">
                <div class="result-header">
                    尊敬的顾客<br>您已预约成功
                    <div class="whiteLine"></div>
                </div>
                <div class="result-desc">
                    出示此页面即可兑换夏日冰品一份<br>
                    数量有限，先到先得
                </div>
                <div class="result-footer">
                    <?php print $data->date;?> <span class="get-day"></span><br>
                    <?php print $data->shop;?>期待您的莅临！
                </div>
            </div>
            <div class="copyright"></div>
        </div>


        <!-- 横屏代码 -->
        <div id="orientLayer" class="mod-orient-layer">
            <div class="mod-orient-layer__content">
                <i class="icon mod-orient-layer__icon-orient"></i>
                <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览<br><em>建议全程在wifi环境下观看</em></div>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.minnie.coach.samesamechina.com/web/js/common.js"></script>
<script type="text/javascript">
    var getDayEl = document.querySelector('.get-day'),
        rdate = '<?php print $data->date;?>';
    getDayEl.innerHTML = getDay(rdate);
</script>


</body>
</html>