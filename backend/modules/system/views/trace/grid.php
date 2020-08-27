<?php
use yii\helpers\Url;
use backend\assets\LayuiAsset;

LayuiAsset::addScript($this, 'plugins/echarts/echarts.min.js');
?>
    <div class="layui-tab-content clildFrame">
        <div class="layui-tab-item layui-show">
            <div id="echarts_box1" style="width: 50%;height:50%;float: left">

            </div>
            <div id="echarts_box2" style="width: 50%;height:50%;float: left">

            </div>
        </div>
    </div>
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
    right: '4%',
    bottom: '3%',
    containLabel: true
    },
    xAxis: {
    name:'时间',
    type: 'category',
    boundaryGap: false,
    data: <?=json_encode($data['x']);?>
    },
    yAxis: {
    name: '访问量',
    type : 'value'
    },
    series: [
    {
    name:'历史访问次数',
    type:'line',
    stack: '总量',
    data:<?=json_encode($data['y']);?>
    }
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
    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
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
    name:'直接访问',
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