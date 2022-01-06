
<div class="header_bottom">
	
	<div class="header_bottom_right_images" style="width:100% ; margin-left:0%;">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php 
						$cat = new category();
						$get_slider = $cat->show_slider();
						if($get_slider){
							while($result_slider = $get_slider->fetch_assoc()){

							
					?>
					<li><img src="admin/uploads/<?php echo $result_slider['slider_hinhanh'] ?>" alt="" /></li>
					<?php }
						} ?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>