<?php

    session_start();


    $db=mysqli_connect("localhost","hxm9103_root","harrishPassword@123","hxm9103_authentication") or die($db);

    if(isset($_POST['register_button'])){
        session_start();
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $confirm_password = mysqli_real_escape_string($db,$_POST['confirm_password']);
        $address = mysqli_real_escape_string($db,$_POST['address']);
        $type_of_user = mysqli_real_escape_string($db,$_POST['type_of_user']);
        $email_check="@admincontrol.com";
        $_SESSION['order_id']=1;



        
        if($type_of_user == "admin"){
            if(strpos($email, $email_check) !== false){
        if($password == $confirm_password){
            $password = md5($password);
            $sql = "INSERT INTO users(username,email,password,address,type_of_user) VALUES ('$username','$email','$password','$address','$type_of_user')";
            $sql_check = "SELECT username FROM users";
            $sql_check = "SELECT * FROM users WHERE username='$username'";
            $result_check=mysqli_query($db,$sql_check);
            if(!mysqli_num_rows($result_check)==1){


            mysqli_query($db,$sql);
            session_unset();
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            $_SESSION['welcome']="Welcome " . $username;
            $_SESSION['success']="success";
            $_SESSION['cart'] = "cart";
            $_SESSION['logout'] = "logout";

            header("location: /ibra/registration_confirmation.php");
            

            }
            else{
                echo "<script> alert('Username is already in use.');window.location='/ibra/contacto.php'</script>";


            }
        }else{
            $_SESSION['failure']="failue";
            $_SESSION['message']="The passwords don't match";
            echo "<script> alert('Passwords dont match.');window.location='/ibra/contacto.php'</script>";

        }
    }
    else{
        echo "<script> alert('You are not authorized to register as an administrator');window.location='/ibra/contacto.php'</script>";

    }
    }
    else if($type_of_user == "customer"){
        if($password == $confirm_password){
            $password = md5($password);
            $sql = "INSERT INTO users(username,email,password,address,type_of_user) VALUES ('$username','$email','$password','$address','$type_of_user')";
            $sql_check = "SELECT username FROM users";
            $sql_check = "SELECT * FROM users WHERE username='$username'";
            $result_check=mysqli_query($db,$sql_check);
            if(!mysqli_num_rows($result_check)==1){


            mysqli_query($db,$sql);
            session_unset();
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            $_SESSION['welcome']="Welcome " . $username;
            $_SESSION['success']="success";
            $_SESSION['cart'] = "cart";
            $_SESSION['logout'] = "logout";

            header("location: /ibra/registration_confirmation.php");
            

            }
            else{
                echo "<script> alert('Username is already in use.');window.location='/ibra/contacto.php'</script>";


            }
        }else{
            $_SESSION['failure']="failue";
            $_SESSION['message']="The passwords don't match";
            echo "<script> alert('Incorrect username or password');window.location='/ibra/contacto.php'</script>";

        }


    }




    }


    if(isset($_POST['login_button'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);

        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db,$sql);

        if(mysqli_num_rows($result)==1){
            
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            $_SESSION['welcome']="Welcome " . $username;
            $_SESSION['order_id']=1;


            $_SESSION['success']="success";
            $_SESSION['cart'] = "cart";
            $_SESSION['logout'] = "logout";


            
            header("location: /ibra/login_confirmation.php");
        }else{
            $_SESSION['failure']="failue";
            $_SESSION['message'] = "Username/password might be wrong";

            echo "<script> alert('Login Failed!');window.location='/ibra/contacto.php'</script>";

        }


    }






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="ibras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>


