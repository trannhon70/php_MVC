<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$pd = new category();

if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {

    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $id = $_GET['productid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $pd->update_product($_POST, $_FILES, $id);
}
?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>
            <?php
            $get_product_by_id = $pd->getproductbyId($id);
            if ($get_product_by_id) {
                while ($result_product = $get_product_by_id->fetch_assoc()) {


            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Tên sản phẩm</label>
                                </td>
                                <td>
                                    <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Danh mục</label>
                                </td>
                                <td>
                                    <select id="select" style="text-align: center;" name="category">
                                        <!-- <option>----------danh mục----------</option> -->
                                        <?php
                                        //$cat = new category();
                                        $catlist = $pd->show_category();
                                        if ($catlist) {
                                            while ($result = $catlist->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result['catid'] == $result_product['catid']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['catid'] ?>"><?php echo $result['catName'] ?></option>
                                        <?php     }
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Thương hiệu</label>
                                </td>
                                <td>
                                    <select id="select" style="text-align: center;" name="brand">
                                        <!-- <option>----------thương hiệu----------</option> -->
                                        <?php

                                        //$brand = new category();
                                        $brandlist = $pd->show_brand();
                                        if ($brandlist) {
                                            while ($result = $brandlist->fetch_assoc()) {


                                        ?>
                                                <option <?php
                                                        if ($result['brand_id'] == $result_product['brand_id']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['brand_id'] ?>"><?php echo $result['brandName'] ?></option>
                                        <?php     }
                                        } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Mô tả</label>
                                </td>
                                <td>
                                    <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Giá</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?php echo $result_product['price'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Hình ảnh </label>
                                </td>
                                <td>
                                    <img src="uploads/<?php echo $result_product['hinhanh'] ?>" width="90"><br>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Tình trạng</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <!-- <option>Tình trạng sản phẩm</option> -->
                                        <?php
                                        if ($result_product['type1'] == 1) {


                                        ?>
                                            <option selected value="1">Nổi bật</option>
                                            <option value="0">Không nổi bật</option>
                                        <?php } else { ?>
                                            <option selected value="1">Nổi bật</option>
                                            <option selected value="0">Không nổi bật</option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Lưu sản phẩm" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>