<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    date_default_timezone_set('Africa/Cairo');

    

    echo"<div class='d-flex justify-content-center'>";
    echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
    echo"<table class='table'>";
?>
<?php       
        
    if($_GET['date']){
            echo"
            <thead class='bg-dark text-white'>
            <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Title</th>
                    <th scope='col'>Uploaded By</th>
                    <th scope='col'>Date</th>
            </tr>
        </thead>
            ";
    }
?>
<?php



             $check_date = mysqli_query($connect, "SELECT * FROM resources WHERE date ='".$_GET['date']."'");
             echo"<div class='d-flex justify-content-center'>";
                 //echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
                 
             while($row_date = mysqli_fetch_assoc($check_date)){
                
                 echo"<tr>";
                 echo"<th scope ='row'>".$row_date['r_id']."</th>";
                 echo"<td><a class='text-decoration-none text-dark' href='resources.php?id=$id'>".$row_date['resource_name']."</a></td>";
                 $check_user = mysqli_query($connect, "SELECT * FROM users WHERE username ='".$row_date['username']."'");
     
                 while($row_user = mysqli_fetch_assoc($check_user)){
                     $user_id = $row_user['id'];
                     
                 }
                 echo"<td><a class='text-decoration-none text-dark' href='profile.php?id=$user_id'>".$row_date['username']."</a></td>";
                 $get_date = $row_date['date'];
                 echo"<td><a class ='text-decoration-none text-dark' href='resources.php?date=$get_date'>".$row_date['date']."</a></td>";
             
         echo "</tr>";
     
             }
     
                 //echo "</div>";
            echo "</div>";


?>