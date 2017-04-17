<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
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
	<div id="header">
			
	</div>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">		  
			  <a class="navbar-brand" href="<?php echo URL; ?>">Home</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
			    <li><a href="<?php echo URL; ?>index/upload">Upload</a></li>
			    <li><a href="<?php echo URL; ?>index/images">Images</a></li>		    
			    <li><a href="<?php echo URL; ?>index/api">API</a></li>		    
			  </ul>		
			
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div id="content">


