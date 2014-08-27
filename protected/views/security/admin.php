<?php
$this->breadcrumbs=array(
	ucwords($this->id),
	ucwords($this->action->id)
);

$this->menu=array(
array('label'=>'Security Index', 'url'=>array('index')),
array('label'=>'Security Admin', 'url'=>array('admin')),
);

$js = '
$(document).ready(function() {
	
	$("input[name=control]").click(
	function ()
	{
		$.ajax({
		    url: "control",
		    type: "POST",
		    data: "option=" + $("input[name=control]:checked").val(),
		    dataType:"text",
		    success: function(text, textStatus, xhr) {
		        console.log(arguments);
		        console.log(xhr.status);
		        $("#controlStatus").val(text);       
		    },
		    complete: function(xhr, textStatus) {
		        console.log(xhr.status);
		    }
		});
	$("input[name=control]").blur();
	});
		
	$("input[name=control][value=status]").attr("checked","checked").click();

});
';
Yii::app()->clientScript->registerScript('control',$js,CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('security-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div style="inline-block;clear:none; width: 640px;">
<div style="inline-block;clear:none;">
<input type="radio" name="control" value="start" style="inline-block;clear:none;"/> Start&nbsp;
<input type="radio" name="control" value="status" style="inline-block;clear:none;"/> Status&nbsp;
<input type="radio" name="control" value="stop" style="inline-block;clear:none;"/> Stop&nbsp;
</div>
<div style="inline-block;clear:none;">
<input id="controlStatus" type="text" value="Awaiting update..." readonly="readonly" size="64" />
</div>
</div>
<br />
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<?php 
/*
foreach ($files as $file)
{
	echo '<a class="frame" href="'.Yii::app()->request->baseUrl.'/files/cam1/'.$file.'" title="'.$file.'">';
	echo '<img src="'.Yii::app()->request->baseUrl.'/files/cam1/'.$file.'" class=".thumb" width="128" style="margin:.5em" />';
	
	echo '</a>';
}
*/
$count = 50;
Yii::import('application.components.EImageColumn');
  $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'security-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
    		'camera', 
			array(
				'class'=> 'EImageColumn',
				'name'=> 'filename',
// 				'type'=> 'raw',
// 				'link' => preg_replace('%.*?/html%','',$data->filename),
    			'linkHtmlOptions' => array('class'=>'security','title'=>'time_stamp'),
				'htmlOptions' => array('class'=>'gridThumb'),
			),
    		'frame', 
    		'file_type', 
//     		'time_stamp', 
    		'event_time_stamp',
    		'changed_pixels',
    		'noise_level',
    		'width', 'height',
    		'x', 'y',
    		array(
    				'class'=>'CButtonColumn',
    		),
   		),
	)); ?>    		
    		
