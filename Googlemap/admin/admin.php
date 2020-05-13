<?php

function select_admin($option){
    global $db;
    $query = "SELECT * FROM makers ";
    $data = $db->query($query) or die('Loi truy van');
    return $data;
}
 
function add_admin($name,$address,$lat,$lng,$type){
  global $db;
  $sql = "INSERT INTO makers(id, name, address, lat, lng,type)
                            VALUES('','$name','$address','$lat','$lng','$type')";
  $db->exec($sql) or die('Loi truy van');
  echo 'Da them thanh cong';
}
 
function del_admin($id){
    global $db;
    $sql = "DELETE FROM admin WHERE id = '$id'";
    $db->exec($sql) or die('Loi truy van');
    echo 'Da xoa thanh cong.';
    header('Location:admin.php');
}
function edit_admin($email,$pass,$firstname,$lastname,$id){
    global $db;
    $query = "UPDATE admin SET emailAddress='$email',
        password = '$pass',firstName='$firstname',lastName = '$lastname' 
        WHERE id = '$id'";
    $db->exec($query) or die('Loi truy van');
    echo 'Da Sua thanh cong.';
    header('Location:admin.php');
}
?>