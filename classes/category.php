
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    //thêm danh mục 
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $alert = '<span style="color:red;">Danh mục không được bỏ trống !</span>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUE('$catName') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Thêm danh mục sản phẩm thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Thêm danh mục sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }
    //hiển thị danh mục
    public function show_category()
    {
        $query = "SELECT * FROM tbl_category order by catid desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //sửa danh mục 
    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);


        if (empty($catName)) {
            $alert = '<span style="color:red;">Danh mục không được bỏ trống !</span>';
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Sửa danh mục sản phẩm thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Sửa danh mục sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }
    //xóa danh mục 
    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE catid = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:blue;'>Xóa danh mục sản phẩm thành công!!</span>";
            return $alert;
        } else {
            $alert = "<span style='color:blue;'>Xóa danh mục sản phẩm thành công!!</span>";
            return $alert;
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    //thêm thương hiệu
    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);


        $brandName = mysqli_real_escape_string($this->db->link, $brandName);


        if (empty($brandName)) {
            $alert = '<span style="color:red;">Thương hiệu không được bỏ trống !</span>';
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUE('$brandName') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Thêm thương hiệu sản phẩm thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Thêm danh mục sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }
    //hiển thị  thương hiệu
    public function show_brand()
    {
        $query = "SELECT * FROM tbl_brand order by brand_id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getbrandbyId($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //sửa thương hiệu
    public function update_brand($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);


        if (empty($brandName)) {
            $alert = '<span style="color:red;">Thương hiệu không được bỏ trống !</span>';
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brand_id = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Sửa thương hiệu thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Sửa thương hiệu thất bại!!</span>";
                return $alert;
            }
        }
    }
    //xóa thương hiệu
    public function del_brand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:blue;'>Xóa thương hiệu sản phẩm thành công!!</span>";
            return $alert;
        } else {
            $alert = "<span style='color:blue;'>Xóa thương hiệu sản phẩm thành công!!</span>";
            return $alert;
        }
    }
    //////////////////////////////////////////////////////////////////////////////
    //Thêm sản phẩm 
    public function insert_product($data, $files)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (in_array($file_ext, $permited) === false) {
            // echo "<span>You can upload only:-" . implode(' , ', $permited) . "</span>";
            $alert = "<span style='color:red;'>Bạn chỉ có thể update hình ảnh có đuôi là : " . implode(' , ', $permited) . "</span>";
            return $alert;
        }
        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span style='color:red;'>Các trường không được bỏ trống !</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catid,brand_id,product_desc,type1,price,hinhanh) VALUE('$productName','$category','$brand','$product_desc','$type','$price','$unique_image') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Thêm sản phẩm thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Thêm sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }

    //hiển thị danh sách sản phẩm
    public function show_product()
    {
        $query = "SELECT tbl_product.* , tbl_category.catName, tbl_brand.brandName 

          FROM tbl_product INNER JOIN tbl_category ON tbl_product.catid = tbl_category.catid
          INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
           order by tbl_product.productid desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //sửa sản phẩm
    public function update_product($data, $files, $id)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        // $file_current = strtolower(current($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
            $alert = "<span style='color:red;'>Các trường không được bỏ trống !</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //nếu người dùng chọn ảnh 
                // if ($file_size <20480) {
                //     $alert = "<span style='color:red;'>kích thước hình ảnh nên nhỏ hơn 20MB!</span>";
                //     return $alert;
                // } else
                if (in_array($file_ext, $permited) === false) {
                    // echo "<span>You can upload only:-" . implode(' , ', $permited) . "</span>";
                    $alert = "<span style='color:red;'>Bạn chỉ có thể update hình ảnh có đuôi là : " . implode(' , ', $permited) . "</span>";
                    return $alert;
                }
                $query = "UPDATE tbl_product SET 
                productName = '$productName' ,
                catid = '$category' ,
                brand_id = '$brand' ,
                product_desc = '$product_desc' ,
                type1 = '$type' ,
                price = '$price' ,
                hinhanh = '$unique_image' 
                
                WHERE productid = '$id'";
            } else {
                //Nếu người dùng chọn ảnh 
                $query = "UPDATE tbl_product SET 
                productName = '$productName' ,
                catid = '$category' ,
                brand_id = '$brand' ,
                product_desc = '$product_desc' ,
                type1 = '$type' ,
                price = '$price' 
               
                WHERE productid = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Sửa sản phẩm thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Sửa sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }
    //xóa sản phẩm 
    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productid = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:blue;'>Xóa sản phẩm thành công!!</span>";
            return $alert;
        } else {
            $alert = "<span style='color:blue;'>Xóa sản phẩm thành công!!</span>";
            return $alert;
        }
    }
    //thêm ảnh vào trong slider ở trong trang slideradd.php
    public function insert_Slider($data, $files){
        $slidername = mysqli_real_escape_string($this->db->link, $data['slidername']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
       
        //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($slidername == "" || $type == "") {
            $alert = "<span style='color:red;'>Các trường không được bỏ trống !</span>";
            return $alert;
        } else 
        {
            if (!empty($file_name)) {
                if (in_array($file_ext, $permited) === false) {
                    $alert = "<span style='color:red;'>Bạn chỉ có thể update hình ảnh có đuôi là : " . implode(' , ', $permited) . "</span>";
                    return $alert;
                }
                
            } 
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_slider(slider_Name,type,slider_hinhanh) VALUES('$slidername','$type','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) 
            {
                $alert = "<span style='color:blue;'>Sửa sản phẩm thành công!!</span>";
                return $alert;
            } 
            else
            {
                $alert = "<span style='color:red;'>Sửa sản phẩm thất bại!!</span>";
                return $alert;
            }
        }
    }
    //hiển thị slider lên trang user index.php
    public function show_slider(){
        $query = "SELECT * FROM tbl_slider WHERE type = '1' order by slider_id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slider_list(){
        $query = "SELECT * FROM tbl_slider order by slider_id desc";
        $result = $this->db->select($query);
        return $result;
    }
    //xóa slider trong admin
    public function del_slider($id){
        $query = "DELETE FROM tbl_slider where slider_id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Slider Deleted Successfully</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Slider Deleted Not Success</span>";
				return $alert;
			}
    }
    //update chức năng ẩn hiện slider 
    public function update_type_slider($id,$type){
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET type = '$type' where slider_id='$id'";
        $result = $this->db->update($query);
        return $result;
    }
    //hiển thị đơn hàng của khách hàng đặt
    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date_order DESC ";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    //Xủ lý đơn đơn hàng trong inbox.php
    public function shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET 
        status = '1' 
        
        WHERE id = '$id' AND date_order='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color: #228B22;'>Đơn hàng đã được xử lý thành công </span>";
            return $msg;
        } else {
            $msg = "<span style='color:red;'>Đơn hàng đã được xử lý không thành công </span>";
            return $msg;
        }
    }

    //
    public function shifted_confirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET 
        status = '2' 
        
        WHERE customer_id = '$id' AND date_order='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color: #228B22;'>Đơn hàng đã được xử lý thành công </span>";
            return $msg;
        } else {
            $msg = "<span style='color:red;'>Đơn hàng đã được xử lý không thành công </span>";
            return $msg;
        }
    }

    //Xóa đơn hàng sao khi xử lý thành công trong inbox.php
    public function del_shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order 
    
        
        WHERE id = '$id' AND date_order='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color: #228B22;'>Đơn hàng đã được xóa thành công </span>";
            return $msg;
        } else {
            $msg = "<span style='color:red;'>Đơn hàng đã được xóa không thành công </span>";
            return $msg;
        }
    }
    //End BACKEND 
    //NGười dùng User
    //ẩn hoặc hiện sản phẩm
    public function getproduct_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type1 = '0'";
        $result = $this->db->select($query);
        return $result;
    }
    //hiển thị số sản phẩm mới nhất
    public function getproduct_new()
    {
        $sp_tungtrang =20;
        if(!isset($_GET['trang'])){
            $trang =1;
        }else{
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang -1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product order by productid desc LIMIT $tung_trang, $sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }

    //phân trang 
    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product ";
        $result = $this->db->select($query);
        return $result;
    }

    //lấy chi tiết sản phẩm
    public function get_details($id)
    {
        $query = "SELECT tbl_product.* , tbl_category.catName, tbl_brand.brandName 

          FROM tbl_product INNER JOIN tbl_category ON tbl_product.catid = tbl_category.catid
          INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id WHERE tbl_product.productid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //Thêm sản phẩm vào giỏ hàng 
    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sid = session_id();

        $query = "SELECT * FROM tbl_product WHERE productid = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $hinhanh = $result['hinhanh'];
        $price = $result['price'];
        $productName = $result['productName'];
        //kiểm tra sản phẩm trùng lặp
        $check_cart = "SELECT * FROM tbl_cart WHERE productid = '$id' AND sid = '$sid'";
        // if($check_cart){
        //     $msg = "Sản phẩm này đã được thêm vào giỏ hàng";
        //     return $msg;
        // }else {
        $query_insert = "INSERT INTO tbl_cart(productid,sid,productName,price,quantity,hinhanh) VALUE('$id','$sid','$productName','$price','$quantity','$hinhanh') ";
        $insert_cart = $this->db->insert($query_insert);
        if ($result) {
            header('Location:cart.php');
        } else {
            header('Location:404.php');
        }
        // }
    }

    // Đặt mua sản phẩm 
    public function get_product_cart()
    {
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    //cập nhật giỏ hàng
    public function update_quantity_cart($quantity, $cartid)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);

        $query = "UPDATE tbl_cart SET 
        quantity = '$quantity'
    
        WHERE cartid = '$cartid'";

        $result = $this->db->update($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = "<span style='color:red'>Giỏ hàng của bạn đã cập nhật không thành công</span>";
            return $msg;
        }
    }
    //hàm xóa giỏ hàng
    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart 
        WHERE cartid = '$cartid'";

        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = "<span style='color:red'>Sản phẩm vẫn chưa được xóa thành công</span>";
            return $msg;
        }
    }

    //check cart hiển thị cart khi khách hàng đăng nhập vào 
    public function check_cart()
    {
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    //check order hiển thị đơn hàng của khách khi khách hàng đăng nhập vào 
    public function check_order($customer_id)
    {

        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    //hiển thị thương hiệu trong slider
    public function getlasttestDell()
    {
        $query = "SELECT * FROM tbl_product WHERE brand_id='7' order by productid desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getlasttestSamsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brand_id='8' order by productid desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getlasttestIphone()
    {
        $query = "SELECT * FROM tbl_product WHERE brand_id='4' order by productid desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getlasttestOppo()
    {
        $query = "SELECT * FROM tbl_product WHERE brand_id='3' order by productid desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }

    //hiển thị danh mục ngoài trang chủ
    public function show_category_fontend()
    {
        $query = "SELECT * FROM tbl_category order by catid desc";
        $result = $this->db->select($query);
        return $result;
    }

    //hiển thị danh sách sản phẩm trong productbyid
    public function get_product_by_cat($id)
    {
        $query = "SELECT * FROM tbl_product WHERE catid ='$id' order by catid desc LIMIT 8 ";
        $result = $this->db->select(($query));
        return $result;
    }

    //hiển tên danh mục trong productbyid
    public function get_name_by_cat($id)
    {
        $query = "SELECT tbl_product.* ,tbl_category.catName, tbl_category.catid FROM tbl_product,tbl_category WHERE tbl_product.catid = tbl_category.catid AND tbl_product.catid = '$id' LIMIT 1";
        $result = $this->db->select(($query));
        return $result;
    }

    //Đăng ký tài khoản người dùng
    public function insert_customers($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
            $alert = "<span style='color:red;'>Các trường không được bỏ trống !</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span style='color:red'>email này đã có người đăng ký , bạn vui lòng đăng ký email khác cảm ơn... </span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer (name,address,city,country,zipcode,phone,email,password) VALUE('$name','$address','$city','$country','$zipcode','$phone','$email' ,'$password') ";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='color:blue;'>Tạo tài khoản thành công!!</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color:red;'>Tạo tài khoản thất bại!!</span>";
                    return $alert;
                }
            }
        }
    }

    //đăng nhập user
    public function login_customers($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == "" || $password == "") {
            $alert = "<span style='color:red;'>email hoặc mật khẩu không được bỏ trống !</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
            $result_check = $this->db->select($check_login);
            if ($result_check != false) {
                $values = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $values['id']);
                Session::set('customer_login', $values['name']);
                header('Location:order.php');
            } else {
                $alert = "<span style='color:red'>email hoặc mật khẩu của bạn không đúng , vui lòng nhập lại </span>";
                return $alert;
            }
        }
    }

    //xử lý xóa tất cả các session ở giỏ hàng khi đăng xuất
    public function del_all_data_cart()
    {
        $sid = session_id();
        $query = "DELETE FROM tbl_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    //hiện thông tin cá nhân của user lên profile
    public function show_customer($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //update thông tin user trên editprofile
    public function update_customer($data, $id)
    {

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);

        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);


        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" ||  $phone == "") {
            $alert = "<span style='color:red;'>Các trường không được bỏ trống !</span>";
            return $alert;
        } else {


            $query = "UPDATE tbl_customer SET name='$name', city='$city', zipcode='$zipcode', email='$email', address='$address', phone='$phone' WHERE id='$id'";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:blue;'>Thông tin cá nhân của bạn đã được sửa thành công!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Thông tin cá nhân của bạn đã được sửa thất bại!!</span>";
                return $alert;
            }
        }
    }

    //Đặt hàng và insert giỏ hàng vào CSDL
    public function insertOrder($customer_id)
    {
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productid'];
                $productName = $result['productName'];

                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $hinhanh = $result['hinhanh'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order (productid,productName,customer_id,quantity,price,hinhanh) VALUE('$productid','$productName','$customer_id','$quantity','$price','$hinhanh') ";
                $insert_order = $this->db->insert($query_order);
                // if ($insert_order) {
                //     $alert = "<span style='color:blue;'>Tạo tài khoản thành công!!</span>";
                //     return $alert;
                // } else {
                //     $alert = "<span style='color:red;'>Tạo tài khoản thất bại!!</span>";
                //     return $alert;
                // }
            }
        }
    }

    public function getAmountPrice($customer_id)
    {

        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    //hiển thị giỏ hàng khi khách hàng đã đặt hàng ở trang orderdetails.php
    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    //update sản phẩm so sánh vào CSDL  trong details.php 
    public function insertCompare($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span style='color:red;'>Sản phẩm đã có trong danh sách so sánh</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$hinhanh = $result["hinhanh"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,hinhanh,customer_id,productName) VALUES('$productid','$price','$hinhanh','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span  style='color:blue;'>Đã thêm sản phẩm thành công vào danh sách so sánh</span>";
						return $alert;
					}else{
						$alert = "<span style='color:red;'>So sáng sản phẩm thành công</span>";
						return $alert;
					}
			}

    }
    //Thực hiện chức năng so sánh sản phẩm
    public function get_Compare($customer_id){
        $query = "SELECT * FROM tbl_compare WHERE customer_Id = '$customer_id' order by compare_id desc ";
        $result = $this->db->select($query);
        return $result;
    }
    //xóa tất cả các sản phẩm so sánh khi người dùng đăng xuất
    public function del_all_delCompare($customer_id){
        $sid = session_id();
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    //thêm sản phẩm vào danh sách yêu thích trong trang details.php
    public function insertWishlist($productid, $customer_id){
        $productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span style='color:red;'>Sản phẩm đã có danh sách yêu thích của bạn</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$hinhanh = $result["hinhanh"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productid,price,hinhanh,customer_id,productName) VALUES('$productid','$price','$hinhanh','$customer_id','$productName')";
			$insertwlist = $this->db->insert($query_insert);

			if($insertwlist){
						$alert = "<span  style='color:blue;'>Đã thêm sản phẩm thành công vào danh sách yêu thích</span>";
						return $alert;
					}else{
						$alert = "<span style='color:red;'>Thêm vào danh sách yêu thích không thành công</span>";
						return $alert;
					}
			}
    }

    //hiển thị sản phẩm yêu thích của khách hàng lên trang wishlist.php
    public function get_wishlist($customer_id){
        $query = "SELECT * FROM tbl_wishlist WHERE customer_Id = '$customer_id' order by wishlist_id desc ";
        $result = $this->db->select($query);
        return $result;
    }

    //thực hiện chức năng xóa sản phẩm yêu thích của khách hàng ở trang wishlist.php
    public function del_wlist($proid,$customer_id){
        $query = "DELETE FROM tbl_wishlist WHERE productid = '$proid' AND customer_id='$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    //chức năng tiềm kiếm sản phẩm theo tên
    public function search_product($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
    
}

?>