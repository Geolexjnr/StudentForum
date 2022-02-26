<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>

</head>
<body>
<?php

session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');
    include('comments.inc.php');

    
    $cid = $_POST['cid'];
    $c_author = $_POST['c_author'];
    $date = $_POST['date'];
    $message =  mysqli_real_escape_string($connect, $_POST['message']);
    $topic_id = $_POST['topic_id']; 

if($_GET['id']){
    $check = mysqli_query($connect, "SELECT * FROM comments WHERE topic_id='".$_GET['id']."'");

                    if(mysqli_num_rows($check)!=0){
                        while($row =  mysqli_fetch_assoc($check)){
                            $get_id = $row['topic_id'];
                        }
                    }
}
echo "
<div class='d-flex justify-content-center'>
     <div class='text-center my-3' style='width: 35rem; display:flex; flex-wrap:wrap'>
        <form action='".editComments($connect)."' method='POST'>
        <input type='text' class='form-control' name='id' value ='".$cid."'>    
            <input type='text' class='form-control' name='c_author' value ='".$_SESSION['username']."'>
            <input type='text' class='form-control' name='date' value='".$date."'>

        <div class='mb-3'>
            <textarea class='form-control' style='width: 35rem; height: 5rem; resize: none;'
            name='message'>".$message."</textarea>
        </div>
        <input type='text' class='form-control' name='topic_id' value ='".$get_id."'> 
        
        <button name='EditCommentSubmit' type='submit' class='rounded-pill btn btn-outline-success text-left'>Edit Comment</button>

        </form>

        
    </div>
</div>
";
?> 
</body>
</html>