<body style="background-color: #eeee;">

    <img style="height: 80px;" src="5.png">
    <h2 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; float: right; margin-right: 3%;">
        <span style="color: #ff0000"><?php  if(isset($_SESSION['username'])){
echo "Welcome ".$_SESSION['username'];
}?></span></h2>
        <div class="container1">
       
       <header >
           <nav style="height: 80px; padding-top: 40px;" id="desktopnav">
               <a  href="./website.php">INCIO</a>
               <a  href="./sobrenosotros.php">SOBRE NOSOTROS</a>
               <a href="./Menu.php">MENU</a>
               <a href="http://sxs7592.uta.cloud/">BLOG</a>
               <a href="./contacto.php#">CONTACTO</a>
               <a href="#" onclick="openForm_registration()">REGISTRO</a>
               <a href="#" onclick="openForm_login()">INICIAR SESION</a>
               <a href="./logout.php"><?php  if(isset($_SESSION['logout'])){
echo $_SESSION['logout'];
}?></a>
               <a href="#" onclick="openForm_cart()"><?php  if(isset($_SESSION['cart'])){
echo $_SESSION['cart'];
}?></a>

                <a href="#" onclick="openForm_menu_manage()"><?php  if(isset($_SESSION['username'])){
                          $query = "SELECT type_of_user FROM users WHERE username = '".$_SESSION['username']."'";
                          $result = mysqli_query($db,$query);
                          $row = mysqli_fetch_array($result);
                          if($row['type_of_user'] == "admin"){
echo "Manage Menu";
                          }
}?></a>

<a href="#" onclick="openForm_feedback()"><?php  if(isset($_SESSION['username'])){
                          $query = "SELECT type_of_user FROM users WHERE username = '".$_SESSION['username']."'";
                          $result = mysqli_query($db,$query);
                          $row = mysqli_fetch_array($result);
                          if($row['type_of_user'] == "admin"){
echo "View Feedback";
                          }
}?></a>

                <a class="active" href="./dashboard.php"><?php  if(isset($_SESSION['username'])){
                          $query = "SELECT type_of_user FROM users WHERE username = '".$_SESSION['username']."'";
                          $result = mysqli_query($db,$query);
                          $row = mysqli_fetch_array($result);
echo "Welcome ".$_SESSION['username']."(".$row['type_of_user'].")";
}?></a>






           </nav>

           <nav id="mobilenav">
               <a href="javascript:void(0);" style="float: left; padding-top: 5%;" class="icon" onclick="shownav()">
                   <i class="fa fa-bars"></i>
            <div id="navlinks">
            <a  href="./website.php">INCIO</a>
               <a class="active" href="./sobrenosotros.php">SOBRE NOSOTROS</a>
               <a href="./Menu.php">MENU</a>
               <a href="http://sxs7592.uta.cloud/">BLOG</a>
               <a href="./contacto.php#">CONTACTO</a>
               <a href="#" onclick="openForm_registration()">REGISTRO</a>
               <a href="#" onclick="openForm_login()">INICIAR SESION</a>
            </div>
           
               
               </a>            
            </nav>
       </header>
</div>

    <div class="c-banner-buttons" style="margin-top: 5%;margin-left: 10%;">

        <div class="dashboard">
            <a class="c-button" href="#" onclick="openForm_myOrders()" >My Orders</a>
        </div>

        <div class="dashboard">
            <a class="c-button" href="#">Account Details</a>
        </div>

        <div class="dashboard">
            <a class="c-button" href="#">Offers</a>
        </div>

        <div class="dashboard">
            <a class="c-button" href="#">Contact Us</a>
        </div>

    </div>


    <div class="login-popup">
    <div class="form-popup" id="popupForm_registration">
        <form action="/ibra/contacto.php" class="form-container" method="post"> 

            <img onclick="closeForm_registration()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

            <img class="bimage" src="Burguer.png">
            <p style="font-family: mountain;float: right;">Registro de Usuario</p>
            
            
            
            <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;">Nombre y apellido:
            <input type="text"   name="username" class="textInput" placeholder="username" required></p>
            

            <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;">Correo:
            <input type="text"  name="email" class="textInput" placeholder="Email" required></p>
            

            
            <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;">Contrasena:
            <input type="password" name="password" class="textInput" placeholder="Password"  required></p>
            

        
            <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;">Repetir Contrasena:
            <input type="password" name="confirm_password" class="textInput"  placeholder="Confirm Password"  required></p>
            

            
            <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;" >Direccion:
            <input type="text" name="address" class="textInput" style="line-height: 60px;"  placeholder="Address"  required></p>
            

            <select id="type_of_user" name="type_of_user" style="text-align: left; margin-top: 5px; margin-bottom: 5px;">
            <option>select type of user</option>
            <option>customer</option>
            <option>admin</option>
            
            </select>
            


            <button type="submit" name="register_button" id="register_button_id"  class="btn cancel" >Register</button>

            
            <input type="button" class="btn cancel" onclick="closeForm_registration()" value="Close">
            
        </form>
    </div>
