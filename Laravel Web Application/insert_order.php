<?php  
    session_start();

 //insert.php  
 $db=mysqli_connect("localhost","hxm9103_root","harrishPassword@123","hxm9103_authentication") or die($db);


      

      $query = "SELECT * FROM cart WHERE order_id = '".$_SESSION['order_id']."' AND username = '".$_SESSION['username']."'";
      $result = mysqli_query($db,$query);
      if($result)  
      {   
        $_SESSION['order_id']++;

           while($row = mysqli_fetch_array($result))
           {
            $insert_to_order_table = "INSERT INTO orders(order_id,username,item_name,item_price,item_quantity,item_total_cost) VALUES ('$row[order_id]','$row[username]','$row[item_name]','$row[item_price]','$row[item_quantity]','$row[item_total_cost]')";
            if(mysqli_query($db,$insert_to_order_table))
            {
                $delete_from_cart_table = "DELETE FROM cart WHERE username = '".$_SESSION['username']."'";
                if(mysqli_query($db,$delete_from_cart_table)){
                header("location: /ibra/order_confirmation.php");
                }

            }
           }
             
      } 

 
 ?> 