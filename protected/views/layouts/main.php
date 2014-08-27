<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<body>
<?php 
Controller::topMenu();

Yii::app()->clientScript->registerCoreScript('jquery');

$rs=Yii::app()->clientScript;  
$baseurl = Yii::app()->baseUrl;
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jqueryslidemenu.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.resizeframe.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.alerts.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.ui.draggable.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.thumbs.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.fancybox-1.3.4.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.fancybox-1.3.4.pack.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.mousewheel-3.0.4.pack.js', CClientScript::POS_HEAD);
$rs->registerScriptFile($baseurl . '/assets/6b36338b/jquery.easing-1.3.pack.js', CClientScript::POS_HEAD);
$rs->registerCssFile($baseurl.'/css/solaria.css');
$rs->registerCssFile($baseurl.'/css/jquery.alerts.css');
$rs->registerCssFile($baseurl.'/css/jquery.thumbs.css');
$rs->registerCssFile($baseurl.'/css/jquery.fancybox-1.3.4.css');
//Register jQuery, JS and CSS files
$rs->registerCssFile($baseurl.'/css/jqueryslidemenu.css');

?>

<?php echo $this->renderPartial('_page', array('this'=>$this)); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".thumb").thumbs();
		$(".gridThumb").thumbs();
		$(".security").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
		});
	});
</script>
</head>

<body>

	<div id="canvas">
		<div id="leftpanel"></div>
		<div id="rightpanel"></div>
		<center>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?>
		<a href="http://companyweb" title="Solaria Company Intranet">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/image001.gif" alt="Solaria Company Intranet" title="Solaria Company Intranet" style="float:right; margin: 0px 5px 0px 5px;" />
		</a>
		</div>
	</div><!-- header -->

<?php 
/*
 * 
 	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Security', 'url'=>array('/security/index')),
				array('label'=>'Admin', 'url'=>array('/security/admin')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
*
*/
?>
	 <div id="myslidemenu" class="jqueryslidemenu">
	 <?php 
	 	$this->widget('zii.widgets.CMenu',$this->topMenu);
	 ?>
	 <br style="clear:left;" />
	 </div><!-- slidemenu -->
	<br style="clear:both;" />

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Solaria<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
</center>
</div> <!-- canvas -->
</body>
</html>
