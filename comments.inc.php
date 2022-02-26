<?php 

function setComments($connect){
    
    if($_GET['id']){
        $check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");

        if(mysqli_num_rows($check)){
            while ($row = mysqli_fetch_assoc($check)) {
              
                $topic_id= $row['topic_id'];

               
            }
        }
    }
    if(isset($_POST['commentSubmit'])){
        $c_author = $_POST['c_author'];
        $date = $_POST['date'];
        $message =  mysqli_real_escape_string($connect, $_POST['message']);

        if(!$message == ""){

            $query = mysqli_query($connect, "INSERT INTO comments(c_author, date, message, topic_id)
            VALUES('$c_author','$date','$message', '$topic_id')");
        }else{
            echo"<div class='d-flex justify-content-center'>";
            echo "you cannot post an empty comment";
            echo "</div>";
        }
    }
   
}


function getComments($connect){

    if($_GET['id']){
        $check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");

        if(mysqli_num_rows($check)){
            while ($row = mysqli_fetch_assoc($check)) {
              
                $topic_id= $row['topic_id'];


            }
        }
    }

    $query = mysqli_query($connect, "SELECT * FROM comments WHERE topic_id = ".$topic_id." ORDER BY date DESC ");
    
    if(mysqli_num_rows($query)){
        while($row = mysqli_fetch_assoc($query)){
            
            echo"<div class='d-flex justify-content-center'>";
                echo "<div class='text-left my-2 bg-light' style='width: 35rem; 
                
                padding: 20px;
                margin-bottom: 4px;
                border-radius: 6px;
                '>
                ";
                    echo "<p style = 'font-weight: bold'>".$row['c_author']."</p>";
                    
                    echo "<p style='
                    font-family: arial;
                    font-size: 14px;
                    line-height: 16px;
                    color: #282828;
                    font-weight: 100;
                    
                    '>". nl2br($row['message'] ."</p>"); 
                    
                    
                    echo "<p style='
                    font-family: arial;
                    font-size: 11px;
                    line-height: 13px;
                    color: #282828;
                    font-weight: 100;
                    
                    '>". $row['date']."</p>";
                    
                    echo "
     
          <div class='d-flex justify-content-center'>
               
                      <form action='editcomments.php?id=$topic_id' method='POST'>
                          <input type='hidden' class='form-control' name='cid' value ='".$row['cid']."'> 
                          <input type='hidden' class='form-control' name='c_author' value ='".$row['c_author']."'>
                          <input type='hidden' class='form-control' name='date' value='".$row['date']."'>
                          <input type='hidden' class='form-control' name='message' value ='".$row['message']."'> 
                      
                      
                      <button name='commentSubmit' type='submit' class='rounded-pill btn btn-outline-success text-left' name='post_topic'>Edit</button>
              
                      </form>
              
                  
            </div>
        ";
                echo"</p>



                </div>";
                
            echo"</div>";
        }
    }


}

function editComments($connect){
    if(isset($_POST['EditCommentSubmit'])){
        if($_GET['id']){
            $check = mysqli_query($connect, "SELECT * FROM comments WHERE topic_id = ".$_GET['id']."");
                if(mysqli_num_rows($check)!=0){
                    while($row =  mysqli_fetch_assoc($check)){
                        $get_topic_id = $row['topic_id'];
                        $get_comment_id = $row['cid'];
                        
                    }
                }

                
        
        }
        $cid = $_POST['cid'];
        $c_author = $_POST['c_author'];
        $date = $_POST['date'];
        $message =  mysqli_real_escape_string($connect, $_POST['message']);
       
        //$update_sql = mysqli_query($connect, "UPDATE comments SET message = '$message' WHERE cid =$cid");
        $sql =  mysqli_query($connect,"UPDATE comments SET message = '$message' WHERE cid = '$get_comment_id' AND topic_id = '$get_topic_id'");
       
        
       header("Location: topic.php?id=$get_topic_id");
        
    }
    
}

?>