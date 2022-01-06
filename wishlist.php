<?php
include('inc/header.php');

?>
<?php
    if(isset($_GET['proid'])){
        $customer_id = Session::get('customer_id');
        $proid = $_GET['proid'];
        $delwlist = $cat->del_wlist($proid,$customer_id);
    }
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 style="width:100%;">Sản phẩm yêu thích</h2>
				
				<table class="tblone">
					<tr>
						<th width="">MSP so sánh</th>
						<th width="">Tên sản phẩm</th>
						<th width="">Hình ảnh</th>
						<th width="">Giá</th>
						<th>Thao tác</th>

					</tr>
					<?php
					 $customer_id = Session::get('customer_id');
					$get_wishlist = $cat->get_wishlist($customer_id);
					if($get_wishlist){
						$i = 0;
						while($result = $get_wishlist->fetch_assoc()){
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></td>
								<td><?php echo number_format($result['price']) . " " . "VNĐ" ?></td>

								<td>
                                    <a  href="?proid=<?php echo $result['productid'] ?>">Xóa</a> ||
                                    <a  href="details.php?proid=<?php echo $result['productid'] ?>">Xem chi tiết</a>
                                </td>
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