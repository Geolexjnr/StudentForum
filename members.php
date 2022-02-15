<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
       
     
?>
 <title>Members</title>
 <?php
    echo "<h1 class='text-center'>Members"."</h1>";
    echo"<div class=' mx-auto card bg-light text-center d-flex justify-content-center' style='width: 35rem;'>";

    $check = mysqli_query($connect,"SELECT * FROM users");
    $rows = mysqli_num_rows($check);
    
    while($row = mysqli_fetch_assoc($check)){
        $id = $row['id'];
        echo "<ul class='list-group list-group'> <li class='list-group-item'><a class=' text-decoration-none text-dark' href= 'profile.php?id=$id'>".$row['username']."</a>"."<br>"."</li>"."</ul>";
    }

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
        echo "You must first log in to access this page";
    }

?>