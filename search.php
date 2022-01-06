<?php
include('inc/header.php');

?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<?php

			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_product'])) {
				$tukhoa = $_POST['tukhoa'];
				$search_product = $cat->search_product($tukhoa);
			}
			?>
			<div class="heading">
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php

			if ($search_product) {
				while ($result = $search_product->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4" style="width:23.8%;">
						<a href="preview-3.html"><img src="admin/uploads/<?php echo $result['hinhanh']  ?>" height="120px" alt="" /></a>
						<h2><?php echo $result['productName'] ?> </h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
						<p><span class="price"><?php echo number_format($result['price']) . " " . "VNĐ" ?></span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productid'] ?>" class="details">Xem chi tiết</a></span></div>
					</div>
			<?php }
			} else {
				echo " <span style='color:red;'>Hiện tại sản phẩm này chưa có trong cửa hàng !</span> ";
			} ?>
		</div>



	</div>
</div>
<?php
include('inc/footer.php');

?>