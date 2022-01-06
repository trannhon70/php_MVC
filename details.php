<?php
include('inc/header.php');

?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {

	//echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proid'];
}
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campare'])) {
	$productid = $_POST['productid'];
	$insertCompare = $cat->insertCompare($productid, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$insertCart = $cat->add_to_cart($quantity, $id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
	$productid = $_POST['productid'];
	$insertWishlist = $cat->insertWishlist($productid, $customer_id);
}

?>


<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $cat->get_details($id);
			if ($get_product_details) {
				while ($result_details = $get_product_details->fetch_assoc()) {

			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['hinhanh']; ?>" alt="..." />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?> </h2>
							<p><?php echo $result_details['catName'] ?></p>
							<div class="price">
								<p>Giá: <span><?php echo number_format($result_details['price']) . " " . "VNĐ" ?></span></p>
								<p>Thương hiệu:<span><?php echo $result_details['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="text" readonly="readonly" class="buyfield" name="quantity" value="1" min="1" max="10" />
									<input type="submit" class="buysubmit" name="submit" value="Thêm vào giỏ hàng" />

								</form>
								<?php
								if (isset($AddtoCart)) {
									echo '<span style="color:red; font-site:18px; margin-top:10px; display:block;">Sản phẩm này đã có trong giở hàng của bạn</span>';
								}
								?>
							</div>
							<div class="add-cart">
								<form action="" method="POST">

									<input type="hidden" class="buysubmit" name="productid" value="<?php echo $result_details['productid'] ?>" />

									<?php
									$login_check = Session::get('customer_login');
									if ($login_check == true) {
										echo '<input type="submit" class="buysubmit" name="campare" value="So sánh sản phẩm" />';
										echo '<input style="margin-left: 2px;" type="submit" class="buysubmit" name="wishlist" value="Thêm vào danh sách yêu thích" />';
									}
									?>
									<div style="margin-top: 10px;">
										<?php
										if (isset($insertCompare)) {
											echo $insertCompare;
										}
										?>
										<?php
										if (isset($insertWishlist)) {
											echo $insertWishlist;
										}
										?>
									</div>
								</form>

								<!-- danh sách yêu thích -->

							</div>
						</div>
						<div class="product-desc">
							<h2>Mô tả chi tiết </h2>
							<p><?php echo $result_details['product_desc'] ?></p>

						</div>

					</div>
			<?php }
			} ?>
			<div class="rightsidebar span_3_of_1">
				<h2>Danh mục</h2>
				<ul>
					<?php
					$getall_category = $cat->show_category_fontend();
					if ($getall_category) {
						while ($result_allcat = $getall_category->fetch_assoc()) {

					?>
							<li><a href="productbycat.php?catid=<?php echo $result_allcat['catid']; ?>"><?php echo $result_allcat['catName']; ?></a></li>
					<?php }
					} ?>
				</ul>

			</div>
		</div>
		<!-- <div class="binhluan">

			<form action="" method="post">
				<input type="text" placeholder="Tên của bạn" class="form-control" name="tennguoibinhluan"><br>
				<textarea name="binhluan" rows="5" style="resize: none;" placeholder="Đánh giá của bạn" class="form-control"></textarea>
				<input type="submit" value="Gửi bình luận" class="btn-success mt-3">
			</form>
		</div> -->
	</div>
	<?php
	include('inc/footer.php');

	?>