<?php
    include'header.php';
?>
 <title>Register</title>
<body>
<div class="col d-flex justify-content-center my-5">
    <div class="card" style="width: 600px;">
    <img class="card-img-top" src="img/logo.png" alt="Card image cap" style="height: 25rem;">
        <div class="card-body">
            <?php 
                require'connection.php';
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $email = $_POST['email'];
                $passwordEncypt = sha1($password);
                $course = $_POST['course'];
                if(isset($_POST['submit'])){

                    if($query = mysqli_query($connect,"INSERT INTO users(username, password, email, course, date)
                    VALUES('".$username."','".$passwordEncypt."','".$email."', '".$course."', NOW())")){
                        echo "Your registration  as $username was Successfull click here <a href = 'login.php'> here</a> 
                        to login";
                    }else{
                        echo "Registration Failed";
                    }

                }
            ?>
            <form id="regform" action="register.php" method="POST">
                <div id="message"></div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group col-md-12">
                        <label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email">
                    </div>
                
                    <div class="form-group col-md-12">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control my-3" name="confirm_password" id="confirm_password" placeholder="Re-Enter your password">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Program of study</label>
                        <input type="text" class="form-control my-3" name="course" id="course" placeholder="Enter program of study">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" name="submit" id="signup" class="rounded-pill btn btn-outline-primary">Sign Up</button> <p class="my-3">or</p>
                    <a type="submit" href="login.php" class="rounded-pill btn btn-outline-success">Sign In</a>
                </div>
                <div class="row">
                    <div class="col-md-12 bg-light text-right">
                        
                    </div>
                </div>
         </form>
        </div>
    </div>
</div>




<?php
    include'footer.php';
?>