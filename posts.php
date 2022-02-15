<?php

    session_start();
    require('connection.php');
    include('header.php');
    include('navbar.php');

    if($_SESSION["username"]){
       // echo "Welcome ".$_SESSION['username'];
?>
 <title>Posts</title>
    <div class='d-flex justify-content-center'>
                <div class='text-center my-3' style='width: 35rem; display:flex; flex-wrap:wrap'>
                    <form action=posts.php method='POST'>
                
                        <div class='mb-3'>
                        <label>Topic</label>
                            <input type='text' class='form-control' name='topic_title' placeholder='Enter Topic Title'>
                        </div>

                        <div class='mb-3'>
                            <label>Topic Content</label>
                            <textarea class='form-control' style="width: 35rem; height: 25rem; resize: none;"
                            name='content' placeholder='Enter your topic content here'></textarea>
                        </div>
                        
                        <button type='submit' class='rounded-pill btn btn-outline-primary' name='post_topic'>Post</button>
                    
                    </form>
                
            
<body>
  
</body>

<?php
 $topic_title =  mysqli_real_escape_string($connect, $_POST['topic_title']);
 $t_content =  mysqli_real_escape_string($connect, $_POST['content']);
 $date = date("y-m-d");

  if(isset($_POST['post_topic'])){
      if($topic_title && $t_content){
        if(strlen($topic_title) >= 10 && strlen($topic_title) <= 70){

            if($query = mysqli_query($connect, "INSERT INTO topics(topic_title, topic_content, topic_creator, date)
            VALUES('".$topic_title."', '".$t_content."', '".$_SESSION['username']."', '".$date."')")){
                echo "Topic posted successfully";
            }else{
                echo "Failure";
            }
           
        }
        else{
            echo "Topic name must be between 10 and 70 characters long";
        }
      }else{
          echo "Please fill in all the fields!";
      }
  }

    }else{
        echo "You must first log in to access this page"."<br>";
        echo "<a href ='login.php'>Click here"."</a>";
    }

        echo "</div>";

    echo"</div>";

?>