<?php  
    session_start();

 //insert.php  
 $db=mysqli_connect("localhost","hxm9103_root","harrishPassword@123","hxm9103_authentication") or die($db);

    $username = mysqli_real_escape_string($db, $_POST['username']);

      $feedback_name = mysqli_real_escape_string($db, $_POST['feedback_name']);
      $feedback_email = mysqli_real_escape_string($db, $_POST['feedback_email']);
      $feedback_subject = mysqli_real_escape_string($db, $_POST['feedback_subject']);
      $feedback_message = mysqli_real_escape_string($db, $_POST['feedback_message']);
      $email_checker="@";



      if(strpos($feedback_email, $email_checker) !== false){
          $query = "INSERT INTO feedback(username,name,email,subject,message) VALUES ('$username','$feedback_name','$feedback_email','$feedback_subject','$feedback_message')";  
          if(mysqli_query($db,$query))  
          {   
               
            echo "<script> alert('Feedback Sent!');window.location='/ibra/contacto.php'</script>";
              } 

            }
        else{
            echo "<script> alert('Email format wrong!');window.location='/ibra/contacto.php'</script>";

        }
        echo "<script> alert(' wrong!');window.location='/ibra/contacto.php'</script>";





 
 ?> 