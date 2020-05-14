<?php
include_once 'header.php';
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Thêm điểm</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php
require('config.php');
$connection = mysqli_connect ('', $username, $password, $database);
if (!$connection) 
{
  die('Not connected : ' . mysqli_error());
}
//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi

$id = $_GET['id'];


    //Code xử lý, insert dữ liệu vào table
    $sql = "SELECT * FROM markers WHERE id='$id'";
    $result = mysqli_query($connection,$sql);
    $row=mysqli_fetch_array($result);
   

  

//Đóng database
$connection->close();
?>
 <form action="Update_marker.php"  method="post">
    <table>
    <tr>
            
            <td><input type="hidden" name="id" value="<?php echo $row["id"];?>"></td>
        </tr>
        <tr>
            <th>Tên:</th>
            <td><input type="text" name="name" value="<?php echo $row["name"];?>"></td>
        </tr>

        <tr>
            <th>Địa chỉ:</th>
            <td><input type="text" name="address" value="<?php echo $row["address"];?>"></td>
        </tr>

        <tr>
            <th>lat:</th>
            <td><input type="hidden" name="lat" value="<?php echo $row["lat"];?>"></td>
        </tr>
        <tr>
            <th>lng:</th>
            <td><input type="hidden" name="lng" value="<?php echo $row["lng"];?>"></td>
        </tr>
        <tr>
            <th>type:</th>
            <td><input type="text" name="type" value="<?php echo $row["type"];?>"></td>
        </tr>
        <tr>
            <th>image link:</th>
            <td><input type="text" name="image" value="<?php echo $row["image"];?>"></td>
        </tr>
        <tr>
            <th>type:</th>
            <td><input type="text" name="description" value="<?php echo $row["description"];?>"></td>
        </tr>

    </table>
    <button type="submit">Gửi</button>
</form>      
<?php
include_once 'ft.php';
?>       
