<html>
	<head>
		<title><?php echo Yii::app()->name;?></title>
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/fa.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/main.css" />
		<script type="text/javascript">
			var base_path = "<?php echo Yii::app()->baseUrl;?>";
		</script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/js/main.js"></script>
	</head>
	<body>
		<div class="head">
			<div class="header">
				<div class="content">Learn Hub</div>
			</div>
		</div>
		<div class="body">
			<?php echo $content;?>
		</div>
	</body>
</html>