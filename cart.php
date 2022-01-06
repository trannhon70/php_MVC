<?php
include('inc/header.php');

?>

<?php
if (isset($_GET['cartid'])) {
	$cartid = $_GET['cartid'];
	$delcart = $cat->del_product_cart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartid = $_POST['cartid'];
	$quantity = $_POST['quantity'];
	$update_quantity_cart = $cat->update_quantity_cart($quantity, $cartid);
	if ($quantity <= 0) {
		$delcart = $cat->del_product_cart($cartid);
	}
}
?>
<?php
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 style="width:100%;">Giỏ hàng của bạn</h2>
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
						<th width="20%">Tên sản phẩm</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Giá</th>
						<th width="25%">Số lượng</th>
						<th width="20%">Thành tiền</th>
						<th width="10%">Thao tác</th>
					</tr>
					<?php
					$get_product_cart = $cat->get_product_cart();
					if ($get_product_cart) {
						$subtotal = 0;
						$qty = 0;
						while ($result = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></td>
								<td><?php echo number_format($result['price']) . " " . "VNĐ" ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartid" value="<?php echo $result['cartid'] ?>" />
										<input type="number" name="quantity" min="1" max="10" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Cập nhật" />
									</form>
								</td>
								<td><?php $total = $result['price'] * $result['quantity'];
									echo number_format($total) . " " . "VNĐ" ?></td>
								<td><a onclick="return confirm('bạn có chắc là bạn muốn xóa sản phẩm <?php echo $result['productName']; ?>')" href="?cartid=<?php echo $result['cartid'] ?>">Xóa</a></td>
							</tr>

					<?php $subtotal += $total;
							$qty = $qty + $result['quantity'];
						}
					} ?>

				</table>
				<?php
				$check_cart = $cat->check_cart();
				if ($check_cart) {


				?>
					<table  style="float:right;text-align:left;" width="40%">
						<!-- <tr>
							<th>Tổng thu : </th>
							<td><?php

								echo number_format($subtotal) . " " . "VNĐ";
								Session::set("sum", $subtotal);
								Session::set("qty", $qty);
								?></td>
						</tr> -->
						<!-- <tr>
							<th>VAT : </th>
							<td colspan="3">giá sản phẩm đã bao gồm thuế VAT</td>
						</tr> -->
						<tr>
							<th>Tổng số tiền phải thanh toán :</th>
							<td><?php
								// $vat = $subtotal * 0.1;
								// $gtotal = $subtotal + $vat;
								echo number_format($subtotal) . " " . "VNĐ";
								?></td>
						</tr>
					</table>
				<?php } else {
					echo "Giỏ hàng của bạn chưa có sản phẩm nào !";
				} ?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');

?>