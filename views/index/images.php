<?php

if(isset($this->msg)){ ?>
	<h2><?php echo $this->msg;?></h2>
<?php } ?>
<?php
	foreach ($this->images as $image) { ?>
		<a href="<?php echo URL . 'index/image/' . $image['id'];?>"><img src="<?php echo URL . THUMBS_DIRECTORY . $image['thumb'];?>" alt="<?php echo $image['description'];?>"></a>
<?php 
	} 
?>