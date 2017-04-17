<div class="image-display">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<?php
				foreach ($this->image as $image) { ?>
					<a href="<?php echo URL . 'index/images'; ?>">
						<img src="<?php echo URL . $image['path'];?>" 
							alt="<?php echo $image['description'];?>" 
							<?php if($image['height'] > 600){echo 'height="600"';}?> 
							<?php if($image['width'] > 600){echo 'width="600"';}?> >
					</a>
					<br>
					<div class="image-desc">
						<h2><?php echo $image['description'];?></h2>
					</div>
					
			<?php 
				} 
			?>
		</div>		
	</div>		
	<div class="col-md-3"></div>
	</div>
</div>