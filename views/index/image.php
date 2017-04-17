<?php
	foreach ($this->image as $image) { ?>
		<a href="<?php echo URL . 'index/images'; ?>">
			<img src="<?php echo URL . $image['path'];?>" 
				alt="<?php echo $image['description'];?>" 
				<?php if($image['height'] > 600){echo 'height="600"';}?> 
				<?php if($image['width'] > 600){echo 'width="600"';}?> >
		</a>
		<br>
		<h2><?php echo $image['description'];?></h2>
<?php 
	} 
?>