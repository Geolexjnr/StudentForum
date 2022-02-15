<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
?>
 <title>My Account</title>
<body>

<?php 
                
                $check = mysqli_query($connect, "SELECT * FROM users Where username ='".$_SESSION['username']."'");

                $rows = mysqli_num_rows($check);

                while($rows = mysqli_fetch_assoc($check)){
                    $username = $rows['username'];
                    $email = $rows['email'];
                    $course = $rows['course'];
                    $date = $rows['date'];
                    $replies = $rows['replies'];
                    $topics = $rows['topics'];
                    $profile_pic = $rows['profile_pic'];
                }
?>

<div class="d-flex justify-content-center">
    <ul class="list-group list-group-flush mx-5 my-3" style="width: 35rem;">
    <div class="text-center">
        <?php echo"<img src='".$profile_pic."' width='120rem' height='120rem' class='mx-auto my-3 rounded'>"?>
    </div>
    <li class="list-group-item rounded"><b>Username</b>: <?php echo $username?></li>
    <li class="list-group-item rounded"><b>Email:</b> <?php echo $email ?> </li>
    <li class="list-group-item rounded"><b>Course of Study:</b> <?php echo $course ?> </li>
    <li class="list-group-item rounded"><b>Date of Registration:</b> <?php echo $date ?> </li>
    <li class="list-group-item rounded"><b>Replies:</b> <?php echo $replies ?> </li>
    <li class="list-group-item rounded"><b>Topics:</b> <?php echo $topics ?> </li>
    </ul>
</div>

<div class="d-flex justify-content-center">
    <a class="rounded-pill btn btn-outline-success" href="account.php?action=cp">Change Password</a>
    <a class="rounded-pill btn btn-outline-success mx-3" href="account.php?action=ci">Update Profile Picture</a>
</div>
 
</body>

<?php
    if($_GET['action'] == "logout"){
        session_destroy();
        header("Location: login.php");
    }

    if($_GET['action']== "ci"){
        echo"<div class='d-flex justify-content-center'>";
            echo"<div class='text-center my-3' style='width: 35rem'>";
                echo"<form action = 'account.php?action=ci' method='POST' enctype='multipart/form-data'>";

                    echo "<p>Upload pictures with the following file extentions: <b> .PNG .JPG .JPEG</b></p>";
                    
                    echo "<div class='mb-3'>";
                                echo"<input class='form-control' name='image' type='file' multiple>";
                    echo"</div>";
                                
                    echo"<button type='submit' class='rounded-pill btn btn-outline-primary' name='change_pic'>Update Profile Picture</button><br/>";

                    if(isset($_POST['change_pic'])){
                       $errors = array();
                       $allowed_ext = array('png', 'jpg', 'jpeg');

                       $file_name = $_FILES['image']['name'];
                       $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                       $file_size = $_FILES['image']['size'];
                       $file_tmp = $_FILES['image']['tmp_name'];
                       
                       if(in_array($file_ext, $allowed_ext) == false){
                           $errors[] = "This file extension is not allowed.";
                       }

                       if(empty($_FILES['image']['name'])){
                           $errors[] = "please select image file";
                       }

                       if($file_size > 2097152){
                           $errors[] = ' File size must be lower than 2mb';
                       }

                       if(empty($errors)){
                           move_uploaded_file($file_tmp,'profile_pics/'.$file_name);

                          $image_up = 'profile_pics/'.$file_name;

                          if($query = mysqli_query($connect, "UPDATE users SET profile_pic='".$image_up."' WHERE username='".$_SESSION['username']."'")){
                              echo " Your profile picture has been updated";
                          }

                       }else{
                           foreach($errors as $error){
                               echo $error, '<br/>';
                           }
                       }
                    }



                echo"</form";
            echo "</div>";
        echo "</div>";
    }

    if($_GET['action']=="cp"){
        echo"<div class='d-flex justify-content-center'>";
            echo"<div class='text-center my-3' style='width: 35rem'>";
                echo"<form action='account.php?action=cp' method='POST'>";
            
                    echo "<div class='mb-3'>";
                        echo "<input type='password' class='form-control' name='cur_pass' placeholder='Enter Current Password'>";
                    echo "</div>";

                    echo "<div class='mb-3'>";
                        echo "<input type='password' class='form-control' 
                        name='new_pass' placeholder='Enter New Password'>";
                    echo "</div>";

                    echo "<div class='mb-3'>";
                        echo"<input type='password' class='form-control' 
                        name='re_pass'placeholder='Re-Enter New Password'>";
                    echo"</div>";
                    
                    echo"<button type='submit' class='rounded-pill btn btn-outline-primary' name='change_pass'>Change</button>";
                
                echo"</form>";
            

        $cur_pass = $_POST['cur_pass'];
        $new_pass = $_POST['new_pass'];
        $re_pass = $_POST['re_pass'];
        if(isset($_POST['change_pass'])){
                $check = mysqli_query($connect, "SELECT * FROM users Where username ='".$_SESSION['username']."'");

                $rows = mysqli_num_rows($check);

                while($rows = mysqli_fetch_assoc($check)){
                    echo $get_pass = $row['password'];
                }

                if(sha1($cur_pass == $get_pass)){
                    if(strlen($new_pass)>6){
                        if($re_pass == $new_pass){
                            if($query = mysqli_query($connect, "UPDATE users SET password='".sha1($new_pass)."' WHERE username ='".$_SESSION['username']."'")){
                                echo "Password changed";
                            }
                        }else{
                            echo "New password does not match";
                        }
                    }else{
                        echo "New password must be longer than 6 characters!";
                    }
                }else{
                    echo "Your current password does not match with your real password!";
                }
        }
        echo"</div>";
        echo"</div>";
    }

    }else{
        echo "You must first log in to access this page"."<br>";
        echo "<a href ='login.php'>Click here"."</a>";
    }

?>