</div>

<script>
    function openForm_registration() {
        document.getElementById("popupForm_login").style.display = "none";
        document.getElementById("popupForm_cart").style.display = "none";
        document.getElementById("popupForm_registration").style.display = "block";
    }
    
    function closeForm_registration() {
    document.getElementById("popupForm_registration").style.display="none";
    }

    



                

                

                





</script>






<div class="login-popup">
    <div class="form-popup1 modal-content animate form-container" id="popupForm_login">
        <form action="/ibra/contacto.php" method="post">
        <img onclick="closeForm_login()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

        <img style="float: left; margin-top: -20px;" class="bimage" src="Burguer.png">
        <h3 style="font-family: mountain;float: right;margin-top: -20px;">Iniciar Sesion</h3>
  
        
        <p style="text-align: left; margin-top: 45px; margin-bottom: 5px;">Usuario:
        <input type="text"   name="username" class="textInput" placeholder="username" required>
        </p>

        
        



        
        <p style="text-align: left; margin-top: 5px; margin-bottom: 5px;">Contrasena:
        <input type="password" name="password" class="textInput" placeholder="Password"  required>
        </p>

        
       

        
      
        
         <input type="submit" name="login_button" class="btn cancel" style="float: right;" value="Entrar">

      </form>
    </div>
  </div>




  <script>
    function openForm_login() {
        document.getElementById("popupForm_registration").style.display = "none";
            document.getElementById("popupForm_login").style.display = "block";
    }

    function closeForm_login() {
        document.getElementById("popupForm_login").style.display = "none";
    }
    /*
    document.getElementById("page_redirect").onclick = function() {
        location.href = "./dashboard.php#";
        };
        */
</script>







