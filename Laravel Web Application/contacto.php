<?php

    session_start();


    $db=mysqli_connect("localhost","root","","authentication") or die($db);

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

        $_SESSION['email']=$email;



        
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
            $_SESSION['order_id']=1;


            sendmail(
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
            $_SESSION['order_id']=1;


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


    function sendmail($email){
            // Create the email and send the message
            
            $to = $_SESSION['email']; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
            $email_subject = "Website Contact Form:";
            $email_body = "You have received a new message from your website contact form.";
            $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
            $headers .= "Reply-To: ";   
            mail($to,$email_subject,$email_body,$headers);
            
            echo "<script type='text/javascript'>alert('.$email.');</script>";
            
    }







?>















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="ibras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

    <div class="wrapper">
        <div style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ),url(hamburguesa7.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;">
    <div class="container1" >

        <header>
            <nav id="desktopnav">
                <img src="5.png">
                <a  href="./website.php">INCIO</a>
                    <a  href="./sobrenosotros.php">SOBRE NOSOTROS</a>
                    <a href="./Menu.php">MENU</a>
                    <a href="http://sxs7592.uta.cloud/">BLOG</a>
                    <a class="active" href="./contacto.php#">CONTACTO</a>
                <a href="#" onclick="openForm_registration()">REGISTRO</a>
                <a href="#" onclick="openForm_login()">INICIAR SESION</a>
                <a href="#" onclick="openForm_cart()"><?php  if(isset($_SESSION['cart'])){
echo $_SESSION['cart'];
}?></a>
                <a href="./logout.php"><?php  if(isset($_SESSION['logout'])){
echo $_SESSION['logout'];
}?></a>
                <a href="./dashboard.php"><?php  if(isset($_SESSION['username'])){
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
                    <a  href="./sobrenosotros.php">SOBRE NOSOTROS</a>
                    <a href="./Menu.php">MENU</a>
                    <a href="http://sxs7592.uta.cloud/">BLOG</a>
                    <a class="active" href="./contacto.php">CONTACTO</a>
                <a href="#" onclick="openForm_registration()">REGISTRO</a>
                <a href="#" onclick="openForm_login()">INICIAR SESION</a>
                <a href="./dashboard.php"><?php  if(isset($_SESSION['username'])){
echo "Welcome ".$_SESSION['username'];
}?></a>

             </div>
            
                
                </a>            
             </nav>
        </header>
    </div>
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////  register start

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


      ////////////////////////////////////////////////////////////////////////////////////// registration end


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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////  CART
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

                    */


    



    /*
    document.getElementById("page_redirect").onclick = function() {
        location.href = "./dashboard.php#";
        };
        */

        
</script>



//////////////////////////////////////////////////////////////////////////////////////////////////////////






















    <div class="container2" style="height: 35vh;">
        <p><font color="white">Di Hola</font></p>
        <h2><font color="white">Contacto</font></h2>
    </div>


    <div class="container2" style="height: 54vh; background-color: black;">
        <img class="bimage" src="Burguer.png">
        <h2><font color="white">Di Hola</font></h2>
        <h3><font color="white">Di Hola, envianos un mensaje</font></h3>
        <h4><font color="white">Envianos tus comentarios y suguerencias ustedes son importante para nosotros</font></h4>




        <div class="form" style="color: white; width: 100%; background-color: black; height: 45vh;">
            <input type="text" name="feedback_name" placeholder="Name" id="uname">
            <input type="email" placeholder="Email" id="email"><br>
            <input type="text" placeholder="Subject" id="subject"><br>
            <input type="text" placeholder="Message" id="msg"><br>
            <button type="button" style="margin-top: 2%;" name="feedback_submit" id="feedback_submit"  class="button" style="">VER MENU HOY</button>

        </div>









</div>


<script>

$(document).ready(function(){  
    $('#feedback_submit').click(function(){  
        var feedback_name = document.getElementById('uname').value;
        var feedback_email = document.getElementById('email').value;
        var feedback_subject = document.getElementById('subject').value;
        var feedback_message = document.getElementById('msg').value;
        

        alert(''+feedback_name+' '+feedback_email+' '+feedback_subject+' '+feedback_message);


        var username = "<?php echo $_SESSION['username']; ?>";
        var order_id = "<?php echo $_SESSION['order_id']; ?>";

        //$('#response').html('<p style="color:white;font-size:10px;">hi</p>');  
        




            $.ajax({
                url :"feedback_insertion.php",
                method:"POST",
                data: {username : username, feedback_name : feedback_name, feedback_email : feedback_email, feedback_subject : feedback_subject, feedback_message : feedback_message},
                beforeSend:function(){  $('#response_pollo_3').html('<span>Loading response...</span>');  },
                success:function(data){
                    //alert("Back bitch");

                    
                    alert('Worked');

                    
                    
                }
                
                


                })
            
        
        
        
        
        


    });  
}); 








</script>



























    <div class="container3" style="height: 68vh;">  
        <footer>
            <img id="cont_img" src="5.png">
            <p><font color="green"><u>Habla a:</u></font></p>
            <p><font color="white">Av. Intercomunal, sector la Mora, calle 8</font></p>
            <p><font color="green"><u>Telefono:</u></font></p>
            <p><font color="white">+58 251 261 00 01</font></p>
            <p><font color="green"><u>Correo:</u></font></p>
            <p><font color="white">yourmail@gmail.com</font></p>

            <table style="width:10%" align="center">
                <thead class=".adjust_margin">
                <tr>
                    <th width="5px" >
                        <img class="one" src="pinterest_small_icon.png" alt="pinterest" width="50" height="50">
                    </th>
                    <th width="5px">
                        <img class="one" src="facebook_small_icon.png" alt="facebook" width="50" height="50">
                    </th>
                    <th width="5px">
                        <img class="one" src="twitter_small_icon.png" alt="twitter" width="50" height="50">
                    </th>
                    <th width="5px">
                        <img class="one" src="linkedin_small_icon.png" alt="linkedin" width="50" height="50">
                    </th>
                    
                </tr>

            </thead>
                

            </table>

            <p><font color="white">Copyright @ 2020 Todos los derechos reservados | Este sitio esta hecho con por DiazApps</font></p>


        </footer>

    </div>



</div>

    
</body>
</html>