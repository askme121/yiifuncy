layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;
		var url = ["<?= yii\helpers\Url::to(['/tools/ico']); ?>",'yes'];
		
		$('.open-icon').click(function(){
			layer.open({title:'图标选择', type: 2, area: ['630px', '530px'], fix: true, maxmin: false, content: url});
		});
});