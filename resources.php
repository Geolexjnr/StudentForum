<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    date_default_timezone_set('Africa/Cairo');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
?>
 <title>Resources</title>
<body>

<?php 
                
                echo"<div class='d-flex justify-content-center'>";
                echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
                echo"<table class='table'>";

                
?>

<thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Uploaded By</th>
                    <th scope="col">Date</th>
                </tr>
 </thead>
 <?php   
     
     $check = mysqli_query($connect, "SELECT * FROM resources");
     
     if(mysqli_num_rows($check)!=0){
         while($row =  mysqli_fetch_assoc($check)){
             $id = $row['r_id'];
         echo"<tr>";
                 echo"<th scope ='row'>".$row['r_id']."</th>";
                 echo"<td><a class='text-decoration-none text-dark' href='".$row['resource']."'>".$row['resource_name']."</a></td>";
                 $check_user = mysqli_query($connect, "SELECT * FROM users WHERE username ='".$row['username']."'");
     
                 while($row_user = mysqli_fetch_assoc($check_user)){
                     $user_id = $row_user['id'];
                     
                 }
                 echo"<td><a class='text-decoration-none text-dark' href='profile.php?id=$user_id'>".$row['username']."</a></td>";
                 
                 $get_date = $row['date'];
                 echo"<td><a class ='text-decoration-none text-dark' href='resources.php?date=$get_date'>".$row['date']."</a></td>";
             
         echo "</tr>";
     
         
         }
     }else{
         echo "no resources found";
     }
     
             
     
     ?>
     
     <body>
       
     </body>

     
     
     <?php
         if($_GET['date']){
            $g_date = $_GET['date'];
            header("Location: resource_by_date.php?date=$g_date");

            
        
         }
         
         echo"</table>";
         echo"</div>";
         echo"</div>";

?>
<div class="d-flex justify-content-center">
    <a class="rounded-pill btn btn-outline-success mx-3" href="resources.php?action=res_upload">Upload a resource</a>
</div>
 
</body>

<?php
    if($_GET['action'] == "logout"){
        session_destroy();
        header("Location: login.php");
    }

    if($_GET['action']== "res_upload"){
        echo"<div class='d-flex justify-content-center'>";
            echo"<div class='text-center my-3' style='width: 35rem'>";
                echo"<form action = 'resources.php?action=res_upload' method='POST' enctype='multipart/form-data'>";

                    echo "<p>Upload files with the following file extentions: <b> .PNG .JPG .JPEG .PDF</b></p>";
                    
                    echo "<div class='mb-3'>";
                                echo"<input class='form-control' name='resource' type='file' multiple>
                                     <input type='text' class='form-control my-3' name='res_name' placeholder = 'Enter file name here!'>
                                     <input type='hidden' class='form-control' name='username' value ='".$_SESSION['username']."'>   
                                     <input type='hidden' class='form-control' name='date' value='".date('Y-m-d H:i:s')."'>
                                     ";
                     echo"</div>";
                                
                    echo"<button type='submit' class='rounded-pill btn btn-outline-primary' name='upload_resource'>Upload file</button><br/>";

                    if(isset($_POST['upload_resource'])){
                       $errors = array();
                       $allowed_ext = array('png', 'jpg', 'jpeg', 'pdf');

                       $file_name = $_FILES['resource']['name'];
                       $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                       $file_size = $_FILES['resource']['size'];
                       $file_tmp = $_FILES['resource']['tmp_name'];
                       
                       if(in_array($file_ext, $allowed_ext) == false){
                           $errors[] = "This file extension is not allowed.";
                       }

                       if(empty($_FILES['resource']['name'])){
                           $errors[] = "please select resources with allowed file extension";
                       }

                       if($file_size > 2097152){
                           $errors[] = ' File size must be lower than 2mb';
                       }

                       if(empty($errors)){
                           move_uploaded_file($file_tmp,'resources/'.$file_name);

                          $resource_upload = 'resources/'.$file_name;
                          $res_name = $_POST['res_name'];
                          $username = $_SESSION['username'];
                          $date = $_POST['date'];
                          /*if($query = mysqli_query($connect, "UPDATE users SET profile_pic='".$image_up."' WHERE username='".$_SESSION['username']."'")){
                              echo " Your profile picture has been updated";
                          }*/
                           if($query = mysqli_query($connect,"INSERT INTO resources (resource_name, resource, username, date)
                                                              VALUES('$res_name','$resource_upload','$username','$date')"));
                          
                          echo " file uploaded successfuly";
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

    
    }else{
        echo "You must first log in to access this page"."<br>";
        echo "<a href ='login.php'>Click here"."</a>";
    }

?>