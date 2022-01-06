<?php
	include('inc/header.php');
	
 ?>
<?php 
	if(!isset($_GET['catid']) || $_GET['catid']==NULL){
		echo "<script>window.location='404.php'</script>";
	}else{
		$id = $_GET['catid'];
	}
	
	// if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 	$catName = $_POST['catName'];
		
	// 	$updateCat = $cat->update_category($catName,$id) ;
	// }
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php
			 	$namecat = $cat->get_name_by_cat($id);
				 if($namecat) {
					 while($result = $namecat->fetch_assoc()){
			  ?>
    		<div class="heading">
			
    		<h3>Danh mục : <?php echo $result['catName'] ?></h3>
			
    		</div>
			<?php }
				 } ?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			 	$productbycat = $cat->get_product_by_cat($id);
				 if($productbycat) {
					 while($result = $productbycat->fetch_assoc()){
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="admin/uploads/<?php echo $result['hinhanh']  ?>" height="120px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],50) ?></p>
					 <p><span class="price"><?php echo number_format($result['price'])." "."VNĐ" ?></span></p>
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
