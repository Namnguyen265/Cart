<?php
// include "connect.php";
session_start();
// echo $_POST['id'];
// echo "</br>";
 
if ($_POST['up'] == 1)
{


 foreach ($_SESSION['cart'] as $key => $value)
 {
    if ($value['id'] == $_POST['id'])
    {
        // echo $value['id'];
        $_SESSION['cart'][$key]['qty'] += 1;
        
    } 
    
 }
}

if ($_POST['up'] == 2)
{

 foreach ($_SESSION['cart'] as $key => $value)
 {
    if ($value['id'] == $_POST['id'])
    {
        // echo $value['id'];
        $_SESSION['cart'][$key]['qty'] -= 1;

        if ($_SESSION['cart'][$key]['qty'] == 0)
        {
            unset($_SESSION['cart'][$key]); 
        }
        
    } 
    
    
 }
}

if ($_POST['up'] == 3)
{
    foreach($_SESSION['cart'] as $key => $value)
    {
        if ($value['id'] == $_POST['id'])
        {
            unset($_SESSION['cart'][$key]);
        }
    }
}


$tong = 0;
foreach ($_SESSION['cart'] as $key => $value)
 {
    $tong = $tong + $value['qty'];
    
 }
echo $tong;

$_SESSION['TongSP'] = $tong;
//  echo '</pre>';
 
// var_dump($_SESSION['cart']);

// session_destroy();


// foreach ($_SESSION['cart'] as $key => $value)
//  {
//     echo "</pre>";
    // var_dump($key, $value);
    
//  }
// echo $tong;

?>