
<?php
  
  include '../lib/database.php';
  include '../helpers/format.php';

?>
<?php 
  class brand 
  {
      private $db;
      private $fm;
      public function __construct()
      {
          $this->db = new Database();
          $this->fm = new Format();
      }
      //thêm danh mục 
      public function insert_brand($brandName){
          $brandName = $this->fm->validation($brandName);
          

          $brandName = mysqli_real_escape_string($this->db->link,$brandName);
          

          if(empty($brandName)) {
              $alert = '<span style="color:red;">Thương hiệu không được bỏ trống !</span>';
              return $alert;
          }
          else{
              $query = "INSERT INTO tbl_brand(brandName) VALUE('$brandName') ";
              $result = $this->db->insert($query);
              if ($result) {
                  $alert = "<span style='color:blue;'>Thêm thương hiệu sản phẩm thành công!!</span>";
                  return $alert;
              }else {
                  $alert = "<span style='color:red;'>Thêm danh mục sản phẩm thất bại!!</span>";
                  return $alert;
              }
          }
      }
      //hiển thị danh mục
      public function show_brand(){
          $query = "SELECT * FROM tbl_brand order by brand_id desc";
          $result = $this->db->select($query);
          return $result;
      }
      public function getcatbyId($id){
          $query = "SELECT * FROM tbl_brand WHERE brand_id = '$id'";
          $result = $this->db->select($query);
          return $result;
      }
      //sửa danh mục 
      public function update_brand($brandName,$id){
          $brandName = $this->fm->validation($brandName);
          $brandName = mysqli_real_escape_string($this->db->link,$brandName);
          $id = mysqli_real_escape_string($this->db->link,$id);
          

          if(empty($brandName)) {
              $alert = '<span style="color:red;">Thương hiệu không được bỏ trống !</span>';
              return $alert;
          }
          else{
              $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brand_id = '$id'";
              $result = $this->db->update($query);
              if ($result) {
                  $alert = "<span style='color:blue;'>Sửa thương hiệu thành công!!</span>";
                  return $alert;
              }else {
                  $alert = "<span style='color:red;'>Sửa thương hiệu thất bại!!</span>";
                  return $alert;
              }
          }
      }
      //xóa danh mục 
      public function del_brand($id){
          $query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
          $result = $this->db->delete($query);
          if($result){
              $alert = "<span style='color:blue;'>Xóa thương hiệu sản phẩm thành công!!</span>";
                  return $alert;
          }else{
              $alert = "<span style='color:blue;'>Xóa thương hiệu sản phẩm thành công!!</span>";
                  return $alert;
          }
          
      }
      
      
  }
  
?>