<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
?>
 <title>Home</title>
<?php
echo"<div class='d-flex justify-content-center'>";
    echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
    echo"<a  href='posts.php' class='rounded-pill btn btn-outline-primary my-3' style='margin-left: 40rem;'>Post</a>";
    echo"<table class='table'>";
        
?>
          
    
             <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Views</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>

<?php   
     
$check = mysqli_query($connect, "SELECT * FROM topics");

if(mysqli_num_rows($check)!=0){
    while($row =  mysqli_fetch_assoc($check)){
        $id = $row['topic_id'];
    echo"<tr>";
            echo"<th scope ='row'>".$row['topic_id']."</th>";
            echo"<td><a class='text-decoration-none text-dark' href='topic.php?id=$id'>".$row['topic_title']."</a></td>";
            $check_user = mysqli_query($connect, "SELECT * FROM users WHERE username ='".$row['topic_creator']."'");

            while($row_user = mysqli_fetch_assoc($check_user)){
                $user_id = $row_user['id'];
                
            }
            echo"<td><a class='text-decoration-none text-dark' href='profile.php?id=$user_id'>".$row['topic_creator']."</a></td>";
            echo"<td>".$row['views']."</td>";
            $get_date = $row['date'];
            echo"<td><a class ='text-decoration-none text-dark' href='index.php?date=$get_date'>".$row['date']."</a></td>";
        
    echo "</tr>";

    
    }
}else{
    echo "no topics found";
}

        

?>

<body>
  
</body>

<?php
    if(@$_GET['date']){
        $check_date = mysqli_query($connect, "SELECT * FROM topics WHERE date ='".$_GET['date']."'");
        echo"<div class='d-flex justify-content-center'>";
            //echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
       
        while($row_date = mysqli_fetch_assoc($check_date)){
           
            echo"<tr>";
            echo"<th scope ='row'>".$row_date['topic_id']."</th>";
            echo"<td><a class='text-decoration-none text-dark' href='topic.php?id=$id'>".$row_date['topic_title']."</a></td>";
            $check_user = mysqli_query($connect, "SELECT * FROM users WHERE username ='".$row_date['topic_creator']."'");

            while($row_user = mysqli_fetch_assoc($check_user)){
                $user_id = $row_user['id'];
                
            }
            echo"<td><a class='text-decoration-none text-dark' href='profile.php?id=$user_id'>".$row_date['topic_creator']."</a></td>";
            echo"<td>".$row_date['views']."</td>";
            $get_date = $row_date['date'];
            echo"<td><a class ='text-decoration-none text-dark' href='index.php?date=$get_date'>".$row_date['date']."</a></td>";
        
    echo "</tr>";

        }

            //echo "</div>";
       echo "</div>";
   
    }
    
    echo"</table>";
    echo"</div>";
    echo"</div>";

    


    if($_GET['action'] == "logout"){
        session_destroy();
        header("Location: login.php");
    }

    }else{
        echo "You must first log in to access this page"."<br>";
        echo "<a href ='login.php'>Click here"."</a>";
    }

?>