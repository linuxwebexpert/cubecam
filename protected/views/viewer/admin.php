<?php
$this->breadcrumbs=array(
	'Viewer',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

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
    'id'=>'photo-grid',
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
    		'time_stamp', 
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
    		
