<?php
use yii\helpers\Url;
use backend\assets\LayuiAsset;

LayuiAsset::addScript($this, 'plugins/echarts/echarts.min.js');
?>
<div class="layui-body layui-form top-50">
    <div class="layui-tab marg0" lay-filter="tab" id="top_tabs_box">
        <ul class="layui-tab-title top_tab" id="top_tabs">
            <li class="layui-this" lay-id=""><i class="iconfont">&#xe603;</i> <cite>后台首页</cite></li>
        </ul>
        <ul class="layui-nav closeBox">
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="iconfont icon-dianji"></i>操作</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" class="refresh refreshThis"><i class="iconfont icon-refresh"></i> 刷新当前</a></dd>
                    <dd><a href="javascript:;" class="closePageOther"><i class="iconfont icon-guanbi"></i> 关闭其他</a></dd>
                    <dd><a href="javascript:;" class="closePageAll"><i class="iconfont icon-close"></i> 关闭全部</a></dd>
                </dl>
            </li>
        </ul>
        <div class="layui-tab-content clildFrame">
            <div class="layui-tab-item layui-show" style="margin-top: 15px">
                <div style="margin-bottom: 20px; padding-left: 30px">
                    <h5><i class="fa fa-clock-o"></i>系统时间：<span id="showTime"></span></h5>
                </div>
                <div class="clearfix"></div>
                <div id="echarts_box1" style="width: 50%;height:50%;float: left">

                </div>
                <div id="echarts_box2" style="width: 50%;height:50%;float: left">

                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        function formatTimeZone(dt, offset)
        {
            var localTime = dt.getTime();
            var localOffset = dt.getTimezoneOffset()*60000;
            var utc = localTime + localOffset;
            var wishTime= utc + (3600000 * offset);
            return new Date(wishTime);
        }
        function p(s)
        {
            return s < 10 ? '0' + s : s;
        }
        function time()
        {
            var dt = new Date();
            var mt = formatTimeZone(dt, -7)
            var Y = mt.getFullYear();//获取年
            var M = p(mt.getMonth() + 1);//获取月
            var d = p(mt.getDate());//获取日
            var h = p(mt.getHours());//获取时
            var m = p(mt.getMinutes());//获取分
            var s = p(mt.getSeconds());//获取秒
            document.getElementById("showTime").innerHTML =  Y + "-" + M + "-" + d + " " + h + ":" + m + ":" + s;
            setTimeout("time()",1000); //设定定时器，循环运行
        }
        time();
    </script>
<?php $this->beginBlock('map') ?>
    var myChart1 = echarts.init(document.getElementById('echarts_box1'));
    var myChart2 = echarts.init(document.getElementById('echarts_box2'));

    option1 = {
        title: {
            text: '访问统计图',
            left:'center'
        },
        tooltip: {
            trigger: 'axis'
        },
        grid: {
            left: '3%',
            right: '6%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            name:'时间',
            type: 'category',
            boundaryGap: false,
            data: <?=json_encode($data['pv']['date']);?>
        },
        yAxis: {
            name: '访问量',
            type : 'value'
        },
        series: [
            {
                name:'历史访问数量',
                type:'line',
                stack: '总量',
                data:<?=json_encode($data['pv']['num']);?>
            },
            {
                name:'历史访问人数',
                type:'line',
                stack: '人数',
                data:<?=json_encode($data['pv']['user']);?>
            },
        ]
    };

    option2 = {
        title: {
            text: '今日访问统计图',
            left:'center'
        },
        color: ['#3398DB'],
        tooltip : {
            trigger: 'axis',
            axisPointer : {
                type : 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                name: 'IP地址',
                type : 'category',
                data : <?=json_encode($data['x1']);?>,
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                name: '访问量',
                type : 'value'
            }
        ],
        series : [
            {
                name:'访问量',
                type:'bar',
                barWidth: '60%',
                data:<?=json_encode($data['y1']);?>
            }
        ]
    }

    myChart1.setOption(option1);
    myChart2.setOption(option2);
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['map'], \yii\web\View::POS_END); ?>