<div class="login-popup">
    <div class="form-popup1 modal-content animate form-container" id="popupForm_cart">
        <form method="post">
        <img onclick="closeForm_cart()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

        <img style="float: left; margin-top: -20px;" class="bimage" src="Burguer.png">
        <h3 style="font-family: mountain;float: centre;margin-top: -20px;"><?php echo $_SESSION['username']."'s "?>Cart</h3>
  
        <div id="response_cart"></div>



        
       

        
      
        
        <button type="button" name="submit_cart" id="submit_cart"  class="btn cancel" >Refresh</button>
        <button type="button" name="submit_order_cart" id="submit_order_cart"  class="btn cancel" >Confirm Order</button>



      </form>
    </div>
  </div>




  <script>
  
    function openForm_cart() {
        document.getElementById("popupForm_registration").style.display ="none";
            document.getElementById("popupForm_login").style.display = "none";
            document.getElementById("popupForm_cart").style.display = "block";

    }
    

    function closeForm_cart() {
        document.getElementById("popupForm_cart").style.display = "none";
    }

    $(document).ready(function(){  
                        $('#submit_cart').click(function(){  
                            console.log("going in this");
                            var username = "<?php echo $_SESSION['username']; ?>";


                                
                            
                                $.ajax({
                                    url :"insert_cart_table.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_cart').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_cart').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 
                    $(document).ready(function(){  
                        $('#submit_order_cart').click(function(){  
                            console.log("going in this");
                            var username = "<?php echo $_SESSION['username']; ?>";


                                
                            
                                $.ajax({
                                    url :"insert_order.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_cart').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_cart').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 



                    /*
                    $(document).ready(function(){  
                        $('#register_button_id').click(function(){  
                            console.log("going in this");
                            var userinput = parseFloat(prompt("Enter the your order size:"));
                            var username = "";


                                
                            
                                $.ajax({
                                    url :"insert_cart_table.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_cart').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_cart').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 

                    */


    



    /*
    document.getElementById("page_redirect").onclick = function() {
        location.href = "./dashboard.php#";
        };
        */

        
</script>








<div class="login-popup">
    <div class="form-popup1 modal-content animate form-container" id="popupForm_myOrders">
        <form method="post">
        <img onclick="closeForm_myOrders()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

        <img style="float: left; margin-top: -20px;" class="bimage" src="Burguer.png">
        <h3 style="font-family: mountain;float: centre;margin-top: -20px;"><?php echo $_SESSION['username']."'s "?>Orders</h3>
  
        <div id="response_myOrders"></div>



        
       

        
      
        
        <button type="button" name="submit_myOrders" id="submit_myOrders"  class="btn cancel" >Refresh</button>


      </form>
    </div>
  </div>




  <script>
  
    function openForm_myOrders() {
        document.getElementById("popupForm_registration").style.display ="none";
            document.getElementById("popupForm_login").style.display = "none";
            document.getElementById("popupForm_cart").style.display = "none";
            document.getElementById("popupForm_myOrders").style.display = "block";


    }
    

    function closeForm_myOrders() {
        document.getElementById("popupForm_myOrders").style.display = "none";
    }
    

    $(document).ready(function(){  
                        $('#submit_myOrders').click(function(){  
                            console.log("going in this");
                            var username = "<?php echo $_SESSION['username']; ?>";


                                
                            
                                $.ajax({
                                    url :"insert_order_table.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_myOrders').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_myOrders').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 

                    




        
</script>











<div class="login-popup">
    <div class="form-popup1 modal-content animate form-container" id="popupForm_menu_manage">
        <form method="post">
        <img onclick="closeForm_menu_manage()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

        <img style="float: left; margin-top: -20px;" class="bimage" src="Burguer.png">
        <h3 style="font-family: mountain;float: centre;margin-top: -20px;">Manage Menu</h3>

        <table width=80%; border=1; cellpadding=3; cellspacing=3;>
      <tr>
        <td>Item Name</td>
        <td>Available</td>
      </tr>
      <tr>
        <td>Mixta</td>
        <td><select id="mixta_option_selection" name="mixta_option_selection" style="text-align: left; margin-top: 5px; margin-bottom: 5px;">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select></td>
      </tr>
      <tr>
        <td>Pollo</td>
        <td><select id="pollo_option_selection" name="pollo_option_selection" style="text-align: left; margin-top: 5px; margin-bottom: 5px;">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select></td>
      </tr>
      <tr>
        <td>Carne</td>
        <td><select id="carne_option_selection" name="carne_option_selection" style="text-align: left; margin-top: 5px; margin-bottom: 5px;">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select></td>
      </tr>
      <tr>
        <td>De todito</td>
        <td><select id="detodito_option_selection" name="detodito_option_selection" style="text-align: left; margin-top: 5px; margin-bottom: 5px;">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select></td>
      </tr>
      </table>
  
        <div id="response_menu_manage"></div>



        
       

        
      
        
        <button type="button" name="submit_menu_manage" id="submit_menu_manage"  class="btn cancel" >Reflect Changes</button>


      </form>
    </div>
  </div>




  <script>
  
    function openForm_menu_manage() {
        document.getElementById("popupForm_registration").style.display ="none";
            document.getElementById("popupForm_login").style.display = "none";
            document.getElementById("popupForm_cart").style.display = "none";
            document.getElementById("popupForm_myOrders").style.display = "none";
            document.getElementById("popupForm_menu_manage").style.display = "block";



    }
    

    function closeForm_menu_manage() {
        document.getElementById("popupForm_menu_manage").style.display = "none";
    }
    

    $(document).ready(function(){  
                        $('#submit_menu_manage').click(function(){  
                            console.log("going in this");
                            var mixta_availability = $("#mixta_option_selection option:selected").text();
                            var pollo_availability = $("#pollo_option_selection option:selected").text();
                            var carne_availability = $("#carne_option_selection option:selected").text();
                            var detodito_availability = $("#detodito_option_selection option:selected").text();

                            alert(''+mixta_availability+' '+pollo_availability+' '+carne_availability+' '+detodito_availability);





                                
                            
                                $.ajax({
                                    url :"menu_manage.php",
                                    method:"POST",
                                    data: {mixta_availability : mixta_availability, pollo_availability : pollo_availability, carne_availability : carne_availability, detodito_availability : detodito_availability },
                                    beforeSend:function(){  $('#response_menu_manage').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_menu_manage').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 

                    




        
</script>














<div class="login-popup">
    <div class="form-popup1 modal-content animate form-container" id="popupForm_feedback">
        <form method="post">
        <img onclick="closeForm_feedback()" src="close_small_icon.jpeg" height="32" width="32" style="margin-left: 325px; margin-top: 1px;">

        <img style="float: left; margin-top: -20px;" class="bimage" src="Burguer.png">
        <h3 style="font-family: mountain;float: centre;margin-top: -20px;">Manage Menu</h3>

  
        <div id="response_feedback"></div>



        
       

        
      
        
        <button type="button" name="submit_feedback" id="submit_feedback"  class="btn cancel" >View Feedback</button>
        <button type="button" name="submit_feedback_remove" id="submit_feedback_remove"  class="btn cancel" >Done Viewing</button>



      </form>
    </div>
  </div>




  <script>
  
    function openForm_feedback() {
        document.getElementById("popupForm_registration").style.display ="none";
            document.getElementById("popupForm_login").style.display = "none";
            document.getElementById("popupForm_cart").style.display = "none";
            document.getElementById("popupForm_myOrders").style.display = "none";
            document.getElementById("popupForm_menu_manage").style.display = "none";
            document.getElementById("popupForm_feedback").style.display = "block";




    }
    

    function closeForm_feedback() {
        document.getElementById("popupForm_feedback").style.display = "none";
    }
    

    $(document).ready(function(){  
                        $('#submit_feedback').click(function(){  
                            console.log("going in this");
                            var username = "<?php echo $_SESSION['username']; ?>";


                                
                            
                                $.ajax({
                                    url :"view_feedback.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_feedback').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                        
                                        $('form').trigger("reset");
                                        $('#response_feedback').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 




                    $(document).ready(function(){  
                        $('#submit_feedback_remove').click(function(){  
                            console.log("going in this");
                            var username = "<?php echo $_SESSION['username']; ?>";


                                
                            
                                $.ajax({
                                    url :"remove_feedback.php",
                                    method:"POST",
                                    data: {u_name : username},
                                    beforeSend:function(){  $('#response_feedback').html('<span>Loading response...</span>');  },
                                    success:function(data){
                                        //alert("Back bitch");

                                                                                
                                        $('form').trigger("reset");
                                        $('#response_feedback').fadeIn().html(data);
                                        
                                        
                                    }
                                    
                                    


                                    })

                                    
                                
                            
                            
                            
                            
                            


                        });  
                    }); 





        
</script>




































    <div style="margin-top: 5%; margin-left: 4%;" class="example">
        <h2 style="color: white; margin-left: 8%; padding: 2%;">Search us in your neighborhood?</h2>
        <script async src="https://cse.google.com/cse.js?cx=000888210889775888983:pqb3ch1ewhg"></script>

        <div class="gcse-searchbox-only"
            data-resultsUrl="https://googlecustomsearch.appspot.com/elementv2/two-page_results_elements_v2.html?query=test">
        </div>
    </div>

    <div class="app-space">
        <div style="float: left; background-color: white; height: 50vh; width:35%; margin-left: 5%; margin-top: 2%;">
            <img style="height: 40vh;float: left; background-color: #eeee;" src="mobile.png">
            <img style="height: 40vh;margin-left: -50%; background-color: #eeee;" src="mobile1.png">
            

        </div>

        <div
            style="float: right; background-color: white; height: 50vh; width: 45%; margin-right: 5%; margin-top: 2%;">
            <h3 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-align: left;margin-left: 2%;">
                Get the Ibra's App</h3>
            <p style="color: #89959B; font-size: small;text-align: left; margin-left: 2%;">Download our app today and
                share it with your friends to get
                exciting offers</p>
            <p style="font-size: small;text-align: left; margin-left: 2%;">We'll send you a link, open it on your phone
                to download the app</p>

            <div style="text-align: center;">
                <input style="margin-top: 2%;" class="offerinput" type="text" name="" id=""
                    placeholder="Enter your phone number">
                <button class="btn">Send Text</button>
                <div style="margin-top: 2%; margin-bottom: 2%;" class="separator">OR</div>
                <input style="margin-left: 5px;" class="offerinput" type="text" name="" id=""
                    placeholder="Enter your email">
                <button class="btn">Send Email</button>
            </div>
            <a class="pr20" target="_blank" href="#">
                <img style="margin-top: 5%; margin-left: 10%;" src="https://b.zmtcdn.com/images/mobile/applestore@2x.png?output-format=webp" alt="Download Zomato for iOS" height="40">
              </a>
            
            <a target="_blank" href="#">
                <img src="https://b.zmtcdn.com/images/mobile/googleplay@2x.png?output-format=webp"
                    alt="Download Zomato for Android" height="40">
            </a>
        </div>

    </div>

    

</body>

</html>