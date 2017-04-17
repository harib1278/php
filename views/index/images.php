<div id="image-gallery">
	<div class="inner">
	<?php

	if(isset($this->msg)){ ?>
		<h2><?php echo $this->msg;?></h2>
	<?php } ?>
		<div class="row">
		<?php foreach ($this->images as $image) { ?>				
				<span class="image-title"><?php echo $image['title']; ?></span>
				<a href="<?php echo URL . 'index/image/' . $image['id'];?>"><img src="<?php echo URL . THUMBS_DIRECTORY . $image['thumb'];?>" alt="<?php echo $image['description'];?>"></a>
		<?php } ?>
		</div>
	</div>
</div>