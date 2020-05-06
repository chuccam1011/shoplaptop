<?php
$slider = new Slider();
$list = $slider->getAllNoLimit();

?>


<div class="slider-area">
	<!-- Slider -->
	<div class="block-slider block-slider4">
		<ul class="" id="bxslider-home4">
			<?php
			foreach ($list as $r) {
			?>
				<li>
					<img  src="<?php echo 'admin/slider/uploads/' . $r['img'] ?>" alt="Slide">
					<div class="caption-group">
						<h2 class="caption title">
						<span class="primary"><strong><?php echo $r['tittle']?></strong></span>
						</h2>
						<!-- <h4 class="caption subtitle">Dual SIM</h4> -->
						<a class="caption button-radius" href="single-product.php?product_id=<?php echo $r['product_id']?>"><span class="icon"></span>Shop Now</a>
					</div>
				</li>
			<?php
			}
			?>
		</ul>
	</div>
	<!-- ./Slider -->
</div> <!-- End slider area -->
