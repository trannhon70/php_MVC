<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertSlider = $cat->insert_Slider($_POST, $_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>thêm mới Slider</h2>
    <div class="block">        
        <?php
            if(isset($insertSlider)){
                echo $insertSlider;
            }
        ?>       
         <form action="slideradd.php" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Mô tả slider</label>
                    </td>
                    <td>
                        <input type="text" name="slidername" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ẩn || hiện slider</label>
                    </td>
                    <td>
                       <select name="type" id="">
                           <option value="1">Hiện </option>
                           <option value="0">Ẩn </option>
                           
                       </select>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>