<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
	$cat = new category();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delcat = $cat->del_category($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">   
					<?php
						if(isset($delcat)){
							echo $delcat;
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
							$show_cate = $cat->show_category();
							if($show_cate){
								$i =0;
								while($result = $show_cate->fetch_assoc()){
									$i++;
								
						?>
						<tr class="even gradeC">
							<td><?php echo $result['catid'];; ?></td>
							<td><?php echo $result['catName']; ?> </td>
							<td><a href="catedit.php?catid=<?php echo $result['catid'] ?>">Sửa</a> || <a onclick = "return confirm('bạn có chắc là bạn muốn xóa danh mục <?php echo $result['catName']; ?>')" href="?delid=<?php echo $result['catid'] ?>">Xóa</a></td>
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

