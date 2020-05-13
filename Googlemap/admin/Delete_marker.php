<?php
require('config.php');
$connection = mysqli_connect ($server, $username, $password, $database);
if (!$connection) 
{
  die('Not connected : ' . mysqli_error());
}
//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi

$id = $_GET['id'];


    //Code xử lý, insert dữ liệu vào table
    $sql = "delete from markers where id='$id'";

    if (mysqli_query($connection, $sql)) {
        header("location:../admin/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

//Đóng database
$connection->close();
?>