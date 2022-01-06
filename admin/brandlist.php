<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
	$brand = new category();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delbrand = $brand->del_brand($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">   
					<?php
						if(isset($delbrand)){
							echo $delbrand;
						}
					?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Mã danh mục</th>
							<th>tên danh mục</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_brand = $brand->show_brand();
							if($show_brand){
								$i =0;
								while($result = $show_brand->fetch_assoc()){
									$i++;
								
						?>
						<tr class="even gradeC">
							<td><?php echo $result['brand_id']; ?></td>
							<td><?php echo $result['brandName']; ?> </td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brand_id'] ?>">Sửa</a> || <a onclick = "return confirm('bạn có chắc là bạn muốn xóa danh mục <?php echo $result['brandName']; ?>')" href="?delid=<?php echo $result['brand_id'] ?>">Xóa</a></td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

