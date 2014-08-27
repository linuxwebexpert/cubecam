<?php
$this->breadcrumbs=array(
	ucwords($this->id),
	ucwords($this->action->id)
);

$this->menu=array(
array('label'=>'Security Index', 'url'=>array('index')),
array('label'=>'Security Admin', 'url'=>array('admin')),
);

?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<div style="float:right;clear:both;margin-right:3em;">
<?php 

// $this->widget('application.widgets.SimplaPager', array(
// 		'pages'=>$pages,
// 		'pageSize'=>$page_size,
// 		'itemCount'=>$item_count,
// 		'currentPage'=>$pages->getCurrentPage(),
// 		'htmlOptions'=> array('class'=>'yiiPager')
// ));

?>
<?php 
// the pagination widget with some options to mess
$this->widget('CLinkPager', array(
		'currentPage'=>$pages->getCurrentPage(),
		'itemCount'=>$item_count,
		'pageSize'=>$page_size,
		'maxButtonCount'=>10,
// 		'firstPageLabel' => 'First',
// 		'lastPageLabel' => 'Last',
		//'nextPageLabel'=>'My text >',
		'header'=>'',
// 		'htmlOptions'=>array('class'=>'pages'),
));
?>
</div>
<center>
<div style="clear:both;">
<?php 
foreach ($model as $image)
{

	echo '<a class="security" href="'. preg_replace('%.+/html%','',$image->filename).'" title="'.$image->time_stamp.'">';
	echo '<img src="'. preg_replace('%.+/html%','',$image->filename).'" class="thumb"  alt="'.$image->time_stamp.'"/>';
	
	echo '</a>';
}
?>
</div>
</center>
