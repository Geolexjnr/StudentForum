<body>
<?php
    if($_SESSION['username']){
?>
<div class="col-md-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mx-md-5" href="index.php"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="" id="navbarNavDropdown">
        <ul class="navbar-nav" style="display:flex; flex-wrap:wrap;";>
        <li class="nav-item active">
            <a class="nav-link navbar-brand" href="index.php" style="margin-left: -50px;"><img src="img/logo.png" alt="university emblem" style="width: 2.5rem; height: 2.5rem;"></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link navbar-brand" href="index.php" style="margin-left: -30px;"><b>MU Student Forum</b></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="account.php">My account |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="members.php">Members |</a>
        </li>

        <li class="nav-item">
            
                <?php 
                
                    $check = mysqli_query($connect, "SELECT * FROM users Where username ='".$_SESSION['username']."'");

                    $rows = mysqli_num_rows($check);

                    while($rows = mysqli_fetch_assoc($check)){
                        $id = $rows['id'];
                        
                    }

                    echo "<a class='nav-link' href='profile.php?id=$id'>";
                    echo $_SESSION['username']." |</a>";
                
                ?>
        </li>

        <li class="nav-item">
            <a class="rounded-pill btn btn-outline-danger" href="index.php?action=logout" style="margin-left: 70rem; margin-top:-70px;">Logout</a>
        </li>
        </ul>
    </div>
  </div>
</nav>

<?php
    }else{
        header("Location:login.php");
    }
?>
</body>