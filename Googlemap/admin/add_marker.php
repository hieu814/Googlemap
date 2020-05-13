<?php
require('config.php');
$connection = mysqli_connect ($server, $username, $password, $database);
if (!$connection) 
{
  die('Not connected : ' . mysqli_error());
}
//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi

$name = $_POST['name'];
$adress = $_POST['address'];
$lat = $_POST['lat']; 
$lng = $_POST['lng'];
$type = $_POST['type'];

    //Code xử lý, insert dữ liệu vào table
    $sql = "INSERT INTO markers(id, name, address, lat, lng,type)
    VALUES('','$name','$adress','$lat','$lng','$type')";

    if (mysqli_query($connection, $sql)) {
        header("location:../admin/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

//Đóng database
$connection->close();
?>