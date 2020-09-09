<?php  
    session_start();

 //insert.php  
 $db=mysqli_connect("localhost","hxm9103_root","harrishPassword@123","hxm9103_authentication") or die($db);


      $username = mysqli_real_escape_string($db, $_POST['u_name']);
      $order_id = mysqli_real_escape_string($db, $_POST['order_id']);  
  
      $item_count = mysqli_real_escape_string($db, $_POST['u_input']);  
      $item_name =  mysqli_real_escape_string($db, $_POST['item_name']); 
      $item_price =  mysqli_real_escape_string($db, $_POST['item_price']); 
      $item_total_cost =  mysqli_real_escape_string($db, $_POST['item_total_cost']);

      $check_availability = "SELECT * FROM menu WHERE menu_item_name = '".$item_name."'";
      //$check_availability = "SELECT * FROM menu WHERE menu_item_name = 'mixta'";

      $check_availability_result=mysqli_query($db,$check_availability);
      $row = mysqli_fetch_array($check_availability_result);
      if($row['available'] == "yes"){


          $query = "INSERT INTO cart(order_id,username,item_name,item_price,item_quantity,item_total_cost) VALUES ('$order_id','$username','$item_name','$item_price','$item_count','$item_total_cost')";  
          if(mysqli_query($db,$query))  
          {   
               
               echo '<span><font color="white">'.$item_count.' Items Added</font></span';  
             
      } 
     }

     else{
          echo '<script type="text/javascript">alert("' . $row['available'] . '")</script>';

          echo "<script> alert('Item is currently unavailable!');window.location='/ibra/Menu.php'</script>";

     }
 
 ?> 