<?php
include "connect.php";
$msg = "";
$id = $_GET['id'];
// $id = $_SESSION['id'];
// echo $id;
$sql = "DELETE  from product where id = $id ";

if ($result = $con-> query($sql))
{
    echo $msg = "<h1>Xóa san pham thành công Click vào <a href='myproduct1.php'>đây</a> để về trang danh sách</h1>";
    // header('location: myproduct.php');
}
else
{
    echo "Dã co loi xay ra";
}

?>