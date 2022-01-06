<!-- 
<?php
  
  include '../lib/database.php';
  include '../helpers/format.php';
  


?>
<?php 
  class product 
  {
      private $db;
      private $fm;
      public function __construct()
      {
          $this->db = new Database();
          $this->fm = new Format();
      }
      //thêm danh mục 
      public function insert_product($data,$files){
         
          

          $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
          $category = mysqli_real_escape_string($this->db->link,$data['category']);
          $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
          $price = mysqli_real_escape_string($this->db->link,$data['price']);
          $type = mysqli_real_escape_string($this->db->link,$data['type']);
          //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
          $permited = array('jpg' , 'jpeg', 'png', 'gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.',$file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;
          

          if(empty($productName="" || $category="" || $product_desc="" || $price="" || $type="" || $file_name="" )) {
              $alert = '<span style="color:red;">Các trường không được bỏ trống !</span>';
              return $alert;
          }
          else{
              $query = "INSERT INTO tbl_product(catName) VALUE('') ";
              $result = $this->db->insert($query);
              if ($result) {
                  $alert = "<span style='color:blue;'>Thêm danh mục sản phẩm thành công!!</span>";
                  return $alert;
              }else {
                  $alert = "<span style='color:red;'>Thêm danh mục sản phẩm thất bại!!</span>";
                  return $alert;
              }
          }
      }
    //   //hiển thị danh mục
    //   public function show_category(){
    //       $query = "SELECT * FROM tbl_category order by catid desc";
    //       $result = $this->db->select($query);
    //       return $result;
    //   }
    //   public function getcatbyId($id){
    //       $query = "SELECT * FROM tbl_category WHERE catid = '$id'";
    //       $result = $this->db->select($query);
    //       return $result;
    //   }
    //   //sửa danh mục 
    //   public function update_category($catName,$id){
    //       $catName = $this->fm->validation($catName);
    //       $catName = mysqli_real_escape_string($this->db->link,$catName);
    //       $id = mysqli_real_escape_string($this->db->link,$id);
          

    //       if(empty($catName)) {
    //           $alert = '<span style="color:red;">Danh mục không được bỏ trống !</span>';
    //           return $alert;
    //       }
    //       else{
    //           $query = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$id'";
    //           $result = $this->db->update($query);
    //           if ($result) {
    //               $alert = "<span style='color:blue;'>Sửa danh mục sản phẩm thành công!!</span>";
    //               return $alert;
    //           }else {
    //               $alert = "<span style='color:red;'>Sửa danh mục sản phẩm thất bại!!</span>";
    //               return $alert;
    //           }
    //       }
    //   }
    //   //xóa danh mục 
    //   public function del_category($id){
    //       $query = "DELETE FROM tbl_category WHERE catid = '$id'";
    //       $result = $this->db->delete($query);
    //       if($result){
    //           $alert = "<span style='color:blue;'>Xóa danh mục sản phẩm thành công!!</span>";
    //               return $alert;
    //       }else{
    //           $alert = "<span style='color:blue;'>Xóa danh mục sản phẩm thành công!!</span>";
    //               return $alert;
    //       }
          
    //   }
      
  }
  
?> -->