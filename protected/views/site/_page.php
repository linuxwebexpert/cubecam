<?php
$pageUri = Yii::app()->getRequest()->requestUri;
?>
<style type="text/css">
<?php 
switch (true) {
	case preg_match("%matrix%i",$pageUri):
		$width = "1220";
		break;
	default;
		$width = '980';
}
	$span = .765 * $width;
	
	echo "#page {\nwidth: ".$width."px;\n}.span-19 {\nwidth: ".$span."px;\n}\n";
?>
</style>
<?php 
	echo "<!-- width = $width -->";
?>