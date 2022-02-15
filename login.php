<?php
    include'header.php';
?>

 <title>Login Page</title>
<body>
    
<div class="col d-flex justify-content-center my-5">
    <div class="card">
        <img class="card-img-top" src="img/logo.png" alt="Card image cap" style="height: 25rem;">
        <div class="p-3 border-bottom d-flex align-items-center justify-content-center">
            <h5>Login</h5>
        </div>

            <div class="my-2">
                    <?php
                        session_start();
                        require('connection.php');

                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        if(isset($_POST['submit'])){
                            if($username && $password){
                                $check = mysqli_query($connect, "SELECT * FROM users Where username='".$username."'");
                                $rows = mysqli_num_rows($check);

                                if(mysqli_num_rows($check) !=0){
                                    while($row = mysqli_fetch_assoc($check)){
                                       $db_username = $row['username'];
                                       $db_password = $row['password'];
                                    }

                                    if($username == $db_username && sha1($password) == $db_password){

                                        $_SESSION['username'] =  $username;
                                        header("Location:index.php");
                                    }else{
                                        echo "Your password is wrong";
                                    }
                                }else{
                                    echo "couldn't find username";
                                }
                            }else{
                                die ("Please fill in all the fields");
                            }
                        }

                    ?>
            </div>
        
        <form id="loginform" action="login.php" method="POST">
            <div id="message"></div>
            <div class="p-3 px-4 py-4 border-bottom"> <input type="text" id="username" name="username" class="form-control mb-2" placeholder="Username" />
             <div class="form"> <input type="password" id="username" name="password" class="form-control" placeholder="Password" /></div> 
             <button type="submit" name="submit" class="rounded-pill btn btn-danger btn-block continue">Login</button>
        </form> 

            <div class="d-flex justify-content-center align-items-center mt-3 mb-3"> <span class="line"></span> <small class="px-2 line-text">OR</small> <span class="line"></span> </div>
            <div class="p-3 d-flex flex-row justify-content-center align-items-center member"> <span>Not a member? </span> <a href="register.php" class="text-decoration-none ml-2">SIGNUP</a> </div>
        
    </div>
</div>

</body>

<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</html>

