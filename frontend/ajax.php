<?php
    
    include 'connect.php';
    session_start();
    // session_destroy();
    // echo $_POST['id'];
    // echo $_POST['count'];
    // echo $_POST['up'];
    $sql = "SELECT * from product where id = '".$_POST['id']."' ";
    $result = $con->query($sql);

    $data = [];
    if ($result-> num_rows > 0)
    {
      
        $data=  $result -> fetch_assoc();
       
    }
   
    
    

    

    $flag = true;
    if(!empty($_SESSION['cart'])){
        $all= $_SESSION['cart'];

        foreach($all as $key => $result)
        {
            if ($result['id'] == $_POST['id'] && $_POST['up'] == 1)
            {
                $_SESSION['cart'][$key]['qty'] += 1;
                $flag = false;
            }

            if ($result['id'] == $_POST['id'] && $_POST['up'] == 2)
            {
                
                $_SESSION['cart'][$key]['qty'] -= 1;
                $flag = false;
                if ($_SESSION['cart'][$key]['qty'] == 0)
                {
                    unset($_SESSION['cart'][$key]);
                }
            }

            if ($result['id'] == $_POST['id'] && $_POST['up']==3)
            {
                unset($_SESSION['cart'][$key]);
                $flag = false;
            }
        }
    }

    

    if ($flag)
    {
        
        
            $all = [];
            $all['price'] = $data['price'];
            $all['title'] = $data['title'];
            $all['id'] = $data['id'];
            $all['image'] = $data['image'];
            $all['qty'] = 1;
            $_SESSION['cart'][] = $all;
        
    }

    // session_destroy();
?>
<?php
        

    $tongsp = 0;
foreach ($_SESSION['cart'] as $key => $value)
 {
    $tongsp = $tongsp + $value['qty'];
    
 }

 $_SESSION['TongSP'] = $tongsp;
//  echo 
echo $_SESSION['TongSP'];

// var_dump($_SESSION);

// session_destroy();
// var_dump($_SESSION);
// echo $_SESSION['TongSP'];
?>