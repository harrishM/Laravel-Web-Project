<?php  
    session_start();

 //insert.php  
 $db=mysqli_connect("localhost","hxm9103_root","harrishPassword@123","hxm9103_authentication") or die($db);


      $username = mysqli_real_escape_string($db, $_POST['u_name']);  
      $total = 0;

      echo "
      <table width=80%; border=1; cellpadding=3; cellspacing=3;>
      <tr>
        
        <td>Item Name</td>
        <td>Quantity</td>
        <td>Total Price</td>
      </tr>
      ";


      $query = "SELECT * FROM cart WHERE username = '".$username."'";
      $result = mysqli_query($db,$query);
      if($result)  
      {   
           while($row = mysqli_fetch_array($result))
           {
               echo "
               <tr>
                    
                    <td> $row[item_name] </td>
                    <td> $row[item_quantity]</td>
                    <td> $row[item_total_cost] </td>
                </tr>
               
               ";
               
           }
             
      } 
      echo "
      <tr>
        <td></td>
        <td> Total</td>
        <td>$total</td>
      </tr>
      "; 

      echo "</table>";
 
 ?> 