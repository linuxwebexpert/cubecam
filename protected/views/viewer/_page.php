<?php
$pageUri = Yii::app()->getRequest()->requestUri;
?>
<style type="text/css">
<?php 
switch (true) {
	case preg_match("%admin%i",$pageUri):
		$width = "1040";
		$thumbHeight = 72;
		$thumbWidth = 96;
		$display = "none";
		$fontSize = 10;
		$stripHeight = 12;
		break;
	default;
		$width = '980';
		$thumbHeight = 124;
		$thumbWidth = 128;
		$display = "inline-block";
		$fontSize = 12;
		$stripHeight = 16;
}
	$span = .765 * $width;
	
	echo "#page {\nwidth: ".$width."px;\n}.span-19 {\nwidth: ".$span."px;\n}\n";
?>
.thumb-container {
	background: #FFFFFF;
	/* border: 1px solid; */
	border: none;
	border-color: #ccc #aaa #aaa #ccc;
	text-align: center;
	height: <?php echo $thumbHeight+4;?>px;
	margin: 1px;
	padding: 1px;
	width: <?php echo $thumbWidth+4;?>px;
}

.thumb-container a,
.thumb-container img {
	border: 0;
	margin: 0;
}

.thumb-center img,
.thumb-strip,
.thumb-icon {
	position: absolute;
}

.thumb-center img {
	margin-left: 50%;
	margin-top: 50%;
}
.thumb-strip,
.thumb-icon {
	display:<?php echo $display;?>;
}
.thumb-strip {
	background: #fff; 
	background: rgba(255, 255, 255, 0.5);
	color: #222;
	font: <?php echo $fontSize;?>px/16px Arial, sans-serif;
	height: <?php echo $stripHeight;?>px; 
	bottom: 0;
	left: 0;
	letter-spacing: -1px;
	text-indent: 4px;
	white-space: nowrap;
	text-overflow: ellipsis;
	width: 100%;
}

</style>
<?php 
	echo "<!-- width = $width -->";
?>