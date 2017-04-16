<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css"/>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
	<?php
	if(isset($this->js)){
		foreach($this->js as $js){
			?><script type="text/javascript" src="<?php echo URL.'views/'.$js; ?>"></script><?php
		}
	}
	?>
</head>
<body>
	<nav>
	<?php Session::init(); ?>
		<div id="header">
			<a href="<?php echo URL; ?>index">Index</a>
			<a href="<?php echo URL; ?>index/upload">Upload</a>
			<a href="<?php echo URL; ?>index/images">View</a>
			
			
		</div>
	</nav>
	<div id="content">


