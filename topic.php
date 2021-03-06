<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');
    include('comments.inc.php');

    date_default_timezone_set('Africa/Cairo');

    if($_SESSION["username"]){
        if($_GET['id']){
            $check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");
            
            if(mysqli_num_rows($check)){
                while ($row = mysqli_fetch_assoc($check)) {
                  
                    $title= $row['topic_title'];
                }
            }else{
                echo "No topic found";
            }

        }
?>
 <title><?php echo $title; ?></title>
<?php
echo"<div class='d-flex justify-content-center'>";
    echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
    echo"<a  href='posts.php' class='rounded-pill btn btn-outline-primary my-3' style='margin-left: 40rem;'>Post</a>";
    echo"</div>";
echo"</div>";
?>
<?php
echo"<div class='d-flex justify-content-center'>";
//echo"<div class='text-center my-3' style='width: 80rem; display:flex; flex-wrap:wrap'>";
        if($_GET['id']){
            $check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");
            
            if(mysqli_num_rows($check)){
                while ($row = mysqli_fetch_assoc($check)) {
                   $check_user = mysqli_query($connect,"SELECT * FROM users Where username = '".$row['topic_creator']."'");
                   while($row_user = mysqli_fetch_assoc($check_user)){
                       $user_id = $row_user['id'];
                   }
                   echo"<div class='grid'>";
                   echo"<div class='text-center'>";
                   echo "<h1>".$row['topic_title']."</h1>";
                   echo "<p><b>By: <a href='profile.php?id=$user_id'>".$row['topic_creator']."</b></a></p>";
                   echo "<p>".$row['date']."</p>";
                   echo "</div>";
                   echo"<div class='my-3' style='width: 50rem; display:flex; flex-wrap:wrap'>";
                   echo "<p>".$row['topic_content']."</p>";
                   echo "</div>";
                   echo "</div>";
                }
            }else{
                echo "No topic found";
            }

        }

echo "</div>";



echo "
<div class='d-flex justify-content-center'>
     <div class='text-center my-3' style='width: 35rem; display:flex; flex-wrap:wrap'>
        <form action='".setComments($connect)."' method='POST'>
                
            <input type='hidden' class='form-control' name='c_author' value ='".$_SESSION['username']."'>
            <input type='hidden' class='form-control' name='date' value='".date('Y-m-d H:i:s')."'>

        <div class='mb-3'>
            <textarea class='form-control' style='width: 35rem; height: 5rem; resize: none;'
            name='message' placeholder='Comment here'></textarea>
        </div>
        
        <button name='commentSubmit' type='submit' class='rounded-pill btn btn-outline-primary text-left' name='post_topic'>Comment</button>

        </form>

        
    </div>
</div>
";

    getComments($connect); 
          
?>
<body>
  
</body>
<?php
  echo "<div class='col text-center my-lg-4'>";
  echo "<a href='index.php' class=' my-5 rounded-pill btn btn-outline-primary'>Back</a>";
 echo"</div>";  

?>
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