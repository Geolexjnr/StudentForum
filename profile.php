<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
?>
 <title>Profile</title>
 <?php
    
    echo"<div class=' my-4 mx-auto card bg-light text-center text-light d-flex justify-content-center' style='width: 35rem;'>";

    if($_GET['id']){
       
        $check = mysqli_query($connect,"SELECT * FROM users WHERE id='".$_GET['id']."'");
        $rows = mysqli_num_rows($check);

        if(mysqli_num_rows($check) !=0){
         while($row = mysqli_fetch_assoc($check)){
            echo "<h1 class ='text-dark'>".$row['username']."</h1><img src='".$row['profile_pic']."' width='100rem' height='100rem' class='mx-auto'>";
            echo "<h5 class ='text-dark my-2'>Date registered: ".$row['date']."</h5><br/>";
            echo "<h5 class ='text-dark'>Email: " .$row['email']."</h5><br/>";
            echo "<h5 class ='text-dark'>Program of study: " .$row['course']."</h5><br/>";
            echo "<h5 class ='text-dark'>Replies: " .$row['replies']."</h5><br/>";
            echo "<h5 class ='text-dark'>Topics Created: " .$row['topics']."</h5><br>";
         }
          
        }else{
            echo "<p class='text-danger'>ID not found!".'"</p>"';
        }
    }else{
        header("Location:index.php");
    }

    echo"</div>";
    echo "<div class='col text-center my-lg-4'>";
    echo "<a href='index.php' class='btn btn-primary'>Back</a>";
    echo"</div>";
 ?>
<body>
  
</body>

<?php
    if($_GET['action'] == "logout"){
        session_destroy();
        header("Location: login.php");
    }

    }else{
        echo "You must first log in to access this page"."<br>";
        echo "<a href ='login.php'>Click here"."</a>";
    }

?>