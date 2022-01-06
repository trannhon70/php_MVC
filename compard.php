<?php
include('inc/header.php');

?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 style="width:100%;">So sánh sản phẩm</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				?>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="">MSP so sánh</th>
						<th width="">Tên sản phẩm</th>
						<th width="">Hình ảnh</th>
						<th width="">Giá</th>
						<th>Thao tác</th>

					</tr>
					<?php
					// $customer_id = Session::get('customer_id');
					$get_compare = $cat->get_compare($customer_id);
					if($get_compare){
						$i = 0;
						while($result = $get_compare->fetch_assoc()){
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></td>
								<td><?php echo number_format($result['price']) . " " . "VNĐ" ?></td>

								<td><a  href="details.php?proid=<?php echo $result['productid'] ?>">Xem chi tiết</a></td>
							</tr>

					<?php
						}
					} ?>

				</table>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<!-- <div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div> -->
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');

?>